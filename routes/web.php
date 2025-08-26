<?php

use App\Events\ProductComissions;
use App\Http\Controllers\ProductComissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\Welcome;
use App\Livewire\Pages\Products as userProductsPage;
use App\Livewire\Pages\Categories as userCategoriesPage;
use App\Livewire\Pages\Cproducts as userProductsForCategoryPage;
use App\Livewire\Pages\ProductsDetails as userProductsDetailsPage;
use App\Livewire\Pages\Search;
use App\Livewire\Pages\Shops\All;
use App\Livewire\Pages\Shops\Shop;
use App\Livewire\Pages\SingleProductOrder;
use App\Models\DistributeComissions;
use App\Models\Order;
use App\Models\Product;
use App\Models\TakeComissions;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

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
Route::get('product/{id}/{slug}', userProductsDetailsPage::class)->name('products.details')->middleware('products.view.add');
Route::get('product/order/{id}/{slug}', SingleProductOrder::class)->name('product.makeOrder')->middleware('auth');


/**shops */
Route::get('/shops', All::class)->name('shops');
Route::get('/shops/{id}/{name}', Shop::class)->name('shops.visit');


/** search */
Route::get('/search', Search::class)->name('search');


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


Route::get('/test', function () {
    dd(config('app.system_email'));
});


Route::get('/volt-test', function () {
    return view('livewire.test');
})->name('test.volt');



Route::get('/user-agents', function (Request $request) {
    return config('app.system_email');
    try {
        // return ProductComissions::dispatch(5);

        $pcc = new ProductComissionController();
        // $pcc->roleBackDistributedComissions(Order::query()->first()->id);
        return $pcc->dispatchProductComissionsListeners(27);
        // $pcc->confirmTakeComissions(Order::query()->first()->id);
        // return 'success';
        // return DistributeComissions::query()
        //     ->where('order_id', 1)
        //     ->pending()
        //     ->groupBy('user_id')
        //     ->select('user_id', DB::raw('SUM(amount) as total_amount'))
        //     ->get();
    } catch (\Throwable $th) {
        throw $th;
    }
});

Route::get('/queue', function () {
    Artisan::call('queue:work');
    return redirect()->back();
})->name('queue');

Route::get('check-product', function () {
    // get the product, those who have the isResel relation
    return Product::query()->whereHas('isResel', function ($query) {
        $query->with('isResel');
    })->with('isResel')->get();
});
