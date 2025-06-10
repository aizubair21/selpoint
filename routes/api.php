<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;


$default_offset = 20;
/**
 * @param offset item count every age
 * @param index get the single value of item
 * @param getCat to get product belongs to category
 * 
 * @return the products
 */
Route::get('/products', function (Request $request) {
    $products = Product::where(['belongs_to_type' => 'reseller', 'status' => 'Active'])->orderBy('id', 'desc')->paginate($request->offset ?? 20);
    $index = $request->index;
    $category = $request->getCat;

    // if 'index' query parameter is found, then get the index products.
    if ($index) {
        $products = Product::where(['belongs_to_type' => 'reseller', 'status' => 'Active', 'id' => $index])->with('showcase', 'attr')->first();
    }

    // if category found, then get the product belongs to those category.
    if ($category) {
        $products = Product::where(['belongs_to_type' => 'reseller', 'status' => 'Active', 'category_id' => $category])->with('showcase', 'attr')->paginate($request->offset ?? 20);
    }

    return response()->json($products, 200);
});

/**
 * @param offset to limit the pagination
 * 
 * 
 * @return App\Models\Categories collection
 */
Route::get('/categories', function (Request $request) {
    $data = Category::where(['belongs_to' => 'reseller'])->paginate($request->offset ?? 20);

    // if offset set to 'full' then get the all categories
    if ($request->offset == 'full') {
        $data = Category::where(['belongs_to' => 'reseller'])->get();
    }
    return response()->json($data, 200);
});


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
