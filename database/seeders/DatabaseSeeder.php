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
            'title' => 'Sedekah Akbar Indonesia Virtual 2022',
            'category_id' => 2,
            'fundraiser' => 'Jaki Umam',
            'slug' => 'sedekah-akbar-indonesia-virtual-2022',
            'target' => 1000000000,
            'end_date' => '2022-01-09',
            'caption' => 'Sebuah Ceremonial Terbesar Yang Memuliakan dan Membahagiakan Ribuan Anak Yatim, Penghafal Al-Qur’an, dan Fiisabilillah.',
            'description' => '
Assalamualaikum #OrangBaik
<br>
Sadarkah Kita? Bahwa hari ini, masih banyak Yatim dan Penghafal Al-Qur’an yang hidupnya belum seberuntung Kita.
<br>

Sudah tahu kan? Mereka yang begitu istimewa di mata Rasulullah, tapi hari ini masih banyak yang hidup tak layak.
<br>

Kebayang ga? Anak-anak Sekelas Penghafal Al-Qur’an yang kelak menjadi tonggak peradaban Islam di masa depan, hari ini masih menjadi kelas bawah. Menyedihkan.
<br>

Dengan Kondisi Tersebut, Akankah #OrangBaik Seperti Anda Berdiam Diri?<br>
SEDEKAH AKBAR INDONESIA VIRTUAL<br>
Sebuah Ceremonial Terbesar Yang Memuliakan dan Membahagiakan Ribuan Anak Yatim, Penghafal Al-Qur’an, dan Fiisabilillah.
<br>

Dimeriahkan oleh berbagai hiburan yang mendidik dari berbagai kalangan seperti artis, komunitas, para da’i dan banyak lagi lainnya.
<br>

Selain itu, Puncak acara ini ditutup dengan Muhasabah Penuh Haru dan Do’a Bersama yang dipimpin langsung oleh Ustadz Luqmanul Hakim (Da’i Nasional, Founder Gerakan Infaq Beras) yang diaminkan oleh ribuan Adik Yatim Penghafal Al-Qur’an.
<br>

Alhamdulillah atas izin Allah di Kota Bandung pada 16 Februari 2020 acara ini berhasil mengimpun donasi sebesar lebih dari Rp. 4.5 Milyar dari 20.965 Orang Tua Asuh atau Donatur.
<br>
Donasi tersebut dialokasikan untuk membahagiakan dan memuliakan 3.000 Santri Yatim Penghafal Al-Qur\'an yang hadir.
<br>
Angka tersebut rasanya cukup menantang untuk dicapai. Tapi atas ridho Allah dan bantuan dari #OrangBaik seperti Anda tantangan tersebut pasti akan lebih mudah dilewati.
<br>
Mari Hadiri, Support, dan Sukseskan acara yang insyaAllah penuh keberkahan ini dengan memberikan Sedekah Terbaik.
Untuk teman-teman yang ingin ambil bagian dalam kebaikan ini, silahkan berdonasi dengan cara:
<br>
1. Klik tombol “DONASI SEKARANG”
2. Masukan nominal donasi
3. Pilih metode pembayaran transfer Bank dan transfer ke no. rekening yang tertera.
<br>
“Perumpamaan orang-orang yang menafkahkan hartanya di jalan Allah adalah serupa dengan sebutir benih yang menumbuhkan tujuh bulir, pada tiap-tiap bulir seratus biji. Allah melipat gandakan (ganjaran) bagi siapa yang Dia kehendaki. Dan Allah Maha Luas (karunia-Nya) lagi Maha Mengetahui.”
(QS. Al-Baqarah : 261)<br>
Tidak hanya berdonasi, teman-teman juga bisa melipatgandakan pahala dengan menyebarkan informasi ini seluas-luasnya dengan klik tombol "share"
<br>
Jika ada pertanyaan mengenai penggalangan dana ini, teman-teman bisa menghubungi Kami di 0811 5670 037 (Rani).
<br>
Nb:<br>

- Sedekah yang terkumpul di acara ini akan dialokasikan untuk memuliakan dan membahagiakan Santri Yatim, Penghafal Al-Qur’an, dan Fiisabilillah pada saat acara dan juga dalam bentuk pembangunan infrastruktur dakwah, program kesehatan, program pendidikan, Acara Sedekah Akbar Selanjutnya dan program dakwah lainnya.
<br>
- Dana juga akan digunakan untuk DPD (Dana Pengembangan Dakwah) dan kemaslahatan yang terkait dengannya
<br>        
            ',
            'cover' => 'cover-image/VtMqTU0TQ49TeoqgMlUwAkQ4Y4lXKhBCjUmukO90.jpg',
        ]);
    }
}
