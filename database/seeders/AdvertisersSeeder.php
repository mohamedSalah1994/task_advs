<?php

namespace Database\Seeders;

use App\Models\Advertiser;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdvertisersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Advertiser::create([
            'name' => 'mohamed',
            'email' => 'mohamed@gmail.com',
            
        ]);
        Advertiser::create([
            'name' => 'ahmed',
            'email' => 'ahmed@gmail.com',
            
        ]);
        Advertiser::create([
            'name' => 'salah',
            'email' => 'salah@gmail.com',
            
        ]);
    }
}
