<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SystemUsersController extends Controller
{
    // users view to system by permission
    public function admin_view()
    {
        $users = User::withoutRole('system')->orderBy('id', 'desc')->get();
        // return $users[0]->role;
        return view('auth.system.users.index', compact('users'));
    }


    /**
     * users edit form to system by permissions
     * 
     * @return view
     */
    public function admin_edit()
    {
        $user = User::withoutRole('system')->where('email', request('email'))->first();
        return view('auth.system.users.edit', compact('user'));
    }
}
