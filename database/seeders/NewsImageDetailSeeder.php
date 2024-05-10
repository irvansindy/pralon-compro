<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsImageDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("news_image_details")->insert([
            [
                'news_id'=> 1,
                'file_name'=> 'detail_1_1.jpg',
            ],
            [
                'news_id'=> 1,
                'file_name'=> 'detail_1_2.jpg',
            ],
            [
                'news_id'=> 2,
                'file_name'=> 'detail_2_1.jpg',
            ],
            [
                'news_id'=> 2,
                'file_name'=> 'detail_2_2.jpg',
            ],
            [
                'news_id'=> 3,
                'file_name'=> 'detail_3_1.jpg',
            ],
            [
                'news_id'=> 3,
                'file_name'=> 'detail_3_2.jpg',
            ],
            [
                'news_id'=> 4,
                'file_name'=> 'detail_4_1.png',
            ],
            [
                'news_id'=> 4,
                'file_name'=> 'detail_4_2.png',
            ],
            [
                'news_id'=> 5,
                'file_name'=> 'detail_5_1.jpg',
            ],
            [
                'news_id'=> 5,
                'file_name'=> 'detail_5_2.jpg',
            ],
        ]);
    }
}
