<?php

use App\Http\Middleware\AbleTo;
use App\Livewire\Rider\Consignment\Index;
use App\Livewire\Rider\Consignment\View;
use App\Livewire\Rider\Dashboard as RiderDashboard;
use App\Livewire\Rider\RiderInfo;
use Illuminate\Support\Facades\Route;

Route::get('consignments', RiderDashboard::class)->name('rider.consignment')->middleware(AbleTo::class . ':access_rider_dashboard');
// Route::get('my-consignments', Index::class)->name('rider.consignment');
Route::get('/consignments/{id}', View::class)->name('rider.consignment.view')->middleware(AbleTo::class . ':access_rider_dashboard');
Route::get('/me', RiderInfo::class)->name('rider.me')->middleware(AbleTo::class . ':access_rider_dashboard');
