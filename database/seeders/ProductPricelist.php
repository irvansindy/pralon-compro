<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductPricelist extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_price_lists')->insert([
            [
                'product_id'=> 1,
                'price_list_file'=> 'pricelist_sni.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 2,
                'price_list_file'=> 'pricelist_jacking.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 3,
                'price_list_file'=> 'pricelist_pralon_standar.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 4,
                'price_list_file'=> 'pricelist_jacking.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 5,
                'price_list_file'=> 'pricelist_pralon_coklat.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 6,
                'price_list_file'=> 'pricelist_hdpe.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 7,
                'price_list_file'=> 'pricelist_mdpe.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 8,
                'price_list_file'=> 'pricelist_subduct.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 9,
                'price_list_file'=> 'pricelist_hic.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 10,
                'price_list_file'=> 'pricelist_fitting.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 11,
                'price_list_file'=> 'pricelist_fabricated.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 12,
                'price_list_file'=> 'pricelist_solvent_cement.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
