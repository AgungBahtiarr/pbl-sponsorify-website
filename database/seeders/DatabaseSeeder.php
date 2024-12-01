<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use App\Models\PaymentStatus;
use App\Models\Role;
use App\Models\Sponsor;
use App\Models\Status;
use App\Models\User;
use App\Models\WithdrawStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //Role
        Role::create([
            'role' => 'Event Organizer'
        ]);

        Role::create([
            'role' => 'Sponsor'
        ]);

        Role::create([
            'role' => 'Admin'
        ]);

        //User
        User::create([
            'name' => 'Adam Berkah',
            'email' => 'ab@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 1
        ]);

        User::create([
            'name' => 'Sponsor',
            'email' => 'sponsor@gmail.com',
            'password' => bcrypt('sponsor123'),
            'id_role' => 2
        ]);

        User::create([
            'name' => 'JNT',
            'email' => 'j@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 2
        ]);

        User::create([
            'name' => 'Butterfly cafe',
            'email' => 'b@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 2
        ]);

        User::create([
            'name' => 'Ria Busana',
            'email' => 'r@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 2
        ]);

        User::create([
            'name' => 'Honda',
            'email' => 'h@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 2
        ]);

        User::create([
            'name' => 'Eiger',
            'email' => 'e@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 2
        ]);

        User::create([
            'name' => 'JCO',
            'email' => 'jc@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 2
        ]);

        User::create([
            'name' => 'Roxy',
            'email' => 'rx@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 2
        ]);

        User::create([
            'name' => 'Toko Elektronik',
            'email' => 'te@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 2
        ]);

        User::create([
            'name' => 'Sicepat',
            'email' => 's@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 2
        ]);

        User::create([
            'name' => 'Hachi cafe',
            'email' => 'hc@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 2
        ]);

        User::create([
            'name' => 'Wong osing',
            'email' => 'wo@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 2
        ]);

        User::create([
            'name' => 'Admin Baik',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 3
        ]);

        User::create([
            'name' => 'admin falen',
            'email' => 'adminfalen@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 3
        ]);


        //Status
        Status::create([
            'status' => 'Sedang diproses'
        ]);

        Status::create([
            'status' => 'Diterima'
        ]);

        Status::create([
            'status' => 'Ditolak'
        ]);

        //Event
        Event::create([
            'name' => 'Semarak Kemerdekaan',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lectus urna duis convallis convallis. Id cursus metus aliquam eleifend mi in nulla. Mi in nulla posuere sollicitudin aliquam. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Facilisis volutpat est velit egestas dui. Nunc vel risus commodo viverra maecenas accumsan lacus vel facilisis. Viverra maecenas accumsan lacus vel. Enim praesent elementum facilisis leo vel. Nibh praesent tristique magna sit amet. Mauris commodo quis imperdiet massa tincidunt nunc. Erat pellentesque adipiscing commodo elit at imperdiet dui accumsan. Magna eget est lorem ipsum. Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque. Nisl condimentum id venenatis a condimentum vitae sapien pellentesque habitant. Lorem ipsum dolor sit amet consectetur.',
            'email' => 'a@gmail.com',
            'location' => 'Kalibaru, Kalibaru wetan, Banyuwangi',
            'proposal' => 'proposal/1.1718535529.pdf',
            'start_date' => '2024-06-18',
            'venue_name' => 'Lapangan Kalibaru',
            'image' => 'image/2.1718535444.png',
            'id_user' => 1
        ]);

        Event::create([
            'name' => 'Galaksi',
            'description' => 'Galaksi merupakan kepanjangan dari gala dan aksi penyambutan mahasiswa bidikmisi & KIP-K Politeknik negeri banyuwangi yang diselenggarkan oleh forbimwangi biasanya diselenggarakan h+7 setelah kegiatan PKKMB, kegiatan ini bertujuan untuk mengenalkan peran mahasiswa sebagai penerima KIP-K di poliwangi dan sebagai agent of change untuk indonesia',
            'email' => 'ab@gmail.com',
            'location' => 'Jalan Raya Jember No.KM13, Kawang, Labanasem, Kec. Kabat, Kabupaten Banyuwangi, Jawa Timur 68461',
            'proposal' => 'proposal/1.1718535529.pdf',
            'start_date' => '2024-08-27',
            'venue_name' => 'Aula Poliwangi',
            'image' => 'image/event1.jpg',
            'id_user' => 1
        ]);

        Event::create([
            'name' => 'Abdi Isun',
            'description' => 'Abdi Isun merupakan kegiatan pengabdian kepada masyarakat yang dilakukan oleh mahasiswa KIP-K yang berkolaborasi dengan mahasiswa penerima KIP-K universitas airlangga banyuwangi dengan sasarannya sendiri panti asuhan yang bertempat di perumahan banyuwangi.',
            'email' => 'ab@gmail.com',
            'location' => 'Jl. Raya Jember No.KM. 7, Krajan, Dadapan, Kec. Kabat, Kabupaten Banyuwangi, Jawa Timur 68461',
            'proposal' => 'proposal/1.1718535529.pdf',
            'start_date' => '2023-03-15',
            'venue_name' => 'Panti Asuhan Banyuwangi',
            'image' => 'image/event2.jpg',
            'id_user' => 1
        ]);

        Event::create([
            'name' => 'Banyuwangi fest',
            'description' => 'Banyuwangi Fest adalah rangkaian acara tahunan yang diadakan di Banyuwangi, Jawa Timur, yang bertujuan untuk mempromosikan kekayaan budaya, pariwisata, dan potensi lokal daerah tersebut. Festival ini menampilkan berbagai macam kegiatan dan pertunjukan yang mencerminkan keunikan dan keragaman budaya Banyuwangi.',
            'email' => 'a@gmail.com',
            'location' => 'Taman blambangan, Banyuwangi',
            'proposal' => 'proposal/1.1718535529.pdf',
            'start_date' => '2023-12-20',
            'venue_name' => 'Taman Blambangan',
            'image' => 'image/event3.jpg',
            'id_user' => 1
        ]);

        Event::create([
            'name' => 'PKKMB Poliwangi',
            'description' => 'PKKMB (Pengenalan Kehidupan Kampus bagi Mahasiswa Baru) di Politeknik Negeri Banyuwangi (Poliwangi) adalah program orientasi yang dirancang untuk membantu mahasiswa baru dalam beradaptasi dengan lingkungan kampus, memahami sistem akademik, dan mengenal budaya serta nilai-nilai yang ada di Poliwangi. Program ini bertujuan untuk membekali mahasiswa baru dengan informasi dan keterampilan yang diperlukan agar mereka dapat menjalani masa studi dengan lancar dan sukses.',
            'email' => 'a@gmail.com',
            'location' => 'Jl. Raya Jember No.KM. 7, Krajan, Dadapan, Kec. Kabat, Kabupaten Banyuwangi, Jawa Timur 68461',
            'proposal' => 'proposal/1.1718535529.pdf',
            'start_date' => '2022-08-20',
            'venue_name' => 'Kampus Poliwangi',
            'image' => 'image/event4.jpg',
            'id_user' => 1
        ]);

        Event::create([
            'name' => 'Diesnatalis Poliwangi',
            'description' => 'Acara ini bertujuan untuk merayakan pencapaian dan kontribusi Poliwangi dalam dunia pendidikan, serta memperkuat rasa kebersamaan dan solidaritas di antara seluruh civitas akademika. Dies Natalis biasanya diisi dengan serangkaian kegiatan yang mencerminkan semangat inovasi, prestasi, dan kebanggaan sebagai bagian dari Poliwangi.',
            'email' => 'ab@gmail.com',
            'location' => 'Jl. Raya Jember No.KM. 7, Krajan, Dadapan, Kec. Kabat, Kabupaten Banyuwangi, Jawa Timur 68461',
            'proposal' => 'proposal/1.1718535529.pdf',
            'start_date' => '2024-05-27',
            'venue_name' => 'Gedung Serba Guna Poliwangi',
            'image' => 'image/event5.jpg',
            'id_user' => 1
        ]);

        Event::create([
            'name' => 'COMMIT POLIWANGI',
            'description' => 'COMMIT (Competition of Information Technology) adalah acara tahunan yang diselenggarakan oleh Politeknik Negeri Banyuwangi (Poliwangi) sebagai ajang kompetisi dan pameran teknologi informasi bagi mahasiswa dan pelajar di seluruh Indonesia. Acara ini bertujuan untuk mengembangkan kreativitas, inovasi, dan kemampuan teknis di bidang teknologi informasi, serta memperkenalkan Poliwangi sebagai institusi yang unggul dalam pendidikan teknologi.',
            'email' => 'ab@gmail.com',
            'location' => 'Jl. Raya Jember No.KM. 7, Krajan, Dadapan, Kec. Kabat, Kabupaten Banyuwangi, Jawa Timur 68461',
            'proposal' => 'proposal/1.1718535529.pdf',
            'start_date' => '2024-04-05',
            'venue_name' => 'Lab Komputer Poliwangi',
            'image' => 'image/event6.jpg',
            'id_user' => 1
        ]);

        Event::create([
            'name' => 'Wokshop Desain Grafis',
            'description' => 'Acara ini bertujuan untuk memberikan pengetahuan dan keterampilan praktis dalam bidang desain grafis kepada mahasiswa dan masyarakat umum. Workshop ini juga berfungsi sebagai platform untuk mengembangkan kreativitas dan keterampilan teknis peserta dalam menggunakan berbagai alat dan software desain grafis.',
            'email' => 'a@gmail.com',
            'location' => 'Jl. Raya Jember No.KM. 7, Krajan, Dadapan, Kec. Kabat, Kabupaten Banyuwangi, Jawa Timur 68461',
            'proposal' => 'proposal/1.1718535529.pdf',
            'start_date' => '2024-03-05',
            'venue_name' => 'Ruang Multimedia Poliwangi',
            'image' => 'image/event7.jpg',
            'id_user' => 1
        ]);

        Event::create([
            'name' => 'Diesnatalis UKM Geniwangi',
            'description' => 'Acara ini dirancang untuk merayakan pencapaian dan keberadaan Geniwangi sebagai salah satu organisasi kemahasiswaan yang aktif dan berkontribusi dalam mengembangkan potensi mahasiswa di bidang seni dan budaya. Dies Natalis Geniwangi biasanya diselenggarakan dengan berbagai kegiatan menarik yang melibatkan seluruh civitas akademika dan masyarakat sekitar.',
            'email' => 'ab@gmail.com',
            'location' => 'Jl. Raya Jember No.KM. 7, Krajan, Dadapan, Kec. Kabat, Kabupaten Banyuwangi, Jawa Timur 68461',
            'proposal' => 'proposal/1.1718535529.pdf',
            'start_date' => '2024-06-29',
            'venue_name' => 'Aula Seni Poliwangi',
            'image' => 'image/event8.jpg',
            'id_user' => 1
        ]);

        Event::create([
            'name' => 'MAMI HMJBI',
            'description' => 'Malam Puncak Mahasiswa Teknik Informatika Poliwangi adalah acara tahunan yang diselenggarakan oleh Himpunan Mahasiswa Teknik Informatika (HMTI) Politeknik Negeri Banyuwangi. Acara ini bertujuan untuk merayakan pencapaian, mempererat kebersamaan, dan menampilkan bakat serta kreativitas mahasiswa Teknik Informatika.',
            'email' => 'a@gmail.com',
            'location' => 'Jl. Raya Jember No.KM. 7, Krajan, Dadapan, Kec. Kabat, Kabupaten Banyuwangi, Jawa Timur 68461',
            'proposal' => 'proposal/1.1718535529.pdf',
            'start_date' => '2022-12-11',
            'venue_name' => 'Gedung Teknik Informatika',
            'image' => 'image/event9.jpg',
            'id_user' => 1
        ]);

        //Category
        Category::create([
            'category' => 'Makanan dan minuman'
        ]);

        Category::create([
            'category' => 'Olahraga'
        ]);

        Category::create([
            'category' => 'Fashion'
        ]);

        Category::create([
            'category' => 'Manufaktur'
        ]);

        Category::create([
            'category' => 'Jasa'
        ]);


        //Sponsor
        Sponsor::create([
            'name' => 'JNT Point Poliwangi',
            'email' => 'r@gmail.com',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lectus urna duis convallis convallis. Id cursus metus aliquam eleifend mi in nulla. Mi in nulla posuere sollicitudin aliquam. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Facilisis volutpat est velit egestas dui. Nunc vel risus commodo viverra maecenas accumsan lacus vel facilisis. Viverra maecenas accumsan lacus vel. Enim praesent elementum facilisis leo vel. Nibh praesent tristique magna sit amet. Mauris commodo quis imperdiet massa tincidunt nunc. Erat pellentesque adipiscing commodo elit at imperdiet dui accumsan. Magna eget est lorem ipsum. Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque. Nisl condimentum id venenatis a condimentum vitae sapien pellentesque habitant. Lorem ipsum dolor sit amet consectetur.',
            'address' => 'Kabat',
            'image' => 'image/s1.png',
            'id_category' => '5',
            'id_user' => '3',
            'max_submission_date' => '30 Hari'
        ]);

        Sponsor::create([
            'name' => 'Butterfly Cafe',
            'email' => 'r@gmail.com',
            'description' => 'Butterfly Cafe adalah sebuah kafe yang menawarkan pengalaman kuliner yang unik dan nyaman di kota Banyuwangi. Terletak di lokasi yang strategis, kafe ini tidak hanya menjadi tempat untuk menikmati hidangan dan minuman yang lezat, tetapi juga menyajikan atmosfer yang menyenangkan dan ramah bagi pengunjung dari berbagai kalangan.',
            'address' => 'Banyuwangi',
            'image' => 'image/s2.png',
            'id_category' => '1',
            'id_user' => '4',
            'max_submission_date' => '30 Hari'
        ]);

        Sponsor::create([
            'name' => 'Ria Busana',
            'email' => 'n@gmail.com',
            'description' => 'Merupakan toko pakaian yang menjual baju-baju mulai dari baju anak kecil, remaja hingga dewasa dengan harga yang terjangkau',
            'address' => 'R92G+736, Jl. Basuki Rahmat, Lateng, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur',
            'image' => 'image/s3.jpeg',
            'id_category' => '3',
            'id_user' => '5',
            'max_submission_date' => '60 Hari'
        ]);

        Sponsor::create([
            'name' => 'Honda',
            'email' => 'n@gmail.com',
            'description' => 'Honda Corporation adalah perusahaan multinasional asal Jepang yang terkenal di seluruh dunia sebagai produsen kendaraan bermotor, mesin, dan peralatan kelistrikan. Didirikan pada tahun 1946 oleh Soichiro Honda, perusahaan ini telah tumbuh menjadi salah satu pemimpin utama dalam industri otomotif global.',
            'address' => 'Jalan Raya Banyuwangi Jember KM 7 No. 88 Sumberrejo, Dusun Krajan, Dadapan, Kec. Kabat, Kabupaten Banyuwangi, Jawa Timur 68419',
            'image' => 'image/s4.png',
            'id_category' => '4',
            'id_user' => '6',
            'max_submission_date' => '60 Hari'
        ]);

        Sponsor::create([
            'name' => 'Eiger',
            'email' => 'r@gmail.com',
            'description' => 'Eiger adalah merek terkemuka yang berasal dari Indonesia, dikenal dengan produk-produk perlengkapan dan peralatan outdoor. Didirikan pada tahun 1989, Eiger telah menjadi ikon dalam industri outdoor di Indonesia dan kini telah merambah ke pasar internasional.',
            'address' => 'Jl. Jend. A. Yani No.11, Perliman, Penganjuran, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68416',
            'image' => 'image/s5.png',
            'id_category' => '1',
            'id_user' => '7',
            'max_submission_date' => '60 Hari'
        ]);

        Sponsor::create([
            'name' => 'JCO',
            'email' => 'r@gmail.com',
            'description' => 'J.CO Donuts & Coffee adalah sebuah jaringan waralaba internasional yang terkenal dengan produk donat premium dan kopi berkualitas. Didirikan pertama kali di Indonesia pada tahun 2005 oleh Johnny Andrean Group, J.CO telah berkembang pesat menjadi merek yang dikenal luas di Asia Tenggara dan Timur Tengah.',
            'address' => 'Jl. Adi Sucipto No.99, Tukangkayu, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68418',
            'image' => 'image/s6.png',
            'id_category' => '1',
            'id_user' => '8',
            'max_submission_date' => '60 Hari'
        ]);

        Sponsor::create([
            'name' => 'Roxy',
            'email' => 'r@gmail.com',
            'description' => 'Roxy Banyuwangi merupakan salah satu toko atau outlet yang terletak di Banyuwangi, Jawa Timur. Roxy dikenal sebagai merek yang menyediakan berbagai produk pakaian, terutama dalam kategori surfwear dan urban fashion.',
            'address' => 'Jl. Jenderal Ahmad Yani No.21 - 23, Penganjuran, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68416',
            'image' => 'image/s7.jpeg',
            'id_category' => '1',
            'id_user' => '9',
            'max_submission_date' => '90 Hari'
        ]);

        Sponsor::create([
            'name' => 'Toko elektronik',
            'email' => 'n@gmail.com',
            'description' => 'Philips adalah sebuah perusahaan multinasional yang berbasis di Belanda dan dikenal secara luas sebagai salah satu pemimpin global di berbagai industri, terutama dalam teknologi kesehatan, pencahayaan, dan elektronik konsumen.  ',
            'address' => 'Jl. Jenderal Ahmad Yani No.21 - 23, Penganjuran, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68416',
            'image' => 'image/s8.jpeg',
            'id_category' => '1',
            'id_user' => '10',
            'max_submission_date' => '90 Hari'
        ]);

        Sponsor::create([
            'name' => 'Sicepat',
            'email' => 'n@gmail.com',
            'description' => 'Jasa kirim dan antar paket di daerah banyuwangi  ',
            'address' => 'Jl. Jenderal Ahmad Yani No.21 - 23, Penganjuran, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68416',
            'image' => 'image/s9.png',
            'id_category' => '1',
            'id_user' => '11',
            'max_submission_date' => '90 Hari'
        ]);

        Sponsor::create([
            'name' => 'Hachi Coffe',
            'email' => 'n@gmail.com',
            'description' => 'Tempat nongkrong para muda mudi yang menyediakan makanan dan minuman cofee maupun non cofee yang harganya ramah di kantong pelajar',
            'address' => 'Gitik, Rogojampi',
            'image' => 'image/s10.png',
            'id_category' => '1',
            'id_user' => '12',
            'max_submission_date' => '90 Hari'
        ]);


        //PaymentStatus
        PaymentStatus::create([
            'status' => 'Belum Dibayar',
        ]);

        PaymentStatus::create([
            'status' => 'Menunggu Verifikasi',
        ]);

        PaymentStatus::create([
            'status' => 'Berhasil',
        ]);

        PaymentStatus::create([
            'status' => 'Gagal',
        ]);

        //WdStatus
        WithdrawStatus::create([
            'status' => 'Belum Dicairkan',
        ]);

        WithdrawStatus::create([
            'status' => 'Sedang Diproses',
        ]);

        WithdrawStatus::create([
            'status' => 'Selesai',
        ]);

        WithdrawStatus::create([
            'status' => 'Gagal',
        ]);
    }
}
