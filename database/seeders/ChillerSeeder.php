<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChillerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chillers')->insert([
            [
                'brand_id'                  => 1,
                'model_id'                  => 1,
                'name'                      => 'Chiller 1',
                'chiller_maximum_capacity'  => 3200,
                'chiller_minimum_capacity'  => 320,
                'chilled_water_flow'        => 153,
                'partial_load_25'           => 9.98,
                'partial_load_50'           => 11.25,
                'partial_load_75'           => 8.5,
                'partial_load_100'          => 8.42,
                'status'                    => 'Approved'
            ],
            [
                'brand_id'                  => 2,
                'model_id'                  => 2,
                'name'                      => 'Chiller 2',
                'chiller_maximum_capacity'  => 3200,
                'chiller_minimum_capacity'  => 320,
                'chilled_water_flow'        => 153,
                'partial_load_25'           => 13.22,
                'partial_load_50'           => 17.23,
                'partial_load_75'           => 14.36,
                'partial_load_100'          => 14.62,
                'status'                    => 'Approved'
            ],
            [
                'brand_id'                  => 3,
                'model_id'                  => 3,
                'name'                      => 'Chiller 3',
                'chiller_maximum_capacity'  => 2200,
                'chiller_minimum_capacity'  => 220,
                'chilled_water_flow'        => 105,
                'partial_load_25'           => 6.22,
                'partial_load_50'           => 9.09,
                'partial_load_75'           => 8.07,
                'partial_load_100'          => 8.96,
                'status'                    => 'Approved'
            ],
            [
                'brand_id'                  => 4,
                'model_id'                  => 4,
                'name'                      => 'Chiller 4',
                'chiller_maximum_capacity'  => 2500,
                'chiller_minimum_capacity'  => 250,
                'chilled_water_flow'        => 120,
                'partial_load_25'           => 11.82,
                'partial_load_50'           => 7.36,
                'partial_load_75'           => 6.36,
                'partial_load_100'          => 5.91,
                'status'                    => 'Approved'
            ]
        ]);
    }
}
