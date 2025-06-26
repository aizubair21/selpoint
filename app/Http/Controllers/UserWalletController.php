<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserWalletController extends Controller
{
    public static function add($user_id, $amount)
    {
        try {

            $user = User::find($user_id);
            $user->coin += $amount;
            $user->save();
            return ['success' => true];
        } catch (\Throwable $th) {
            return ['success' => false];
        }
    }

    // remove
    public static function remove($user_id, $amount)
    {
        try {

            $user = User::find($user_id);
            if ($user->abailCoin > $amount) {

                $user->coin -= $amount;
                $user->save();
                return ['success' => true];
            } else {

                return ['success' => false];
            }
        } catch (\Throwable $th) {
            return ['success' => false];
        }
    }


    
}
