<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductDetailFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Butt Welding
        // 2. Electro Fusion
        // 3. Stub End & Flange Adpator
        // 4. Compression Fittings
        // 5. Push On System
        DB::table('product_detail_features')->insert([
            // HDPE
            [
                'product_detail_id' => '6',
                'name' => 'Butt Welding',
                'ordering' => '1',
            ],
            [
                'product_detail_id' => '6',
                'name' => 'Electro Fushion',
                'ordering' => '2',
            ],
            [
                'product_detail_id' => '6',
                'name' => 'Stub End & Flange Adpator',
                'ordering' => '3',
            ],
            [
                'product_detail_id' => '6',
                'name' => 'Compression Fittings',
                'ordering' => '4',
            ],
            [
                'product_detail_id' => '6',
                'name' => 'Push On System',
                'ordering' => '5',
            ],
            
            // subduct
            [
                'product_detail_id' => '8',
                'name' => 'Butt Welding',
                'ordering' => '1',
            ],
            [
                'product_detail_id' => '8',
                'name' => 'Electro Fushion',
                'ordering' => '2',
            ],
            [
                'product_detail_id' => '8',
                'name' => 'Stub End & Flange Adpator',
                'ordering' => '3',
            ],
            [
                'product_detail_id' => '8',
                'name' => 'Compression Fittings',
                'ordering' => '4',
            ],
            [
                'product_detail_id' => '8',
                'name' => 'Push On System',
                'ordering' => '5',
            ],
        ]);
    }
}
