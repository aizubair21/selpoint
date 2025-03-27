<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\Controller;

use Illuminate\Routing\Controller;

class RoleController extends Controller
{
    private $user;
    public function __construct()
    {
        $this->user == Auth::user();
        // Check user has permission to certain task
        // $this->middleware('permission:role_list')->only('admin_list');
        // $this->middleware('permission:role_list', ['only' => ['admin_list']]);
    }


    public function admin_list(Request $request)
    {
        // dd($request->user()->getAllPermissions()[0]['name']);
        // return $request->user()->can('role_list');

        /**
         * get all role with user and permission count in single query
         */
        $roles = Role::get();
        // how to get count in single query
        // dd($roles[0]->users->count());

        $perm = Permission::all();
        $role = Role::all();
        return view('auth.system.role.index', compact('perm', 'role'));
    }



    /**
     * admin edit method, get a role and return the role for edit
     * 
     * @return \Illuminate\Http\Response
     */
    public function admin_edit(Request $request)
    {
        $role = Role::findorFail($request->role);
        return view('auth.system.role.edit', compact('role'));
    }
}
