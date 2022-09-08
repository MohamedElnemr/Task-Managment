<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AddPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    // Add Permision To Role
    public function add_permission(Request $request)
    {

        Permission::create(['name' => $request->permission]);
        $role1 = Role::where('name',$request->role)->first();
        $role1->givePermissionTo($request->permission);

        return $role1->getPermissionNames() ;
    }


}
