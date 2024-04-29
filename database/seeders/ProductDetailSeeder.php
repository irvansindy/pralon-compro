<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_products')->insert([
            [
                'product_id' => 1,
                'title' => 'Penyambungan',
                'subtitle' => '2 Metode Penyambungan Pipa uPVC SNI',
                'desc' => 'Metode Penyambungan Rubber Ring Joint digunakan pada pipa TS End proses ini melibatkan penggunaan cincin karet yang ditempatkan di sekitar ujung pipa. Saat dua ujung pipa bertemu, cincin karet memastikan kedap air dan kekokohan sambungan. Proses pemasangan relatif cepat dan sederhana, karena tidak memerlukan perlengkapan khusus atau keahlian khusus.
                Metode Penyambungan Solvent Cement Joint digunakan pada pipa Bell End menggunakan cairan perekat khusus yang disebut solvent cement. Prosesnya dimulai dengan membersihkan ujung pipa dan menyatukan kedua ujung pipa dengan menggunakan cairan perekat tersebut. Setelah itu, pipa dijepit bersama dan dibiarkan beberapa saat untuk mengering dan mengeras. Hasilnya adalah sambungan yang kuat dan tahan lama, yang juga kedap air.',
                'ordering' => 2,
            ],
            [
                'product_id' => 2,
                'title' => 'Penyambungan',
                'subtitle' => 'Metode Penyambungan Pipa uPVC JIS',
                'desc' => 'Metode Penyambungan Solvent Cement Joint digunakan pada pipa Bell End menggunakan cairan perekat khusus yang disebut solvent cement. Prosesnya dimulai dengan membersihkan ujung pipa dan menyatukan kedua ujung pipa dengan menggunakan cairan perekat tersebut. Setelah itu, pipa dijepit bersama dan dibiarkan beberapa saat untuk mengering dan mengeras.
                Solvent Cement Quick Dry untuk penyambungan pipa sampai ukuran <3” &  Solvent Cement Slow Dry untuk penyambungan pipa sampai ukuran >3”',
                'ordering' => 2,
            ],
            [
                'product_id' => 3,
                'title' => 'Penyambungan',
                'subtitle' => 'Metode Penyambungan Pipa uPVC JIS',
                'desc' => 'Metode Penyambungan Solvent Cement Joint digunakan pada pipa Bell End menggunakan cairan perekat khusus yang disebut solvent cement. Prosesnya dimulai dengan membersihkan ujung pipa dan menyatukan kedua ujung pipa dengan menggunakan cairan perekat tersebut. Setelah itu, pipa dijepit bersama dan dibiarkan beberapa saat untuk mengering dan mengeras.
                Solvent Cement Quick Dry untuk penyambungan pipa sampai ukuran <3” &  Solvent Cement Slow Dry untuk penyambungan pipa sampai ukuran >3”',
                'ordering' => 2,
            ],
            [
                'product_id' => 4,
                'title' => 'Penyambungan',
                'subtitle' => 'Metode Penyambungan Pipa uPVC Jacking',
                'desc' => 'Pipa Jacking dipasang dengan menggunakan sistem jacking, merupakan metode pemasangan jaringan pipa untuk saluran air buangan yang berada di bawah tanah dengan pemasangannya dilakukan dengan mengebor tanah dari titik awal (starting pit) sampai ke titik akhir (arriving pit), tanpa ada galian di permukaan tanah.',
                'ordering' => 2,
            ],
            [
                'product_id' => 5,
                'title' => 'Penyambungan',
                'subtitle' => '2 Metode Penyambungan Pipa uPVC SNI',
                'desc' => 'Metode Penyambungan Rubber Ring Joint digunakan pada pipa TS End proses ini melibatkan penggunaan cincin karet yang ditempatkan di sekitar ujung pipa. Saat dua ujung pipa bertemu, cincin karet memastikan kedap air dan kekokohan sambungan. Proses pemasangan relatif cepat dan sederhana, karena tidak memerlukan perlengkapan khusus atau keahlian khusus.
                Metode Penyambungan Solvent Cement Joint digunakan pada pipa Bell End menggunakan cairan perekat khusus yang disebut solvent cement. Prosesnya dimulai dengan membersihkan ujung pipa dan menyatukan kedua ujung pipa dengan menggunakan cairan perekat tersebut. Setelah itu, pipa dijepit bersama dan dibiarkan beberapa saat untuk mengering dan mengeras. Hasilnya adalah sambungan yang kuat dan tahan lama, yang juga kedap air.',
                'ordering' => 2,
            ],
            [
                'product_id' => 6,
                'title' => 'Penyambungan',
                'subtitle' => 'Metode Penyambungan Pipa SNI HDPE',
                'desc' => 'Pipa SNI HDPE memiliki 5 metode dalam penyambungannya, Metode-metode ini memberikan sambungan yang kokoh dan tahan lama, sesuai untuk berbagai aplikasi termasuk distribusi air, sistem saluran pembuangan, dan proyek-proyek industri.',
                'ordering' => 2,
            ],
            [
                'product_id' => 7,
                'title' => 'Penyambungan',
                'subtitle' => 'Metode Penyambungan Pipa GAS MDPE',
                'desc' => 'Penyambungan pipa gas adalah proses krusial dalam memastikan keamanan dan keandalan sistem distribusi gas. Teknik yang umum digunakan meliputi penyambungan dengan las atau fusion, koneksi mekanis menggunakan fitting khusus, serta penyambungan yang tahan terhadap tekanan tinggi. Proses ini memerlukan kehati-hatian ekstra dan pemenuhan standar keselamatan yang ketat untuk mencegah kebocoran gas yang berpotensi berbahaya. Keselamatan menjadi prioritas utama dalam penyambungan pipa gas untuk memastikan perlindungan terhadap masyarakat dan lingkungan sekitar.',
                'ordering' => 2,
            ],
            [
                'product_id' => 8,
                'title' => 'Penyambungan',
                'subtitle' => 'Metode Penyambungan Pipa Subduct Telekomunikasi',
                'desc' => 'Penyambungan pipa Subduct Telekomunikasi adalah proses penting dalam infrastruktur telekomunikasi yang melibatkan penggabungan dua ujung pipa subduct untuk memungkinkan aliran kabel serat optik atau kabel telekomunikasi lainnya. Penyambungan pipa subduct memainkan peran krusial dalam membangun jaringan telekomunikasi yang andal dan efisien, memastikan kelancaran aliran data dan komunikasi di seluruh wilayah yang terhubung.',
                'ordering' => 2,
            ],
            [
                'product_id' => 9,
                'title' => 'Penyambungan',
                'subtitle' => 'Metode Penyambungan Pipa HIC (High Impact Conduit)',
                'desc' => 'Metode penyambungan pipa conduit listrik melibatkan beberapa teknik untuk menghubungkan dua atau lebih pipa conduit listrik secara aman dan efektif. Salah satu metode yang umum digunakan adalah koneksi mekanis menggunakan fitting khusus, yang dapat berupa T Dus cabang 1, cabang 2, cabang 3 dll, untuk menyambungkan ujung-ujung pipa secara langsung. Metode ini relatif cepat dan mudah dilakukan, serta memberikan sambungan yang kuat dan stabil.',
                'ordering' => 2,
            ],
            [
                'product_id' => 10,
                'title' => 'Penyambungan',
                'subtitle' => 'Metode Penyambungan Injection Fitting',
                'desc' => 'Metode Penyambungan Solvent Cement Joint digunakan pada pipa Bell End menggunakan cairan perekat khusus yang disebut solvent cement. Prosesnya dimulai dengan membersihkan ujung pipa dan menyatukan kedua ujung pipa dengan menggunakan cairan perekat tersebut. Setelah itu, pipa dijepit bersama dan dibiarkan beberapa saat untuk mengering dan mengeras.

                Solvent Cement Quick Dry untuk penyambungan pipa sampai ukuran <3” &  Solvent Cement Slow Dry untuk penyambungan pipa sampai ukuran >3”',
                'ordering' => 2,
            ],
            [
                'product_id' => 11,
                'title' => 'Penyambungan',
                'subtitle' => 'Metode Penyambungan Fabricated Fitting',
                'desc' => 'Metode Penyambungan Rubber Ring Joint digunakan pada pipa TS End proses ini melibatkan penggunaan cincin karet yang ditempatkan di sekitar ujung pipa. Saat dua ujung pipa bertemu, cincin karet memastikan kedap air dan kekokohan sambungan. Proses pemasangan relatif cepat dan sederhana, karena tidak memerlukan perlengkapan khusus atau keahlian khusus. 

                Metode Penyambungan Solvent Cement Joint digunakan pada pipa Bell End menggunakan cairan perekat khusus yang disebut solvent cement. Prosesnya dimulai dengan membersihkan ujung pipa dan menyatukan kedua ujung pipa dengan menggunakan cairan perekat tersebut. Setelah itu, pipa dijepit bersama dan dibiarkan beberapa saat untuk mengering dan mengeras. Hasilnya adalah sambungan yang kuat dan tahan lama, yang juga kedap air.',
                'ordering' => 2,
            ],
            [
                'product_id' => 12,
                'title' => 'Penyambungan',
                'subtitle' => 'Metode Penyambungan Rubber-Ring Joint System',
                'desc' => 'Metode Penyambungan Rubber Ring Joint digunakan pada pipa TS End proses ini melibatkan penggunaan cincin karet yang ditempatkan di sekitar ujung pipa. Saat dua ujung pipa bertemu, dioleskan dengan lubricant, cincin karet memastikan kedap air dan kekokohan sambungan. Proses pemasangan relatif cepat dan sederhana, karena tidak memerlukan perlengkapan khusus atau keahlian khusus.',
                'ordering' => 2,
            ],
            [
                'product_id' => 13,
                'title' => 'Penyambungan',
                'subtitle' => 'Metode Penyambungan Rubber-Ring Joint System',
                'desc' => 'Metode Penyambungan Rubber Ring Joint digunakan pada pipa TS End proses ini melibatkan penggunaan cincin karet yang ditempatkan di sekitar ujung pipa. Saat dua ujung pipa bertemu, dioleskan dengan lubricant, cincin karet memastikan kedap air dan kekokohan sambungan. Proses pemasangan relatif cepat dan sederhana, karena tidak memerlukan perlengkapan khusus atau keahlian khusus.',
                'ordering' => 2,
            ],
        ]);
    }
}
