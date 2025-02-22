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
                'file_name'=> 'storage/uploads/news_blog/detail/detail-1-1.jpg',
            ],
            [
                'news_id'=> 1,
                'file_name'=> 'storage/uploads/news_blog/detail/detail-1-2.jpg',
            ],
            [
                'news_id'=> 2,
                'file_name'=> 'storage/uploads/news_blog/detail/detail-2-1.jpg',
            ],
            [
                'news_id'=> 2,
                'file_name'=> 'storage/uploads/news_blog/detail/detail-2-2.jpg',
            ],
            [
                'news_id'=> 3,
                'file_name'=> 'storage/uploads/news_blog/detail/detail-3-1.jpg',
            ],
            [
                'news_id'=> 3,
                'file_name'=> 'storage/uploads/news_blog/detail/detail-3-2.jpg',
            ],
            [
                'news_id'=> 4,
                'file_name'=> 'storage/uploads/news_blog/detail/detail-4-1.png',
            ],
            [
                'news_id'=> 4,
                'file_name'=> 'storage/uploads/news_blog/detail/detail-4-2.png',
            ],
            [
                'news_id'=> 5,
                'file_name'=> 'storage/uploads/news_blog/detail/detail-5-1.jpg',
            ],
            [
                'news_id'=> 5,
                'file_name'=> 'storage/uploads/news_blog/detail/detail-5-2.jpg',
            ],
        ]);
    }
}
