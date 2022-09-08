<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'islam';
        $user->email = 'islam@gmail.com';
        $user->gender = 'male';
        $user->password = Hash::make(123456);
        $user->save();

        $user = new User();
        $user->name = 'mostafa';
        $user->email = 'mostafa@gmail.com';
        $user->gender = 'male';
        $user->password = Hash::make(123456);
        $user->save();

        $user = new User();
        $user->name = 'zaky';
        $user->email = 'zaky@gmail.com';
        $user->gender = 'male';
        $user->password = Hash::make(123456);
        $user->save();

        $user = new User();
        $user->name = 'elsaed';
        $user->email = 'elsaed@gmail.com';
        $user->gender = 'male';
        $user->password = Hash::make(123456);
        $user->save();

        $user = new User();
        $user->name = 'elnamr';
        $user->email = 'elnamr@gmail.com';
        $user->gender = 'male';
        $user->password = Hash::make(123456);
        $user->save();
    }
}
