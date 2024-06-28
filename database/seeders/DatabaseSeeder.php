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
            'name' => 'Agung Berkah',
            'email' => 'a@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 1
        ]);

        User::create([
            'name' => 'Rifqi Berkah',
            'email' => 'r@gmail.com',
            'password' => bcrypt('1'),
            'id_role' => 2
        ]);

        User::create([
            'name' => 'Admin Baik',
            'email' => 'admin@gmail.com',
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
            'end_date' => '2024-06-29',
            'id_user' => 1,
            'image' => 'image/2.1718535444.png'
        ]);

        Event::create([
            'name' => 'Poliwangi Beyond',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lectus urna duis convallis convallis. Id cursus metus aliquam eleifend mi in nulla. Mi in nulla posuere sollicitudin aliquam. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Facilisis volutpat est velit egestas dui. Nunc vel risus commodo viverra maecenas accumsan lacus vel facilisis. Viverra maecenas accumsan lacus vel. Enim praesent elementum facilisis leo vel. Nibh praesent tristique magna sit amet. Mauris commodo quis imperdiet massa tincidunt nunc. Erat pellentesque adipiscing commodo elit at imperdiet dui accumsan. Magna eget est lorem ipsum. Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque. Nisl condimentum id venenatis a condimentum vitae sapien pellentesque habitant. Lorem ipsum dolor sit amet consectetur.',
            'email' => 'a@gmail.com',
            'location' => 'Kalibaru, Kalibaru wetan, Banyuwangi',
            'proposal' => 'proposal/1.1718535529.pdf',
            'start_date' => '2024-06-18',
            'end_date' => '2024-06-29',
            'id_user' => '1',
            'image' => 'image/2.1718535444.png'
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

        Category::create([
            'category' => 'Makanan dan minuman'
        ]);

        //Sponsor
        Sponsor::create([
            'name' => 'JNT Point Poliwangi',
            'email' => 'r@gmail.com',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lectus urna duis convallis convallis. Id cursus metus aliquam eleifend mi in nulla. Mi in nulla posuere sollicitudin aliquam. Egestas fringilla phasellus faucibus scelerisque eleifend donec pretium. Facilisis volutpat est velit egestas dui. Nunc vel risus commodo viverra maecenas accumsan lacus vel facilisis. Viverra maecenas accumsan lacus vel. Enim praesent elementum facilisis leo vel. Nibh praesent tristique magna sit amet. Mauris commodo quis imperdiet massa tincidunt nunc. Erat pellentesque adipiscing commodo elit at imperdiet dui accumsan. Magna eget est lorem ipsum. Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque. Nisl condimentum id venenatis a condimentum vitae sapien pellentesque habitant. Lorem ipsum dolor sit amet consectetur.',
            'address' => 'Kabat',
            'image' => 'image/2.1718535444.png',
            'id_category' => '4',
            'id_user' => '2',
            'max_submission_date' => '30 Hari'
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
