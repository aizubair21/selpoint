<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\Welcome;

Route::get('/', Welcome::class);

Route::get('dashboard', function () {
    if (auth()->user()->hasAnyRole(['system', 'admin']) || auth()->user()->can('access_vendor_dashboard') || auth()->user()->can('access_reseller_dashboard') || auth()->user()->can('access_rider_dashboard')) {
        return view('dashboard');
    } else {
        return redirect()->route('user.dash');
    }
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->prefix('/u/')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// other page route for user
Route::get('about-us', function () {
    //
})->name('about.us');

Route::get('about-policy', function () {
    //
})->name('about.policy');

Route::get('uproducts', function () {
    //
})->name('uproducts.index');

Route::get('categories', function () {
    //
})->name('categories.index');

Route::get('earning', function () {
    //
})->name('about.earn');

Route::get('terms', function () {
    //
})->name('about.terms');

Route::get('return', function () {
    //
})->name('about.return');

Route::get('contact', function () {
    //
})->name('about.contact');

require __DIR__ . '/auth.php';




Route::get('/volt-test', function () {
    return view('livewire.test');
})->name('test.volt');
