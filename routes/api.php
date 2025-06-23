<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\ApiResponse;
use App\Http\Resources\UserResource;
use App\Livewire\User\Refs;
use App\Models\Navigations;
use App\Models\Packages;
use App\Models\reseller;
use App\Models\user_has_refs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Pest\Plugins\Only;
use App\HandleImageUpload;
use App\Http\Controllers\Api\Auth as ApiAuth;
use App\Models\Slider;
use App\Models\Slider_has_slide;
use App\Models\vip;

Route::middleware('auth.master')->get('navigations', function () {
    // get all navigations with links
    $navigations = Navigations::with('links')->get();
    return ApiResponse::send($navigations);
});
Route::middleware('auth.master')->get('navigations/{id}', function ($id) {
    // get all navigations with links
    try {
        $nvs = Navigations::find($id);
        $navigations = $nvs->with('links')->get();
        return ApiResponse::send($navigations);
    } catch (\Throwable $th) {
        return ApiResponse::serverError($th->getMessage());
    }
});


// categories 
Route::prefix('categories')->middleware('auth.master')->group(function () {
    // return categories
    Route::get('/', function () {
        $category = Category::where(['belongs_to' => 'reseller'])->with('products')->orderBy('id', 'desc')->get();
        return ApiResponse::send($category);
    });

    // get a single category
    Route::get('/{id}', function ($id) {
        $category = Category::where(['belongs_to' => 'reseller', 'id' => $id])->with('products')->first();
        return ApiResponse::send($category);
    });
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
    Route::get('/where-reeller/{id}', function ($id) {
        // Product get by shop user id
        $products = Product::query()->reseller()->active()->where(['user_id' => $id])->with('category', 'showcase', 'attr')->orderBy('id', 'desc')->paginate($request->paginate ?? config('app.paginate', 20));
        return ApiResponse::send($products);
    });

    // products comments 


    // products questions 


    // products user questions 
});


// show
Route::middleware('auth.master')->prefix('/shop')->group(function () {

    Route::get('/', function () {
        try {

            $shops = reseller::query()->active()->get();
            return ApiResponse::send($shops);
        } catch (\Throwable $th) {
            //throw $th
            return ApiResponse::error('Error Getting Shops Data', $th->getMessage(),);
        }
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


// slider start
Route::middleware('auth.master')->get('/slider', function () {

    // get the apps slider from database

    $slider = Slider::query()->where(['status' => true])->whereNot('placement', '=', 'web')->orderBy('id', 'desc')->get('id')->pluck('id');
    $slides = Slider_has_slide::query()->whereIn('slider_id', $slider)->orderBy('id', 'desc')->get('image')->pluck('image');
    return ApiResponse::send($slides);
});
// slider end 



// process to authenticated with custom logic
Route::post('/login', function (Request $request) {


    $validated = $request->validate(['email' => 'required', 'password' => 'required']);
    try {
        if (Auth::attempt($validated)) {

            $token = $request->user()->createToken(Auth::getName());

            // return ['token' => $token->plainTextToken];
            return ApiResponse::success(['token' => $token->plainTextToken]);
        } else {
            return ApiResponse::unauthorized('invalid Credentials');
        }
    } catch (\Throwable $th) {
        return ApiResponse::error('Login Error', $th->getMessage());
    }
})->middleware(['auth.master']);

// process to register
Route::post('/register', [ApiAuth::class, 'register'])->middleware('auth.master');

Route::post('/logout', function (Request $request) {
    try {
        $request->user()->tokens()->delete();
        return ApiResponse::success('Logout Success');
    } catch (\Throwable $th) {
        return ApiResponse::serverError($th->getMessage());
    };
})->middleware(['auth.master', 'auth:sanctum']);


// after authenticated
Route::get('/me', function (Request $request) {
    $au = User::find($request->user()->id);
    $authUser = $au->load('myRef');
    return ApiResponse::send(new UserResource($authUser));
})->middleware(['auth.master', 'auth:sanctum']);


// rotue for package
Route::get('/packages', function () {
    try {
        $packages = Packages::all();
        return ApiResponse::send($packages);
    } catch (\Throwable $th) {
        return ApiResponse::serverError($th->getMessage());
    }
});

Route::get('/packages/{id}', function (Request $request) {
    try {
        $package = Packages::find($request->id);
        return ApiResponse::send($package);
    } catch (\Throwable $th) {
        return ApiResponse::serverError($th->getMessage());
    }
});

Route::middleware(['auth.master', 'auth:sanctum'])->prefix('my')->group(function () {

    Route::get('/tokens', function (Request $request) {
        if ($request->user()->tokens) {
            return ApiResponse::send($request->user()->tokens);
        } else {
            return ApiResponse::unauthorized();
        }
    });


    // user subscripe package
    Route::get('/subscription', function (Request $request) {
        // get user subscribed package
        try {
            $package = vip::query()->where(['user_id' => $request->user()->id, 'status' => 1])->with('package')->get();
            return ApiResponse::send($package);
        } catch (\Throwable $th) {
            return ApiResponse::serverError($th->getMessage());
        }
    });

    // cart start
    Route::get('/cart', function () {
        try {
            $cart = auth()->user()->myCarts();
            return ApiResponse::send($cart);
        } catch (\Throwable $th) {
            return ApiResponse::serverError($th->getMessage());
        }
    });

    // cart end 
});
