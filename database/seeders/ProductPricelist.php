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
                // 'price_list_file'=> 'pricelist_sni.pdf',
                'price_list_file'=> 'DAFTAR HARGA PIPA uPVC SNI ABU & COKLAT.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 2,
                // 'price_list_file'=> 'pricelist_jacking.pdf',
                'price_list_file'=> 'PRICE LIST DAFTAR HARGA PRALON.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 3,
                // 'price_list_file'=> 'pricelist_pralon_standar.pdf',
                'price_list_file'=> 'PRICE LIST DAFTAR HARGA PRALON.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 4,
                // 'price_list_file'=> 'pricelist_jacking.pdf',
                'price_list_file'=> 'DAFTAR HARGA PIPA JACKING.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 5,
                // 'price_list_file'=> 'pricelist_pralon_coklat.pdf',
                'price_list_file'=> 'PRICE LIST PIPA uPVC SNI ABU & COKLAT.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 6,
                // 'price_list_file'=> 'pricelist_hdpe.pdf',
                'price_list_file'=> 'PRICE LIST PIPA HDPE.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 7,
                // 'price_list_file'=> 'pricelist_mdpe.pdf',
                'price_list_file'=> 'PRICE LIST PIPA GAS.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 8,
                // 'price_list_file'=> 'pricelist_subduct.pdf',
                'price_list_file'=> 'PRICE LIST PIPA HDPE.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 9,
                // 'price_list_file'=> 'pricelist_hic.pdf',
                'price_list_file'=> 'PRICE LIST PIPA HIC.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 10,
                // 'price_list_file'=> 'pricelist_fitting.pdf',
                'price_list_file'=> 'PRICE LIST DAFTAR HARGA PRALON.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 11,
                // 'price_list_file'=> 'pricelist_fabricated.pdf',
                'price_list_file'=> 'PRICE LIST FABRICATED FITTINGS PRALON 10 JANUARI 2023.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 12,
                'price_list_file'=> 'PRICE LIST DAFTAR HARGA PRALON.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
