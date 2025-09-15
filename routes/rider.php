<?php

use App\Livewire\Rider\Consignment\Index;
use App\Livewire\Rider\Consignment\View;
use Illuminate\Support\Facades\Route;

Route::get('my-consignments', Index::class)->name('rider.consignment');
// Route::get('my-consignments', Index::class)->name('rider.consignment');
Route::get('/consignments/', View::class)->name('rider.consignment.view');
