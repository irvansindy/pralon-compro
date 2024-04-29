<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_categories')->insert([
            [
                'name' => 'uPVC',
                'ordering' => 1,
            ],
            [
                'name' => 'PE',
                'ordering' => 2,
            ],
            [
                'name' => 'Fitting',
                'ordering' => 3,
            ],
            [
                'name' => 'Aksesoris',
                'ordering' => 4,
            ],
        ]);
    }
}
