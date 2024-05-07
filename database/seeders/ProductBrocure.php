<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductBrocure extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('product_brocures')->insert([
            [
                'product_id'=> 1,
                // 'brocure_file'=> 'brosur_sni.pdf',
                'brocure_file'=> 'BROSUR PIPA uPVC SNI AIR BERSIH.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 2,
                // 'brocure_file'=> 'brosur_jacking.pdf',
                'brocure_file'=> 'BROSUR PIPA uPVC JIS.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 3,
                // 'brocure_file'=> 'brosur_pralon_standar.pdf',
                'brocure_file'=> 'BROSUR PIPA uPVC Pralon AWD.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 4,
                // 'brocure_file'=> 'brosur_jacking.pdf',
                'brocure_file'=> 'BROSUR PIPA JACKING.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 5,
                // 'brocure_file'=> 'brosur_pralon_coklat.pdf',
                'brocure_file'=> 'BROSUR PIPA uPVC SNI AIR BUANGAN.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 6,
                // 'brocure_file'=> 'brosur_hdpe.pdf',
                'brocure_file'=> 'BROSUR PIPA HDPE & SUBDUCT.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 7,
                // 'brocure_file'=> 'brosur_mdpe.pdf',
                'brocure_file'=> 'BROSUR PIPA GAS.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 8,
                // 'brocure_file'=> 'brosur_subduct.pdf',
                'brocure_file'=> 'BROSUR PIPA HDPE & SUBDUCT.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 9,
                'brocure_file'=> 'BROSUR PIPA HIC.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 10,
                // 'brocure_file'=> 'brosur_fitting.pdf',
                'brocure_file'=> 'BROSUR PIPA & FITTINGS PRALON.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 11,
                'brocure_file'=> 'BROSUR PIPA uPVC & FITTNGS SNI AIR BERSIH.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 12,
                'brocure_file'=> 'BROSUR PIPA & FITTINGS PRALON.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 13,
                'brocure_file'=> 'BROSUR PIPA uPVC SNI AIR BERSIH.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
