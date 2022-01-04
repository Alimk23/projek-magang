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
            'title' => 'Sedekah',
        ]);
        Category::create([
            'title' => 'Bencana Alam',
        ]);
        Category::create([
            'title' => 'Kemanusiaan',
        ]);
        Category::create([
            'title' => 'Kegiatan Sosial',
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
            'title' => 'Sedekah Akbar Indonesia Virtual',
            'category_id' => 1,
            'fundraiser' => 'Jaki Umam',
            'slug' => 'sedekah-akbar-indonesia-virtual',
            'target' => 1000000000,
            'end_date' => '2022-01-09',
            'caption' => 'Bagaimana Rasanya Jika Do\'a Mu Diaminkan Oleh Ribuan Yatim & Penghafal Al-Qur\'an? InsyaAllah Tembus Kelangit. Mau?',
            'description' => 'test',
            'cover' => 'cover-image/YxdqXVdsEPXMgfAz0uypq5i9Fxxw88gIab0IyStC.jpg',
        ]);
        Campaign::create([
            'title' => 'Bantu negeri kita peroleh Nobel pertama',
            'category_id' => 1,
            'fundraiser' => 'Jaki Umam',
            'slug' => 'bantu-negeri-kita-peroleh-nobel-pertama',
            'target' => 1000000000,
            'end_date' => '2023-01-09',
            'caption' => 'Mari bantu kami mengembangkan laboratorium untuk kejayaan masa depan Indonesia. Insya Allah kelak pusat fisika dan teknologi mutakhir dunia akan berpindah ke negeri kita.',
            'description' => 'test',
            'cover' => 'cover-image/g15SulqNmnIn2pkPvL19tPwOp6DUHSqZFhGqYT21.png',
        ]);
    }
}
