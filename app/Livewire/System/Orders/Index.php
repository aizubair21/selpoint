<?php

namespace App\Livewire\System\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

#[layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    #[URL]
    public $search = '', $date, $sd = '', $ed = '', $qf = 'id', $type, $status;
    public $pagn = 0;

    public function mount()
    {
        $this->date = 'today';
        $this->pagn = config('app.paginate');
    }

    public function updated()
    {
        // $this->dispatch('refresh');
    }


    public function render()
    {
        $orders = [];

        $query = Order::query();
        if ($this->search) {
            $query->where([$this->qf => $this->search]);
        }

        if ($this->date) {
            switch ($this->date) {
                case 'today':
                    $this->sd = '';
                    $this->ed = '';;
                    $query->whereDate('created_at', today());
                    break;

                case 'yesterday':
                    $query->whereDate('created_at', today()->subDay());
                    break;

                
                case 'between':
                    if ($this->sd && $this->ed) {
                        $query->whereBetween('created_at', [$this->sd, $this->ed]);
                    }
                    break;
            }

            // $query->whereDate('created_at', $this->date);
        }

        if ($this->type) {
            $query->where(['user_type' => $this->type]);
        }

        if ($this->status) {
            $query->where(['status' => $this->status]);
        }
        $orders = $query->orderBy('id', 'desc')->paginate($this->pagn);

        return view('livewire.system.orders.index', compact('orders'));
    }
}
