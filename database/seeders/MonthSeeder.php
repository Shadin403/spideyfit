<?php

namespace Database\Seeders;

use Carbon\Month;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $months = [
            ['name' => 'January'],
            ['name' => 'February'],
            ['name' => 'March'],
            ['name' => 'April'],
            ['name' => 'May'],
            ['name' => 'June'],
            ['name' => 'July'],
            ['name' => 'August'],
            ['name' => 'september'],
            ['name' => 'october'],
            ['name' => 'november'],
            ['name' => 'december']
        ];

        DB::table('month_names')->insert($months);
    }
}
