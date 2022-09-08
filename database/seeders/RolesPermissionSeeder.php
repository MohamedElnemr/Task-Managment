<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;


class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // create Permission
        Permission::create(['name' => 'list_employees']);
        Permission::create(['name' => 'show_employee_id']);
        Permission::create(['name' => 'Add_employee']);
        Permission::create(['name' => 'list_managers']);
        Permission::create(['name' => 'Add_manager']);
        Permission::create(['name' => 'assign_organization']);
        Permission::create(['name' => 'update_employee']);
        Permission::create(['name' => 'delete_employee']);

        // create Role
        $role1 = Role::create(['name' => 'SuperAdmin']);
        $role2 = Role::create(['name' => 'Admin']);
        $role3 = Role::create(['name' => 'Manager']);
        $role4 = Role::create(['name' => 'Employee']);


        // Super Admin


        // Admin
        $role2->givePermissionTo('list_employees');
        $role2->givePermissionTo('Add_employee');
        $role2->givePermissionTo('Add_manager');
        $role2->givePermissionTo('assign_organization');
        $role2->givePermissionTo('delete_employee');
        $role2->givePermissionTo('list_managers');
        $role2->givePermissionTo('update_employee');
        $role2->givePermissionTo('show_employee_id');


        // Manager
        $role3->givePermissionTo('Add_employee');
        $role3->givePermissionTo('list_employees');
        $role3->givePermissionTo('update_employee');
        $role3->givePermissionTo('delete_employee');
        $role3->givePermissionTo('show_employee_id');


        // Employee
        $role4->givePermissionTo('update_employee');
    }
}
