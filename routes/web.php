<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\Welcome;
use App\Livewire\Pages\Products as userProductsPage;
use App\Livewire\Pages\Categories as userCategoriesPage;
use App\Livewire\Pages\Cproducts as userProductsForCategoryPage;
use App\Livewire\Pages\ProductsDetails as userProductsDetailsPage;
use App\Livewire\Pages\SingleProductOrder;

Route::get('/', Welcome::class)->name('home');

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



Route::get('products', userProductsPage::class)->name('products.index');
Route::get('category/{cat}/products', userProductsForCategoryPage::class)->name('category.products');
Route::get('category', userCategoriesPage::class)->name('category.index');
Route::get('product/{id}/{slug}', userProductsDetailsPage::class)->name('products.details');
Route::get('product/{slug}', SingleProductOrder::class)->name('product.makeOrder')->middleware('auth');


// other page route for user
Route::get('about-us', function () {
    return view('user.pages.about');
})->name('about.us');

Route::get('about-policy', function () {
    return view('user.privacy.policies');
})->name('about.policy');


Route::get('earning', function () {
    return view('user.pages.earn');
})->name('about.earn');

Route::get('terms', function () {
    return view('user.pages.terms');
})->name('about.terms');

Route::get('return', function () {
    return view('user.pages.return_refund');
})->name('about.return');

Route::get('contact', function () {
    return view('contact');
})->name('about.contact');

require __DIR__ . '/auth.php';




Route::get('/volt-test', function () {
    return view('livewire.test');
})->name('test.volt');
