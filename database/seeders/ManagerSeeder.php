<?php

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $man = new Manager();
        $man->section = Str::random(10);
        $man->join_date = Carbon::now();
        $man->save();

        $man = new Manager();
        $man->section = Str::random(10);
        $man->join_date = Carbon::now();
        $man->save();
    }
}
