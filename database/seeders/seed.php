<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class seed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('news_blog')->insert([
            'Title' => 'Kendaraan Udara Orang Kalimantan',
            'Img' => 'KendaraanUdara.jpeg',
            'Description' => 'Kendaraan Tradisional orang Kalimantan, sejak abad 21 Meter',
            'created_at' => Carbon::parse('Jan 21, 2026')
        ]);
    }
}
