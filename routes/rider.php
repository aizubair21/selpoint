<?php

use App\Livewire\Rider\Consignment\Index;
use Illuminate\Support\Facades\Route;

Route::get('my-consignments', Index::class)->name('rider.consignment');
