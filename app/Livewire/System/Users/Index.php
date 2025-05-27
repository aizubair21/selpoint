<?php

namespace App\Livewire\System\Users;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;



#[layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    #[URL]
    public $search;


    public function render()
    {
        // use cache here 
        $users = User::query()->withoutAdmin()->orderBy('id', 'desc')->paginate(config('app.paginate'));
        // $this->getData();

        if (!empty($this->search)) {
            // rider::where('name', 'like', '%' . $this->search . '%')->paginate(20);
            $users = User::where('name', 'like', '%' . $this->search . "%")->orWhere('id', 'like', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate(config('app.paginate'));
        }
        return view('livewire.system.users.index', compact('users'));
    }
}
