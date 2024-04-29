<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductImage extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_image_products')->insert([
            [
                'product_id'=> 1,
                'image_detail' => 'uPVC_sni_1.jpg',
                'ordering' => 1
            ],
            [
                'product_id'=> 1,
                'image_detail' => 'uPVC_sni_2.jpg',
                'ordering' => 2
            ],
            [
                'product_id'=> 2,
                'image_detail' => 'uPVC_jis_1.jpg',
                'ordering' => 1
            ],
            [
                'product_id'=> 2,
                'image_detail' => 'uPVC_jis_2.jpg',
                'ordering' => 2
            ],
            [
                'product_id'=> 3,
                'image_detail' => 'uPVC_pralon_1.jpg',
                'ordering' => 1
            ],
            [
                'product_id'=> 3,
                'image_detail' => 'uPVC_pralon_2.jpg',
                'ordering' => 2
            ],
            [
                'product_id'=> 4,
                'image_detail' => 'uPVC_jacking_1.jpg',
                'ordering' => 1
            ],
            [
                'product_id'=> 4,
                'image_detail' => 'uPVC_jacking_2.jpg',
                'ordering' => 2
            ],
            [
                'product_id'=> 5,
                'image_detail' => 'uPVC_coklat.jpg',
                'ordering' => 1
            ],
            [
                'product_id'=> 5,
                'image_detail' => 'uPVC_coklat_2.jpg',
                'ordering' => 2
            ],
            [
                'product_id'=> 6,
                'image_detail' => 'hdpe_1.jpg',
                'ordering' => 1
            ],
            [
                'product_id'=> 6,
                'image_detail' => 'hdpe_2.jpg',
                'ordering' => 2
            ],
            [
                'product_id'=> 7,
                'image_detail' => 'gas_1.jpg',
                'ordering' => 1
            ],
            [
                'product_id'=> 7,
                'image_detail' => 'gas_2.jpg',
                'ordering' => 2
            ],
            [
                'product_id'=> 8,
                'image_detail' => 'subduct_1.jpg',
                'ordering' => 1
            ],
            [
                'product_id'=> 8,
                'image_detail' => 'subduct_2.jpg',
                'ordering' => 2
            ],
            [
                'product_id'=> 9,
                'image_detail' => 'hic_1.jpg',
                'ordering' => 1
            ],
            [
                'product_id'=> 9,
                'image_detail' => 'hic_2.jpg',
                'ordering' => 2
            ],
            [
                'product_id'=> 10,
                'image_detail' => 'inject_fitting_1.jpg',
                'ordering' => 1
            ],
            [
                'product_id'=> 10,
                'image_detail' => 'inject_fitting_2.jpg',
                'ordering' => 2
            ],
            [
                'product_id'=> 11,
                'image_detail' => 'fabricated_fitting_1.jpg',
                'ordering' => 1
            ],
            [
                'product_id'=> 11,
                'image_detail' => 'fabricated_fitting_2.jpg',
                'ordering' => 2
            ],
            [
                'product_id'=> 12,
                'image_detail' => 'solvent_cement_1.jpg',
                'ordering' => 1
            ],
            [
                'product_id'=> 12,
                'image_detail' => 'solvent_cement_2.jpg',
                'ordering' => 2
            ],
            [
                'product_id'=> 13,
                'image_detail' => 'lubricant_1.jpg',
                'ordering' => 1
            ],
            [
                'product_id'=> 13,
                'image_detail' => 'lubricant_2.jpg',
                'ordering' => 2
            ],
        ]);
    }
}
