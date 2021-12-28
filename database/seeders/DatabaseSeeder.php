<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\User;
use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '0898123987',
            'role' => '0',
            'password' => Hash::make('rahasia123'),
        ]);

        Category::create([
            'title' => 'Zakat',
            'logo' => 'logo-image/4FYilnEjPuwH0xUBwR7gXwFIU6WIv25aD1Toimet.png',
        ]);
        Category::create([
            'title' => 'Sedekah',
            'logo' => 'logo-image/gTcti9ZHm68GqVuOIu0FnfzjDeIN4fVtbG12Dokf.png',
        ]);
        Bank::create([
            'user_id' => 1,
            'bank_logo' => 'cover-image/L2tWaf4Ph22ts9039jpZr7JX9ZjOZJ7RnbQmkqXJ.png',
            'bank_code' => '008',
            'bank_name' => 'Bank Mandiri',
            'bank_account' => '1110887135',
            'alias' => 'Hobi Sedekah Indonesia',
        ]);
        Campaign::create([
            'title' => 'Bantu Dirikan Masjid At-Taqwa',
            'category_id' => 1,
            'fundraiser' => 'Pengurus Masjid At-Taqwa',
            'slug' => 'bantu-dirikan-masjid-at-taqwa',
            'target' => 100000000,
            'end_date' => '2022-02-28',
            'post' => 'Isi post',
            'cover' => 'cover-image/VtMqTU0TQ49TeoqgMlUwAkQ4Y4lXKhBCjUmukO90.jpg',
        ]);
    }
}
