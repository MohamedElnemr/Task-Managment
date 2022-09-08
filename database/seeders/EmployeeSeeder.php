<?php

namespace Database\Seeders;

use DateTimeZone;
use Carbon\Carbon;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emp = new Employee();
        $emp->date_of_birth = Carbon::parse('2021-11-02');
        $emp->address = Str::random(50);
        $emp->phone_no = '+0201201891564';
        $emp->education = Str::random(10);
        $emp->save();

        $emp = new Employee();
        $emp->date_of_birth = Carbon::parse('2021-11-02');
        $emp->address = Str::random(50);
        $emp->phone_no = '+0201201891564';
        $emp->education = Str::random(10);
        $emp->save();
    }
}
