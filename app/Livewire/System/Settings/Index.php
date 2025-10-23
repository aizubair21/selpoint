<?php

namespace App\Livewire\System\Settings;

use Exception;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Artisan;


#[layout('layouts.app')]
class Index extends Component
{
    public $queueStatus;
    public $isQueueRunning;

    public function mount()
    {
        // Check if the queue worker is running
        $this->queueStatus = Artisan::output();
        // dd($this->queueStatus);
        $this->isQueueRunning = strpos($this->queueStatus, 'Queue worker is running') !== false;
    }

    public function startQueue()
    {
        // This will start the queue worker
        try {

            Artisan::call('queue:work');
            $this->dispatch('success', 'Queue worker started successfully.');
        } catch (Exception $th) {
            $this->dispatch('error', $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.system.settings.index');
    }
}
