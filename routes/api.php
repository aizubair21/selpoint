<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\ApiResponse;
use App\Http\Middleware\CheckApiMasterKey;
use App\Livewire\User\Refs;
use App\Models\Navigations;
use App\Models\Packages;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth.master')->get('navigations', function () {
    // get all navigations with links
    $navigations = Navigations::with('links')->get();
    return ApiResponse::send($navigations);
});
Route::middleware('auth.master')->get('navigations/{id}', function ($id) {
    // get all navigations with links
    $nvs = Navigations::find($id);
    if ($nvs) {
        $navigations = $nvs->with('links')->get();
        return ApiResponse::send($navigations);
    } else {
        return ApiResponse::notFound('No Navigations Found!');
    }
});

// products 
Route::middleware('auth.master')->prefix('/products/')->group(function () {

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

    // products comments 


    // products questions 


    // products user questions 
});



Route::middleware('auth.master')->prefix('/shop')->group(function () {

    Route::get('/', function () {
        // get all shops;

    });

    Route::get('/{id}', function () {
        // get an targeted shops

    });

    Route::post('/{id}/report', function () {
        // report against shop

    })->middleware('auth.sacntum');

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
Route::middleware('auth.master')->prefix('/category')->group(function () {

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


// process to authenticated with custom logic
Route::get('/login', function (Request $request) {

    $validated = $request->validate(['email' => 'required', 'password' => 'required']);

    // return $validated;;
    if (Auth::attempt($validated)) {

        // token_name property comes from api
        // it consider just the device name to identify.

        $token = $request->user()->createToken($request->token_name);

        // return ['token' => $token->plainTextToken];
        return ApiResponse::success(['token' => $token->plainTextToken]);
    } else {
        return ApiResponse::unauthorized('Invalid Credentials !');
    }
})->middleware('auth.master');


// after authenticated

Route::get('/me', function (Request $request) {
    return ApiResponse::send($request->user());
})->middleware(['auth.master', 'auth:sanctum']);

Route::get('/logout', function (Request $request) {
    try {
        $request->user()->tokens()->delete();
        return ApiResponse::success('Logout Success');
    } catch (\Throwable $th) {
        return ApiResponse::error('Something Wrong to logout', $th->getMessage());
    };
})->middleware(['auth.master', 'auth:sanctum']);


Route::middleware(['auth.master', 'auth:sanctum'])->prefix('my')->group(function () {

    Route::get('/tokens', function (Request $request) {
        if ($request->user()->tokens) {
            return ApiResponse::send($request->user()->tokens);
        } else {
            return ApiResponse::unauthorized();
        }
    });



    // rotue for package
    Route::get('/packages', function () {
        try {
            $packages = Packages::all();
            return ApiResponse::send($packages);
        } catch (\Throwable $th) {
            return ApiResponse::forbidden();
        }
    });

    Route::get('/packages/{id}', function (Request $request) {
        try {
            $package = Packages::find($request->id);
            return ApiResponse::send($package);
        } catch (\Throwable $th) {
            return ApiResponse::forbidden();
        }
    });


    Route::post('/test-post', function () {
        return 'post re';
    });
});
