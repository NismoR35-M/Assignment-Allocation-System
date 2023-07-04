<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    
        $this->call(AssignmentSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
