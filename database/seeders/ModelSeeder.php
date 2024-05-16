<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('models')->insert([
            ['brand_id' => 1, 'name' => 'Model W'],
            ['brand_id' => 2, 'name' => 'Model X'],
            ['brand_id' => 3, 'name' => 'Model Y'],
            ['brand_id' => 4, 'name' => 'Model Z'],
        ]);
    }
}
