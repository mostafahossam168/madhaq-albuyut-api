<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'ادمن',
            'email' => "admin@gmail.com",
            'phone' => '01064564850',
            'password' => bcrypt('123456'),
        ]);
    }
}
