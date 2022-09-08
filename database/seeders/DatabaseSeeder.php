<?php

namespace Database\Seeders;

use App\Models\Membership;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EmployeeSeeder::class,
            ManagerSeeder::class,
            UserSeeder::class,
            UserTypeSeeder::class,
            MembershipSeeder::class,
            OrganizationSeeder::class,
            TaskSeeder::class,
            RolesPermissionSeeder::class,


        ]);
    }
}
