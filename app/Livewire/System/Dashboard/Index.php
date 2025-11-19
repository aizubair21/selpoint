<?php

namespace App\Livewire\System\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\vendor;
use App\Models\reseller;
use App\Models\rider;
use App\Models\Product;
use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Renderless;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    private $userCount = 0, $vd = 0, $avd = 0, $rs = 0, $ars = 0, $ri = 0, $ari = 0, $adm = 0, $vp = 0, $cat = 0;


    public function getOverview()
    {
        $stats = collect(DB::select("
            SELECT 'users' as type, COUNT(*) as total FROM users
            UNION ALL
            SELECT 'vendors', COUNT(*) FROM vendors
            UNION ALL
            SELECT 'active_vendors', COUNT(*) FROM vendors WHERE status = 'active'
            UNION ALL
            SELECT 'resellers', COUNT(*) FROM resellers
            UNION ALL
            SELECT 'active_resellers', COUNT(*) FROM resellers WHERE status = 'active'
            UNION ALL
            SELECT 'riders', COUNT(*) FROM riders
            UNION ALL
            SELECT 'active_riders', COUNT(*) FROM riders WHERE status = 'active'
            UNION ALL
            SELECT 'admin_users', COUNT(*) 
                FROM users 
                WHERE id IN (SELECT model_id FROM model_has_roles WHERE role_id = (SELECT id FROM roles WHERE name = 'admin'))
            UNION ALL
            SELECT 'products', COUNT(*) FROM products
            UNION ALL
            SELECT 'categories', COUNT(*) FROM categories
        "));
        
        $map = $stats->pluck('total', 'type');

        $this->userCount = $map['users'];
        $this->vd        = $map['vendors'];
        $this->avd       = $map['active_vendors'];
        $this->rs        = $map['resellers'];
        $this->ars       = $map['active_resellers'];
        $this->ri        = $map['riders'];
        $this->ari       = $map['active_riders'];
        $this->adm       = $map['admin_users'];
        $this->vp        = $map['products'];
        $this->cat       = $map['categories'];
    }
    public function render()
    {
        return view(
            'livewire.system.dashboard.index',
            [
                'userCount' => $this->userCount,
                'vd' => $this->vd,
                'avd' => $this->avd,
                'rs' => $this->rs,
                'ars' => $this->ars,
                'ri' => $this->ri,
                'ari' => $this->ari,
                'adm' => $this->adm,
                'vp' => $this->vp,
                'cat' => $this->cat,

            ]
        );
    }
}
