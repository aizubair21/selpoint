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
Route::post('/register', function (Request $request) {
    // 

    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
        'country' => ['required', 'string', 'max:25'],
        'gender' => ['required', 'max:10'],
        'language' => ['requited'],
        'phone' => ['required'],
        'password' => ['required', 'confirmed', 'min:8', Rules\Password::defaults()],
    ]);

    $reference = null;
    $isRef = null;


    // active reference 
    if (config('app.comission')) {
        if ($request->reference && $request->reference != config('app.ref')) {
            if (user_has_refs::where('ref', $request->reference)->exists()) {
                $reference = $request->reference;
                $isRef = today();
            } else {
                $reference = config('app.ref');
                // $isRef = today();
            }
        } else {
            $reference = config('app.ref'); // default reference
        }
    }

    try {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'reference' => $reference,
            'reference_accepted_at' => $isRef,
        ]);


        if ($user) {
            /**
             * user has a ref code
             */
            if (config('app.comission')) {

                $length = strlen($user->id);

                if ($length >= 4) {
                    $ref = $user->id;
                } else {
                    $ref = str_pad($user->id, 3, '0', STR_PAD_LEFT);
                }


                user_has_refs::create([
                    'ref' => date('ym') . $ref,
                    'user_id' => $user->id,
                    'status' => 1,
                ]);
            }
            try {
                //code...
                Auth::attempt($request->Only(['email', 'password']));
                $token = $request->user()->createToken(Auth::getName());

                // return ['token' => $token->plainTextToken];
                return ApiResponse::success(['token' => $token->plainTextToken]);
            } catch (\Throwable $th) {
                return ApiResponse::unauthorized($th->getMessage());
            }
        }
    } catch (\Throwable $th) {
        return ApiResponse::forbidden('Error While Register !');
    }
})->middleware('auth.master');

Route::post('/logout', function (Request $request) {
    try {
        $request->user()->tokens()->delete();
        return ApiResponse::success('Logout Success');
    } catch (\Throwable $th) {
        return ApiResponse::notFound();
    };
})->middleware(['auth.master', 'auth:sanctum']);


// after authenticated
Route::get('/me', function (Request $request) {
    $au = User::find($request->user()->id);
    $authUser = $au->load('myRef');
    return ApiResponse::send(new UserResource($authUser));
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
});
