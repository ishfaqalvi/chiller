<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(PermissionSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ModelSeeder::class);
        $this->call(ChillerSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(SettingsSeeder::class);
    }
}
