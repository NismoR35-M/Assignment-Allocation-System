<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Admin::factory()-> create([
            'first_name' => 'Beverly',
            'email' => 'beverleyHiii@gmail.com',
            'password' =>Hash::make('secret'),
            
        ]);

    }

}
