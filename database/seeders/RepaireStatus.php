<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RepaireStatus extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('repaire_status')->truncate();

        $SaleStatus = [
            ['rep_status' => 'Pending' ],
            ['rep_status' => 'Complete' ],
            ['rep_status' => 'Return' ],
            ['rep_status' => 'Damage' ],

        ];

        DB::table('repaire_status')->insert($SaleStatus);
    }
}
