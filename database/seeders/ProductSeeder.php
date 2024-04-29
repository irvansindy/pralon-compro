<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'category_id' => 1,
                'name' => 'Pipa uPVC SNI',
                'full_name' => 'Pipa uPVC SNI Air Bersih',
                'slug' => Str::of('Pipa uPVC SNI')->slug('-'),
                'short_desc' => 'Dibuat dari bahan baku Polyvinyl Chloride (PVC) dengan standar SNI.',
                'main_desc' => 'Pipa uPVC SNI adalah produk pipa dari bahan baku polyvinyl chloride (PVC) yang diproduksi PT. PRALON berdasarkan Standar Nasional Indonesia (SNI). Dengan karakter pipa yang kuat, bebas timbal, lentur dan tidak mudah rusak/pecah. ',
                'image' => 'uPVC_sni.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Pipa Gold JIS',
                'full_name' => 'Pipa uPVC JIS',
                'slug' => Str::of('Pipa Gold JIS')->slug('-'),
                'short_desc' => 'Untuk aplikasi air bersih dan air buangan digunakan di rumah tinggal, apartemen dan prasarana lainnya.',
                'main_desc' => 'Pipa uPVC JIS dengan bahan dasar yang terbuat dari polyvinyl chloride (PVC) mengikuti standar JIS (Japanese Industrial Standards. Pipa uPVC JIS biasa digunakan dalam berbagai aplikasi seperti air bersih, saluran pembuangan, dan sistem irigasi. Tahan terhadap kebocoran, dan tahan terhadap tekanan tinggi, kuat dan berkualitas. Pipa uPVC JIS Pralon tersedia dalam berbagai ukuran dan jenis yaitu Pipa uPVC JIS VP & VU.',
                'image' => 'pipa_jis.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Pralon Standard',
                'full_name' => 'Pipa uPVC Pralon',
                'slug' => Str::of('Pralon Standard')->slug('-'),
                'short_desc' => 'Pipa dengan kualitas terbaik, karakteristik kuat, ringan, bebas timbal dan mudah dalam pemasangan.',
                'main_desc' => 'Pipa uPVC kelas AW & D merek Pralon adalah pipa dengan kualitas terbaik, karakteristik kuat, ringan, anti korosi, mudah dalam pemasangan, bebas timbal dan sangat cocok digunakan untuk air bersih dan air buangan.',
                'image' => 'uPVC_pralon.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Pralon Jacking',
                'full_name' => 'Pipa uPVC Jacking',
                'slug' => Str::of('Pralon Jacking')->slug('-'),
                'short_desc' => 'Untuk air bungan limbah, dengan metode jacking tanpa ada galian di permukaan tanah.',
                'main_desc' => 'Pipa uPVC Jacking adalah jenis pipa uPVC yang dirancang khusus untuk digunakan dalam proses pengeboran atau penggalian bawah tanah, seperti dalam proyek pembuatan terowongan atau instalasi pipa di bawah jalan raya. Pipa ini memiliki karakteristik khusus yang membuatnya cocok untuk kondisi pengeboran atau penggalian yang sulit, termasuk ketahanan terhadap tekanan tanah yang tinggi dan kemampuan untuk menahan gaya geser yang kuat tanpa retak atau pecah.',
                'image' => 'jacking.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Pipa uPVC SNI Coklat',
                'full_name' => 'Pipa uPVC SNI Air Buangan',
                'slug' => Str::of('Pipa uPVC SNI Coklat')->slug('-'),
                'short_desc' => 'Untuk berbagai kebutuhan air limbah rumah tangga, industri maupun prasarana lainnya.',
                'main_desc' => 'Pipa uPVC SNI Air Buangan digunakan untuk saluran pembuangan dengan standard SNI dan dengan bahan polyvinyl chloride (PVC) dapat digunakan untuk berbagai kebutuhan air limbah rumah tangga, industri maupun prasarana lainnya.',
                'image' => 'uPVC_coklat.png'
            ],
            [
                'category_id' => 2,
                'name' => 'Pralon HDPE',
                'full_name' => 'Pipa uPVC SNI HDPE',
                'slug' => Str::of('Pralon HDPE')->slug('-'),
                'short_desc' => 'Memiliki sifat yang lentur, tidak  mudah retak, ringan dan umur pakai yang sangat panjang.',
                'main_desc' => 'Pipa SNI HDPE (High Density Polyethylene) adalah pipa yang memiliki sifat lentur, tidak mudah retak atau pecah, ringan, anti korosi, tahan terhadap cuaca, umur pakai yang sangat panjang.',
                'image' => 'hdpe.png'
            ],
            [
                'category_id' => 2,
                'name' => 'Pralon MDPE',
                'full_name' => 'Pipa GAS MDPE',
                'slug' => Str::of('Pralon MDPE')->slug('-'),
                'short_desc' => 'Digunakan untuk pipanisasi gas untuk industri, perumahan, dan prasana umum.',
                'main_desc' => 'Pipa Gas merek Pralon menggunakan material MDPE(PE-80) warna kuning dan material HDPE (PE-100) warna oranye. Pipa Gas merek Pralon digunakan untuk pipanisasi gas untuk industri, perumahan, dan prasarana umum lainnya.',
                'image' => 'pipa_gas.png'
            ],
            [
                'category_id' => 2,
                'name' => 'Pralon Subduct',
                'full_name' => 'Pipa Subduct Telekomunikasi',
                'slug' => Str::of('Pralon Subduct')->slug('-'),
                'short_desc' => 'Digunakan sebagai pelindung kabel fiber-optic (FO) pada jaringan telekomunikasi.',
                'main_desc' => 'Pipa subduct telekomunikasi dengan bahan dasar HDPE digunakan sebagai pelindung kabel fiber optic (FO) pada jaringan telekomunikasi. Pipa subduct melindungi kabel-kabel fiber optic dan juga mempermudah pemasangan maupun perawatan.',
                'image' => 'subduct.png'
            ],
            [
                'category_id' => 2,
                'name' => 'Pralon HIC',
                'full_name' => 'Pipa HIC (High Impact Conduit)',
                'slug' => Str::of('Pralon HIC')->slug('-'),
                'short_desc' => 'Sebagai pelindung kabel Listrik dan kabel elektronik, sehingga aman dan rapi terpasang.',
                'main_desc' => 'Pipa HIC diperuntukan untuk pipa pelindung kabel listrik dan kabel elektronik, sehingga jaringan kabel listrik maupun elektronik aman dan rapi terpasang. Pipa HIC dapat dibengkokan dengan arah kabel dan tidak mengahantarkan api.',
                'image' => 'hic.jpg'
            ],
            [
                'category_id' => 3,
                'name' => 'Injection Fitting',
                'full_name' => 'Injection Fitting',
                'slug' => Str::of('Injection Fitting')->slug('-'),
                'short_desc' => 'Diproduksi dengan system injection moulding memberikan jaminan kekuatan dan keakuratan.',
                'main_desc' => 'Fittings, yang sering disebut sebagai sambungan pipa, diproduksi sesuai dengan standar JIS (Japanese Industrial Standards), yang menetapkan persyaratan teknis dan kualitas yang harus dipenuhi oleh produk tersebut. Diproduksi menggunakan sistem injection moulding, di mana bahan mentah dilelehkan dan diinjeksikan ke dalam cetakan untuk membentuk fitting sesuai dengan desain yang diinginkan.',
                'image' => 'injection_fittings.jpg'
            ],
            [
                'category_id' => 3,
                'name' => 'Handmade Fitting',
                'full_name' => 'Fabricated Fitting',
                'slug' => Str::of('Handmade Fitting')->slug('-'),
                'short_desc' => 'Dirancang untuk dapat memenuhi segala kebutuhan instalasi pipa dengan efesiensi dan akurasi yang tertinggi.',
                'main_desc' => 'Fabricated fitting atau handmade fitting adalah komponen krusial dalam sistem pipa yang diproduksi dengan proses fabrikasi khusus dengan Standar SNI. Dibandingkan dengan fitting standar yang diproduksi secara massal, fabricated fitting dibuat secara individual sesuai dengan spesifikasi yang ditentukan untuk aplikasi tertentu. Proses fabrikasi ini melibatkan pemotongan, pengelasan, dan penyambungan material pipa yang telah dipilih sesuai dengan kebutuhan proyek.',
                'image' => 'fabricated_fittings.jpg'
            ],
            [
                'category_id' => 4,
                'name' => 'Solvent Cement',
                'full_name' => 'Solvent Cement',
                'slug' => Str::of('Solvent Cement')->slug('-'),
                'short_desc' => 'Sebagai perekat senyawa yang menyatukan baik pipa maupun dengan sambungannya.',
                'main_desc' => 'Sebagai perekat senyawa yang menyatukan baik pipa maupun dengan sambungannya.',
                'image' => 'solvent_cement.jpg'
            ],
            [
                'category_id' => 4,
                'name' => 'Lubricant',
                'full_name' => 'Lubricant',
                'slug' => Str::of('Lubricant')->slug('-'),
                'short_desc' => 'Pelumas ramah lingkungan digunakan pada sambungan rubber-ring joint system.',
                'main_desc' => 'Lubricant adalah produk pelumas ramah lingkungan, khusus yang digunakan dalam proses pemasangan pipa PVC sambungan rubber-ring joint system untuk mempermudah masuknya pipa ke dalam fitting atau koneksi lainnya. Dibuat dengan formula yang dirancang khusus untuk kompatibilitas dengan material PVC, lubricant ini membantu mengurangi gesekan antara permukaan pipa dan fitting saat disambungkan.',
                'image' => 'lubricant.jpg'
            ],
        ]);
    }
}
