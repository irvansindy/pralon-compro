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
                'brocure_file'=> 'brosur_sni.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 2,
                'brocure_file'=> 'brosur_jacking.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 3,
                'brocure_file'=> 'brosur_pralon_standar.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 4,
                'brocure_file'=> 'brosur_jacking.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 5,
                'brocure_file'=> 'brosur_pralon_coklat.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 6,
                'brocure_file'=> 'brosur_hdpe.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 7,
                'brocure_file'=> 'brosur_mdpe.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 8,
                'brocure_file'=> 'brosur_subduct.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 9,
                'brocure_file'=> 'brosur_hic.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 10,
                'brocure_file'=> 'brosur_fitting.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 11,
                'brocure_file'=> 'brosur_fabricated.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 12,
                'brocure_file'=> 'brosur_solvent_cement.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
            [
                'product_id'=> 13,
                'brocure_file'=> 'brosur_lubricant.pdf',
                'status'=> 'active',
                'date'=> date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
