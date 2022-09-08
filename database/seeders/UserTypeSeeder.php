<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usertype = new UserType();
        $usertype->type = 'Super Admin';
        $usertype->save();

        $usertype = new UserType();
        $usertype->type = 'Admin';
        $usertype->save();

        $usertype = new UserType();
        $usertype->type = 'Employee';
        $usertype->save();

        $usertype = new UserType();
        $usertype->type = 'Manager';
        $usertype->save();
    }
}
