<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\NewsTranslations;

class NewsTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NewsTranslations::query()->delete();
        News::query()->delete();

        $news = News::create([
            'news_category_id' => '1',
            'title' => 'Berita Terbaru',
            'image' => 'path/to/image.jpg',
            'short_desc' => 'Ini adalah berita terbaru yang kami sampaikan kepada Anda.',
            'header_content' => 'Ini adalah berita terbaru yang kami sampaikan kepada Anda.',
            'content' =>  'Ini adalah berita terbaru yang kami sampaikan kepada Anda. Berita ini mencakup informasi penting dan terkini yang relevan dengan perkembangan saat ini.',
            'date' => now(),
            'created_at' => now(),
            'updated_at' => null
        ]);

        $news->translations()->saveMany([
            new NewsTranslations([
                'locale' => 'id',
                'title' => 'Berita Terbaru',
                'short_desc' => 'Ini adalah berita terbaru yang kami sampaikan kepada Anda.',
                'header_content' => 'Ini adalah berita terbaru yang kami sampaikan kepada Anda.',
                'content' => 'Ini adalah berita terbaru yang kami sampaikan kepada Anda. Berita ini mencakup informasi penting dan terkini yang relevan dengan perkembangan saat ini.',
            ]),
            new NewsTranslations([
                'locale' => 'en',
                'title' => 'Latest News',
                'short_desc' => 'This is the latest news we are sharing with you.',
                'header_content' => 'This is the latest news we are sharing with you.',
                'content' => 'This is the latest news we are sharing with you. This news includes important and current information relevant to current developments.',
            ]),
        ]);
    }
}