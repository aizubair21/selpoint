<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use App\Models\Cart;
use App\Models\user_task;
use App\Models\vip;
use Illuminate\Console\View\Components\Task;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

#[layout('layouts.user.app')]
class ProductsDetails extends Component
{
    #[URL]
    public $slug;

    public $product, $relatedProduct, $vips, $duration, $currentTaskTime, $taskType = null, $currentTask = null, $taskNotCompletYet = true;

    public $min = 0, $sec = 0, $package;

    public function mount()
    {
        // dd(intval(30 / 60));
        $this->product = Product::where(['slug' => $this->slug, 'status' => 'active', 'belongs_to_type' => 'reseller'])->first();

        $this->vips = auth()?->user()?->subscription()?->active()->valid()->first();
        $this->taskType = $this->vips?->task_type;
        $this->package = $this->vips?->package;
        $this->getData();
        $this->relatedProduct = Product::where(['category_id' => $this->product->category_id, 'status' => 'active', 'belongs_to_type' => 'reseller'])->limit(10)->get();
        // $this->vips = vip::where(['user_id' => Auth::id(), 'status' => 1])->whereDate('valid_till', '>', today())->first();
        // dd($this->vips->task_type);
    }

    #[on('count-task')]
    public function countTask()
    {
        // if task found, and task time equal to package time
        // then set the coin to task
        // dd('tast');

        if ($this->currentTaskTime >= $this->duration) {
            $this->currentTask->coin = $this->package->coin;
            $this->taskNotCompletYet = $this->currentTask?->coin ? false : true;
            $this->currentTask?->save();
        } else {

            if ($this->currentTask && $this->taskNotCompletYet) {
                $this->currentTask?->increment('time');
            } else {
                user_task::create(
                    [
                        'user_id' => Auth::id(),
                        'package_id' => $this->package->id,
                        'vip_id' => $this->vips->id,
                        'earn_by' => 'task',
                        'time' => 0,
                    ]
                );
            }
        }


        $this->getData();
    }



    public function getData()
    {
        if (Auth::check()) {

            $this->currentTask = user_task::where(['user_id' => auth()->user()->id, 'package_id' => $this->vips?->package_id])->whereDate('created_at', '=', today())->first();
            $this->currentTaskTime = $this->currentTask?->time ?? 0;
            $this->taskNotCompletYet = $this->currentTask?->coin ? false : true;
            $this->duration = $this->package->countdown * 60;

            $min = intval($this->currentTaskTime / 60, 0);
            $sec = $this->currentTaskTime - ($min * 60);

            $this->min = $min < 9 ? "0" . $min : $min;
            $this->sec = $sec < 9 ? "0" . $sec : $sec;
        }
    }

    public function render()
    {
        return view('livewire.pages.products-details');
    }
}
