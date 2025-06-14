<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\ApiResponse;
use App\Models\Navigations;


Route::get('navigations', function () {
    // get all navigations with links
    $navigations = Navigations::with('links')->get();
    return ApiResponse::send($navigations);
});
Route::get('navigations/{id}', function ($id) {
    // get all navigations with links
    $nvs = Navigations::find($id);
    if ($nvs) {
        $navigations = $nvs->with('links')->get();
        return ApiResponse::send($navigations);
    } else {
        return ApiResponse::notFound('No Navigations Found!');
    }
});


Route::prefix('/products/')->group(function () {

    Route::get('/', function (Request $request) {
        $products = Product::query()->reseller()->active()->with('category', 'showcase', 'attr')->orderBy('id', 'desc')->paginate($request->paginate ?? config('app.paginate', 20));
        return ApiResponse::send($products);
    });

    // product with id
    Route::get('/{id}', function (Request $req, $id) {
        $products = Product::query()->reseller()->active()->where(['id' => $id])->with('showcase', 'attr', 'category')->first();
        return ApiResponse::send($products);
    });

    // product with category
    Route::get('/where-category/{id}', function ($id) {
        $products = Product::query()->reseller()->active()->where(['category_id' => $id])->with('category', 'showcase', 'attr')->orderBy('id', 'desc')->paginate($request->paginate ?? config('app.paginate', 20));
        return ApiResponse::send($products);
    });

    // product by shop
    Route::get('/user/{id}', function ($id) {
        // Product get by shop user id
        $products = Product::query()->reseller()->active()->where(['user_id' => $id])->with('category', 'showcase', 'attr')->orderBy('id', 'desc')->paginate($request->paginate ?? config('app.paginate', 20));
        return ApiResponse::send($products);
    });
});



Route::prefix('/shop')->group(function () {

    Route::get('/', function () {
        // get all shops;

    });

    Route::get('/{id}', function () {
        // get an targeted shops

    });

    Route::post('/{id}/report', function () {
        // report against shop

    });

    Route::get('/{id}/products', function () {
        // get products by a shop id
    });


    Route::get('/{id}/categories', function () {
        // get categories by a shop id

    });
});


/**if
 * @param offset to limit the pagination
 * @return App\Models\Categories collection
 */
Route::prefix('/category')->group(function () {

    Route::get('/', function (Request $request) {
        $data = Category::where(['belongs_to' => 'reseller'])->paginate($request->paginate ?? config('app.paginate', 20));

        // if offset set to 'full' then get the all categories
        if ($request->paginate == 'full') {
            $data = Category::where(['belongs_to' => 'reseller'])->get();
        }
        return ApiResponse::send($data);
    });

    Route::get('/{id}', function ($id) {
        // get a category
        $data = Category::where(['belongs_to' => 'reseller', 'id' => $id])->first();
        return ApiResponse::send($data);
    });


});



Route::prefix('me')->group(function () {

    Route::get('/', function (Request $request) {
        return $request->user();
    });
})->middleware('auth:sanctum');
