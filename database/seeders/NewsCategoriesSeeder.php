<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class NewsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table("news_categories")->insert([
            [
                'name' => 'Tips',
                'created_at'=> date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Product Knowledge',
                'created_at'=> date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Berita',
                'created_at'=> date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Blog',
                'created_at'=> date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
