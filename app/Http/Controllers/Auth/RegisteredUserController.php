<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\user_has_refs;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $reference = null;

        if (config('app.comission')) {
            $isRef = null;
            if ($request('reference') && $request('reference') != config('app.ref')) {
                if (user_has_refs::where('ref', $request('reference'))->exists()) {
                    $reference = $request('reference');
                    $isRef = today();
                } else {
                    $reference = config('app.ref');
                    // $isRef = today();
                }
            } else {
                $reference = config('app.ref'); // default reference
            }
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'reference' => $reference,
            'reference_accepted_at' => $isRef,
        ]);


        /**
         * user has a ref
         */
        if (config('app.comission')) {

            // createUserRef::dispatch($user->id);
            // $userFormate = new constant();

            // $ref = date('ym') . "0" . $userFormate->formatString(Auth::id());
            // $ref = '';
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

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
