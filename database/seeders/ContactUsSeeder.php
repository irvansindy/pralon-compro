<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("contact_us")->insert([
            [
                "name"=> "Kantor Pusat",
                "address"=> "Head office Synergy Building #08-08 Jl. Jalur Sutera Barat 17, Alam Sutera Serpong Tangerang 15143 Indonesia",
                "email"=> "info@pralon.com",
                "phone_number"=> "(021) 304 38808",
                "fax"=> "(021) 304 38801",
                "image"=> "Head Office.jpg",
            ],
            [
                "name"=> "Pabrik 1",
                "address"=> "Jl. Raya Bogor KM. 32,5 Cimanggis, Depok",
                "email"=> "info@pralon.com",
                "phone_number"=> "(021) 874 1028",
                "fax"=> "(021) 874 0913",
                "image"=> "Pabrik 1.jpg",
            ],
            [
                "name"=> "Pabrik 2",
                "address"=> "Dusun Gintung Kebon RT 12&13 RW 03 Desa Gintung Kerta, Kec. Klari-41371, Kab. Karawang, Jawa Barat",
                "email"=> "info@pralon.com",
                "phone_number"=> "(021) 874 1028",
                "fax"=> "(021) 874 0913",
                "image"=> "Pabrik 2.jpg",
            ],
            [
                "name"=> "Gudang",
                "address"=> "Jl. Bhayangkara No. 02 Kawasan Pergudangan T8 Alam Sutera, Serpong – Tangerang",
                "email"=> "info@pralon.com",
                "phone_number"=> "(021) 2900 5111",
                "fax"=> "(021) 2900 5116",
                "image"=> "Gudang.jpg",
            ],
        ]);
    }
}
