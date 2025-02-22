<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("news")->insert([
            [
                'news_category_id' => 1,
                'title'=> '3 LANGKAH CEPAT INSTALASI HIDROPONIK DI RUMAHMU!',
                'image' => 'storage/uploads/news_blog/head-1.jpg',
                'short_desc' => 'Ingin menanam sayuran segar di rumah tanpa perlu kebun yang luas? Hidroponik bisa menjadi solusinya! 
                ',
                'content'=> 'Ingin menanam sayuran segar di rumah tanpa perlu kebun yang luas? Hidroponik bisa menjadi solusinya! 
                Metode bertanam ini semakin populer karena tidak memerlukan tanah sebagai media tumbuhnya.
                
                Hidroponik adalah teknik berkebun yang tidak menggunakan tanah melainkan menanam tanaman dalam larutan air dan nutrisi. 
                
                Teknik hidroponik dapat menumbuhkan tanaman dan sayuran lebih cepat daripada menanam di luar ruangan di tanah.
                
                Tanaman yang ditanam secara hidroponik seringkali memberikan hasil yang lebih banyak, membutuhkan lebih sedikit ruang, dan menggunakan lebih sedikit air dibandingkan dengan berkebun menggunakan tanah.
                
                Kelebihan Hidroponik
                menanam dengan teknik hidroponik dapat menjadi solusi bagi kamu yang tidak memiliki lahan luas untuk bercocok tanam. Selain itu umur tanaman juga biasanya lebih cepat sehingga kamu bisa lebih cepat panen dengan tanaman yang tidak kalah berkualitas jika dibandingkan dengan metode tanam konvensional. 
                
                Persiapkan Alat dan Bahan
                Pastikan menggunakan pipa uPVC merek Pralon terbuat dari bahan berkualitas tinggi, yang dapat tahan terhadap korosi dan suhu ekstrem.
                
                
                Bangun Sistem Hidroponik
                Rencanakan desain sistem hidroponik Anda, termasuk lokasi penempatan pipa, jumlah tanaman, dan aliran air yang diinginkan. 
                
                
                Tanam dan Perawatan
                Setelah sistem sudah terbukti berfungsi dengan baik, tanam tanaman Anda ke dalam media tumbuh hidroponik yang dibuat, dan lakukan penyiraman secara berkala untuk menjaga kelembapan media tanam dan akar tanaman.
                
                Ini dia beberapa tips bercocok tanam hidroponik untuk pemula. Selain hemat dan bisa diletakkan di mana saja, kamu jadi bisa memasak sayuran dan mengonsumsi buah-buahan dari hasil panen di rumah sendiri. Selamat mencoba ya Praloners, semoga berhasil.',
                'date'=> date('Y-m-d H:i:s'),
                'created_at'=> date('Y-m-d H:i:s'),
            ],
            [
                'news_category_id' => 1,
                'title'=> 'TIPS : Cara Mengatasi Wastafel Pipa Yang Bocor',
                'image' => 'storage/uploads/news_blog/head-2.jpg',
                'short_desc'=> 'Wastafel yang bocor bisa menjadi masalah banget, berikut adalah tips untuk mengatasi wastafel yang bocor
.                ',
                'content'=> 'Wastafel yang bocor bisa menjadi masalah yang menjengkelkan di rumah. Kebocoran ini tidak hanya mengganggu, tetapi juga dapat menyebabkan pemborosan air dan merusak struktur wastafel dan area sekitarnya jika dibiarkan terlalu lama. Namun, jangan khawatir, kebocoran wastafel bisa diatasi dengan beberapa langkah sederhana. Berikut adalah tips untuk mengatasi wastafel yang bocor:

                Matikan Suplai Air ke Tempat Cuci Piring
                Mematikan suplai air ke tempat cuci piring diperlukan disaat melakukan pemeliharaan rutin atau perbaikan pada peralatan tersebut. Dengan mematikan suplai air, Kita dapat bekerja dengan aman tanpa khawatir air mengalir atau menyebabkan kelembaban berlebih di area kerja.
                
                
                Periksa Bagian Pipa yang Bocor
                Periksa dengan teliti area di sekitar wastafel untuk menemukan tempat kebocoran berasal. Biasanya kebocoran dapat terjadi di sekitar keran, sambungan pipa, atau di bagian bawah wastafel.
                
                
                Kencangkan Sekrup yang Longgar di Pipa atau Keran
                mengencangkan sekrup yang longgar di pipa atau keran merupakan langkah penting dalam pemeliharaan rutin sistem air di rumah. Ini membantu mencegah kebocoran, mengurangi pemborosan air, menghindari kerusakan lebih lanjut, meningkatkan keamanan, dan meningkatkan efisiensi sistem air.
                
                
                Mengganti Pipa yang Bocor dengan Menggunakan Pipa Merek Pralon. 
                Dengan mengganti pipa yang bocor dengan menggunakan pipa merek Pralon, dapat meyakinan bahwa sistem pipa diperbarui dengan produk berkualitas tinggi yang tahan lama dan handal. Ini membantu mencegah kebocoran di masa depan dan menjaga kinerja sistem pipa dengan baik.
                
                
                Gunakan Solvent Cement untuk Menambah Perlindungan Terhadap Sambungan dan Fitting Pipa.
                Salah satu manfaat utama dari menggunakan solvent cement adalah mencegah kebocoran air pada sambungan pipa. Ketika solvent cement mengering dan menyatu dengan material pipa, ia membentuk lapisan kedap air yang efektif di sekitar sambungan. Ini membantu menjaga integritas sistem pipa dan mencegah kebocoran yang tidak diinginkan.
                
                Setelah melakukan perbaikan, periksa kembali wastafel untuk memastikan bahwa kebocoran sudah tidak ada lagi. Nyalakan kembali air dan perhatikan apakah ada tanda-tanda kebocoran. Jika masih ada kebocoran, ulangi langkah-langkah perbaikan.
                .
                Dengan mengikuti langkah-langkah di atas, Anda dapat mengatasi kebocoran wastafel dengan mudah dan efektif. Ingatlah untuk melakukan pemeliharaan rutin pada wastafel dan peralatan sanitasi lainnya di rumah Anda untuk mencegah terjadinya masalah kebocoran di masa mendatang.
                ',
                'date'=> date('Y-m-d H:i:s'),
                'created_at'=> date('Y-m-d H:i:s'),
            ],
            [
                'news_category_id' => 1,
                'title'=> 'AWAS KORSLETING DI RUMAHMU!',
                'image' => 'storage/uploads/news_blog/head-3.jpg',
                'short_desc'=> 'Korsleting listrik merupakan salah satu bahaya yang sering terjadi di rumah dan dapat menyebabkan kebakaran, kerusakan, bahkan cedera fisik.
                ',
                'content'=> 'Korsleting listrik merupakan salah satu bahaya yang sering terjadi di rumah dan dapat menyebabkan kebakaran, kerusakan, bahkan cedera fisik. 


                Korsleting terjadi ketika dua kabel listrik berbeda polaritas menyentuh satu sama lain, 
                yang dapat mengakibatkan arus listrik yang berlebihan dan menyebabkan panas yang cukup untuk membakar bahan sekitarnya. 
                
                
                Berikut adalah beberapa bahaya korsleting di rumah dan langkah-langkah yang dapat diambil untuk mencegahnya:
                
                
                Pilih Produk yang Berkualitas. 
                Pilih produk listrik dan elektronik yang berkualitas dan terpercaya dari merek Pralon. Produk berkualitas cenderung lebih aman dan tahan lama.
                
                
                Periksa dan Perawatan Rutin.
                Lakukan pemeriksaan rutin pada instalasi listrik rumah Anda oleh ahli listrik terampil. Pastikan kabel-kabel listrik dalam kondisi baik dan tidak rusak atau terkelupas.
                
                
                Lindungi Stop Kontak.
                Pasang pelindung stop kontak untuk mencegah anak-anak atau hewan peliharaan dari kontak langsung dengan stop kontak dan mencegah benda-benda kecil masuk ke dalamnya.
                
                Korsleting listrik adalah bahaya serius yang dapat menyebabkan kebakaran, kerusakan peralatan, dan bahkan cedera fisik. Untuk mencegah risiko korsleting di rumah Anda, penting untuk melakukan perawatan rutin, menggunakan peralatan yang tepat, menghindari overloading stop kontak, dan memilih produk listrik yang berkualitas. 
                
                Dengan langkah-langkah pencegahan yang tepat, Anda dapat mengurangi risiko korsleting dan menjaga keamanan serta kesejahteraan keluarga Anda.
                ',
                'date'=> date('Y-m-d H:i:s'),
                'created_at'=> date('Y-m-d H:i:s'),
            ],
            [
                'news_category_id' => 2,
                'title'=> 'ALASAN HARUS KENAPA PAKAI PIPA PRALON',
                'image' => 'storage/uploads/news_blog/head-4.jpg',
                'short_desc' => 'Pipa Pralon telah menjadi pilihan utama bagi banyak orang dalam proyek konstruksi dan renovasi.',
                'content'=> 'Pipa Pralon telah menjadi pilihan utama bagi banyak orang dalam proyek konstruksi dan renovasi. Dikenal karena keandalannya dan kemudahan penggunaannya, pipa Pralon menawarkan sejumlah keuntungan yang membuatnya layak dipertimbangkan dalam berbagai proyek pipa. 


                Berikut adalah beberapa alasan mengapa Anda harus mempertimbangkan untuk menggunakan pipa Pralon: 
                
                
                Kuat Berkualitas 
                Pipa Pralon terkenal karena kualitasnya yang terjamin. Dibuat dari bahan PVC (Polyvinyl Chloride) yang berkualitas tinggi, pipa Pralon tahan terhadap korosi, tahan terhadap tekanan tinggi, dan tidak mudah retak atau pecah. Dengan menggunakan pipa Pralon, Anda dapat yakin sistem pipa Anda akan bertahan dalam jangka waktu yang lama tanpa perlu khawatir akan masalah seperti kebocoran atau kerusakan struktural.
                
                
                Bebas TImbal
                Pipa Pralon juga diproduksi menggunakan bahan bebas timbal yang baik untuk kesehatan keluarga dirumah, Selain itu, memilih produk yang bebas timbal seringkali tidak hanya menguntungkan kesehatan, tetapi juga lingkungan. 
                Dengan menggunakan bahan-bahan ramah lingkungan dan bebas timbal, Anda ikut berkontribusi dalam upaya menjaga keberlanjutan lingkungan.
                
                
                Harga Kompetitif
                Bukan hanya karena kuat dan berkualitas, serta bahan yang digunakan anti timbal tetapi Pipa Pralon juga memberikan nilai yang baik dengan harga yang kompetitif, menjadikannya pilihan yang populer bagi banyak konsumen dalam proyek konstruksi dan renovasi.
                
                Dengan berbagai keuntungan yang ditawarkannya, tidaklah mengherankan mengapa pipa Pralon menjadi pilihan favorit bagi banyak orang dalam proyek konstruksi dan renovasi. Dari kualitas terjamin hingga kemudahan penggunaannya, pipa Pralon menawarkan solusi yang handal dan efisien untuk kebutuhan pipa Anda.
                ',
                'date'=> date('Y-m-d H:i:s'),
                'created_at'=> date('Y-m-d H:i:s'),
            ],
            [
                'news_category_id' => 4,
                'title'=> 'CIRI-CIRI TUKANG GREEN FLAG',
                'image' => 'storage/uploads/news_blog/head-5.jpg',
                'short_desc' => 'Bingung banget kalau ada kebutuhan untuk instalasi pipa di rumah tapi cari tukang yang cocok & bagus itu seperti apa?',
                'content'=> 'Banyak orang mencari solusi ramah lingkungan untuk berbagai kebutuhan, termasuk dalam bidang konstruksi dan perbaikan rumah. 


                Salah satu tren yang semakin berkembang adalah penggunaan bahan dan teknik yang ramah lingkungan dalam proyek pembangunan dan perbaikan rumah. 
                
                
                Di tengah tren ini, muncullah "tukang Greenflag" – para profesional yang ahli dalam perbaikan rumah dengan menggunakan bahan-bahan ramah lingkungan. 
                
                
                Berikut adalah beberapa ciri-ciri tukang Greenflag:
                
                Keselamatan Kerja Nomor Satu
                Dengan menerapkan praktik keselamatan kerja yang tepat, kita dapat mengurangi risiko terjadinya kecelakaan dan cedera di tempat kerja. Selain itu Keselamatan kerja yang baik juga berdampak positif pada produktivitas.
                
                
                Tetap Semangat & Pantang Menyerah
                Menghadapi masalah teknis atau proyek yang rumit merupakan hal yang sering dialami ketika sedang mengerjakan proyek. Namun dengan semangat dan keteguhan hati juga dapat memunculkan ide atau solusi yang kreatif dan efektif untuk mengatasi tantangan tersebut, sehingga proyek dapat diselesaikan dengan sukses.
                
                Skill Kerja Yang Luar Biasa
                Tukang yang terampil biasanya dikenal karena ketepatan dan konsistensi dalam pekerjaan mereka. Mereka bekerja dengan teliti dan teliti, memastikan bahwa setiap detail diproses dengan baik dan sesuai dengan standar kualitas yang tinggi.
                
                Pakai Produk Yang Berkualitas
                Dengan menggunakan pipa Pralon. Anda dapat memiliki keyakinan bahwa sistem pipa Anda dibangun dengan bahan berkualitas tinggi yang tahan lama dan handal. 
                Ini memberikan jaminan kualitas dalam jangka panjang untuk proyek konstruksi Anda.
                
                Dengan ciri-ciri di atas, Anda dapat lebih mudah mengidentifikasi tukang Greenflag yang cocok untuk proyek konstruksi atau perbaikan rumah Anda. 
                
                
                Dengan menggunakan jasa tukang Greenflag, Anda tidak hanya mendapatkan hasil yang berkualitas, tetapi juga berkontribusi pada perlindungan lingkungan dan pembangunan yang berkelanjutan.',
                'date'=> date('Y-m-d H:i:s'),
                'created_at'=> date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
