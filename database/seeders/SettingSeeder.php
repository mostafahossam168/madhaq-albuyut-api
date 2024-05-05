<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'logo' => 'uploads/settings/logo.png',
            'text1' => "sssssssssssssss",
            'image1' => 'uploads/settings/image-1.png',
            'text2' => '4444444444444',
            'image2' => 'uploads/settings/image-2.png',
            'text3' => '4444444444444444',
            'image3' => 'uploads/settings/image-3.png',
            'f_link' => 'facebook',
            'i_link' => 'facebook',
            't_link' => 'facebook',
            'email' => 'email@gmail.com',
            'phone' => '01064564850',
            'conditions' => '11111',
            'policy' => '1231321321',
        ]);
    }
}
