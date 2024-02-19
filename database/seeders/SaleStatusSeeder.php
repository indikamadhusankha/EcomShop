<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SaleStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sale_status')->truncate();

        $SaleStatus = [
            ['sale_status' => 'Active' ],
            ['sale_status' => 'Sold' ],
            ['sale_status' => 'Repaire' ],
            ['sale_status' => 'Return' ],
            ['sale_status' => 'Damage' ],
        ];

        DB::table('sale_status')->insert($SaleStatus);
    }
}
