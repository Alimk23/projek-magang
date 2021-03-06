<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\User;
use App\Models\Company;
use App\Models\Profile;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\CustomerService;
use App\Models\RegistrationStatus;
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
            'phone' => '083852542004',
            'role' => 0,
            'password' => Hash::make('rahasia123'),
        ]);
        User::create([
            'name' => 'BMI',
            'email' => 'advertiserbmi@gmail.com',
            'phone' => '083852542002',
            'role' => 1,
            'password' => Hash::make('rahasia123'),
        ]);
        User::create([
            'name' => 'Jaki Umam',
            'email' => 'jakiumam@gmail.com',
            'phone' => '083839362022',
            'role' => 1,
            'password' => Hash::make('rahasia123'),
        ]);
        User::create([
            'name' => 'Hobi Sedekah',
            'email' => 'hobisedekahindonesia@gmail.com',
            'phone' => '081284786808',
            'role' => 1,
            'password' => Hash::make('rahasia123'),
        ]);
        User::create([
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'phone' => '083839362023',
            'role' => 1,
            'password' => Hash::make('rahasia123'),
        ]);

        Company::create([
            'user_id' => 1,
            'company_name' => 'Hobi Sedekah',
            'job_title' => 'Administrator',
        ]);

        Profile::create([
            'user_id' => 1,
            'company_id' => 1,
            'photo' => '/img/logo.png',
            'address' => 'Jalan Darul Hasanah, Tegalandong, Lebaksiu, Tegal, Jawa Tengah',
        ]);

        Company::create([
            'user_id' => 2,
            'company_name' => 'Baitulmaal Munzalan Indonesia',
            'job_title' => 'Customer Services',
        ]);

        Profile::create([
            'user_id' => 2,
            'company_id' => 2,
            'photo' => '/profile-image/dCVzwDO6n98hdMWlmcSoNDjqM5BksG8kOFOetUo6.jpg',
            'address' => 'Jl. Imogiri Timur, Dladan, Tamanan, Kec. Banguntapan, Kab. Bantul, DI. Yogyakarta',
        ]);

        Company::create([
            'user_id' => 3,
            'company_name' => 'KHO',
            'job_title' => 'Pengasuh',
        ]);

        Profile::create([
            'user_id' => 3,
            'company_id' => 3,
            'photo' => 'profile-image/xWfk44HISzHKOE2lpgJwPoKw3Ay8dufhOLDU2lto.jpg',
            'address' => 'Jalan Darul Hasanah, Tegalandong, Lebaksiu, Tegal',
        ]);

        Company::create([
            'user_id' => 4,
            'company_name' => 'Hobi Sedekah',
            'job_title' => 'Administrator',
        ]);

        Profile::create([
            'user_id' => 4,
            'company_id' => 4,
            'photo' => 'profile-image/H07f8Y8KG8Jxk2vn4C1dsKi4mq9V5TjAXe9Lk8M8.jpg',
            'address' => 'Jalan Darul Hasanah, Tegal, Jawa Tengah',
        ]);
        RegistrationStatus::create([
            'user_id' => 1,
            'status' => 1,
        ]);
        RegistrationStatus::create([
            'user_id' => 2,
            'status' => 1,
        ]);
        RegistrationStatus::create([
            'user_id' => 3,
            'status' => 1,
        ]);
        RegistrationStatus::create([
            'user_id' => 4,
            'status' => 1,
        ]);
        RegistrationStatus::create([
            'user_id' => 5,
            'status' => 0,
        ]);
        
        Category::create([
            'title' => 'Sedekah',
            'icon' => 'fa-3x fas fa-hand-holding-usd'
        ]);
        Category::create([
            'title' => 'Bencana Alam',
            'icon' => 'fa-3x fas fa-hand-holding-medical'
        ]);
        Category::create([
            'title' => 'Kemanusiaan',
            'icon' => 'fa-3x fas fa-hand-holding-heart'
        ]);
        Category::create([
            'title' => 'Kegiatan Sosial',
            'icon' => 'fa-3x fas fa-hand-holding-water'
        ]);
        Category::create([
            'title' => 'Wakaf',
            'icon' => 'fa-3x fas fa-mosque'
        ]);
        Bank::create([
            'user_id' => 1,
            'bank_logo' => 'bank-logo/YA3TEfBSVHflumDNaShttj7MkoJUsxoC1QgT9wCh.svg',
            'bank_code' => '451',
            'bank_name' => 'Bank Syariah Indonesia',
            'bank_account' => '7957958887',
            'alias' => 'Yayasan Hobi Sedekah Indonesia',
        ]);
        Bank::create([
            'user_id' => 1,
            'bank_logo' => 'bank-logo/BqemprRIgI4T1LgnWRSnClBlIEMaqKV8UlTjZWrv.svg',
            'bank_code' => '008',
            'bank_name' => 'Bank Mandiri',
            'bank_account' => '1370088228883',
            'alias' => 'Yayasan Hobi Sedekah Indonesia',
        ]);
        Bank::create([
            'user_id' => 3,
            'bank_code' => '014',
            'bank_name' => 'Bank BCA',
            'bank_account' => '8690658454',
            'alias' => 'Jaki Umam',
        ]);
        CustomerService::create([
            'user_id' => 2,
            'name' => 'Mayda',
            'phone' => '08112744333',
            'email' => 'alimmughanil.work@gmail.com',
        ]);
        CustomerService::create([
            'user_id' => 3,
            'name' => 'Jaki Umam',
            'phone' => '083839362022',
            'email' => 'alimmughanil.work@gmail.com',
        ]);
        CustomerService::create([
            'user_id' => 4,
            'name' => 'Mayda',
            'phone' => '081284786808',
            'email' => 'alimmughanil.work@gmail.com',
        ]);

        Campaign::create([
            'user_id' => 2,
            'cs_id' => 1,
            'category_id' => 1,
            'status' => 1,
            'title' => 'Sedekah Akbar Indonesia Virtual',
            'slug' => 'sedekah-akbar-indonesia-virtual',
            'cover' => 'cover-image/YxdqXVdsEPXMgfAz0uypq5i9Fxxw88gIab0IyStC.jpg',
            'target' => 1000000000,
            'end_date' => '2022-07-31',
            'caption' => 'Bagaimana Rasanya Jika Do\'a Mu Diaminkan Oleh Ribuan Yatim & Penghafal Al-Qur\'an? InsyaAllah Tembus Kelangit. Mau?',
            'description' => 'Assalamualaikum #OrangBaik

            Sadarkah Kita? Bahwa hari ini, masih banyak Yatim dan Penghafal Al-Qur???an yang hidupnya belum seberuntung Kita.
            
            
            Sudah tahu kan? Mereka yang begitu istimewa di mata Rasulullah, tapi hari ini masih banyak yang hidup tak layak.
            
            
            Kebayang ga? Anak-anak Sekelas Penghafal Al-Qur???an yang kelak menjadi tonggak peradaban Islam di masa depan, hari ini masih menjadi kelas bawah. Menyedihkan.
            
            
            Dengan Kondisi Tersebut, Akankah #OrangBaik Seperti Anda Berdiam Diri?
            SEDEKAH AKBAR INDONESIA VIRTUAL
            Sebuah Ceremonial Terbesar Yang Memuliakan dan Membahagiakan Ribuan Anak Yatim, Penghafal Al-Qur???an, dan Fiisabilillah.
            
            
            Dimeriahkan oleh berbagai hiburan yang mendidik dari berbagai kalangan seperti artis, komunitas, para da???i dan banyak lagi lainnya.
            
            
            Selain itu, Puncak acara ini ditutup dengan Muhasabah Penuh Haru dan Do???a Bersama yang dipimpin langsung oleh Ustadz Luqmanul Hakim (Da???i Nasional, Founder Gerakan Infaq Beras) yang diaminkan oleh ribuan Adik Yatim Penghafal Al-Qur???an.
            
            
            Alhamdulillah atas izin Allah di Kota Bandung pada 16 Februari 2020 acara ini berhasil mengimpun donasi sebesar lebih dari Rp. 4.5 Milyar dari 20.965 Orang Tua Asuh atau Donatur.
            
            Donasi tersebut dialokasikan untuk membahagiakan dan memuliakan 3.000 Santri Yatim Penghafal Al-Qur\'an yang hadir.
            
            Angka tersebut rasanya cukup menantang untuk dicapai. Tapi atas ridho Allah dan bantuan dari #OrangBaik seperti Anda tantangan tersebut pasti akan lebih mudah dilewati.
            
            Mari Hadiri, Support, dan Sukseskan acara yang insyaAllah penuh keberkahan ini dengan memberikan Sedekah Terbaik.
            Untuk teman-teman yang ingin ambil bagian dalam kebaikan ini, silahkan berdonasi dengan cara:
            
            1. Klik tombol ???DONASI SEKARANG???
            2. Masukan nominal donasi
            3. Pilih metode pembayaran transfer Bank dan transfer ke no. rekening yang tertera.
            
            ???Perumpamaan orang-orang yang menafkahkan hartanya di jalan Allah adalah serupa dengan sebutir benih yang menumbuhkan tujuh bulir, pada tiap-tiap bulir seratus biji. Allah melipat gandakan (ganjaran) bagi siapa yang Dia kehendaki. Dan Allah Maha Luas (karunia-Nya) lagi Maha Mengetahui.???
            (QS. Al-Baqarah : 261)
            Tidak hanya berdonasi, teman-teman juga bisa melipatgandakan pahala dengan menyebarkan informasi ini seluas-luasnya dengan klik tombol "share"
            
            Jika ada pertanyaan mengenai penggalangan dana ini, teman-teman bisa menghubungi Kami di 0897 7020 249 (Alim).
            
            Nb:
            
            - Sedekah yang terkumpul di acara ini akan dialokasikan untuk memuliakan dan membahagiakan Santri Yatim, Penghafal Al-Qur???an, dan Fiisabilillah pada saat acara dan juga dalam bentuk pembangunan infrastruktur dakwah, program kesehatan, program pendidikan, Acara Sedekah Akbar Selanjutnya dan program dakwah lainnya.
            
            - Dana juga akan digunakan untuk DPD (Dana Pengembangan Dakwah) dan kemaslahatan yang terkait dengannya',
        ]);
        Campaign::create([
            'user_id' => 3,
            'cs_id' => 2,
            'category_id' => 5,
            'status' => 1,
            'title' => 'Bantu negeri kita peroleh Nobel pertama',
            'slug' => 'bantu-negeri-kita-peroleh-nobel-pertama',
            'cover' => 'cover-image/OhF47fO5uIKZQ958qrOCpMvGIXToRntpFAEqBFPy.jpg',
            'target' => 1000000000,
            'end_date' => '2023-01-09',
            'caption' => 'Mari bantu kami mengembangkan laboratorium untuk kejayaan masa depan Indonesia. Insya Allah kelak pusat fisika dan teknologi mutakhir dunia akan berpindah ke negeri kita.',
            'description' => 'Lebih dari 20 tahun silam, dengan penuh rasa ingin tahu, saya mengamati globe. Mata saya tertuju pada sebuah kawasan kepulauan di pinggiran benua Eropa. Itulah kepulauan Inggris. Menurut pelajaran sejarah, saya tahu bahwa Inggris adalah gudangnya orang pintar, sumber keilmuan peradaban Barat. Dari kepulauan ini, lahirlah fisikawan-fisikawan reputable yang karya-karyanya menjadi bahan rujukan di seluruh penjuru dunia. Banyaknya penerima Nobel dari kepulauan ini menunjukkan bahwa Inggris adalah otaknya peradaban.

            Sekilas kawasan kepulauan itu tak jauh berbeda dengan Indonesia, negeri nun jauh di seberang megakontinental Asia-Eropa. Dari segi karakter kawasan, Inggris dan Indonesia hampir sama, bahkan lebih besar kepulauan Indonesia. Bedanya Inggris dihuni ras Kaukasoid yang berkulit putih dan Indonesia dihuni ras Mongoloid yang pendek dan berhidung pesek. Secara geografis, letak Indonesia segaris diagonal ke arah tenggara dari kepulauan Inggris. 
            
            Saat ini, Indonesia telah merdeka 3/4 abad, kondisinya hampir mirip Inggris pada abad 17 setelah restorasi Cromwell. Meskipun negeri kita tertinggal tiga abad oleh negeri Ratu Elizabeth tersebut, grafiknya sudah hampir berpapasan, Inggris menurun dan Indonesia menaik.
            
            Salah satu indikator kemajuan yang harus kita kejar adalah Indonesia harus leading dalam ilmu pengetahuan, terutama harus leading dalam studi Fisika. Sir Isaac Newton adalah fisikawan Inggris perintis riset-riset Mekanika dasar era kebangkitan Inggris. Dalam timeline Fisika tiga abad terakhir, Mekanika Newton menempati pondasi mendasar yang paling banyak dirujuk oleh ilmuwan-ilmuwan di seluruh penjuru dunia.
            
            dabd03bd-086b-4321-bb60-f12c3781b753.jpg
            Sir Isaac Newton, fisikawan Inggris abad 17-18 (sumber: google)
            
            Sekarang pertanyaannya, mengapa Fisika? Karena Fisika adalah bidang fundamental yang masuk dalam salah satu kategori penghargaan Nobel yang menjadi pilar utama penggerak sejarah. Jadi, Fisika bisa dibilang salah satu pilar peradaban manusia karena mengandung ilmu pengetahuan manusia yang paling mendasar. 
            
            Mimpi presiden Jokowi dalam visi Indonesia Maju 2045 agak mirip dengan cita-cita saya sejak dulu. Sekarang cita-cita tersebut telah kami transfer ke dalam komunitas fisikaisme. Sejak saat itu, saya ingin berkontribusi untuk kemajuan Indonesia suatu saat nanti, selayaknya Inggris, dengan mendapatkan Nobel pertama untuk negeri tercinta ini. Maka sejak saat itu, saya bertekad terjun ke dalam studi Fisika sampai tuntas.
            
            Pada tahun 2013, karena saya berasal dari keluarga petani sederhana, saya baru bisa memasuki program studi Fisika 10 tahun setelah kelulusan saya dari SMA dengan beasiswa dari swasta. Membutuhkan waktu yang amat sangat panjang untuk saya benar-benar terjun dalam dunia akademik yang saya impikan.
            
            Tahap selanjutnya, pada tahun 2015, untuk mewujudkan cita-cita tersebut, demi kejayaan ilmu pengetahuan Indonesia di masa depan, saya dan teman-teman fisikaisme mendirikan laboratorium yang dinamakan Kinetic Hideway Observatory (KHO). Laboratorium ini diharapkan akan menjadi seperti "Cavendish Laboratory" di Cambridge, Inggris yang telah leading dalam pengembangan Fisika selama berabad-abad. 
            
            Rencana utama yang akan kami kerjakan untuk pengembangan laboratorium adalah pembangunan fisik gedung laboratorium. Oleh karena itu, untuk mewujudkan rencana tersebut, kami membutuhkan dana yang tidak sedikit. Kami kira, cita-cita besar untuk mewujudkan Nobel pertama bagi negeri tercinta ini harus melibatkan lebih banyak orang, diwujudkan menjadi sebuah gerakan sosial yang besar. Karena topik yang kami tangani kelak akan melahirkan ratusan bahkan ribuan fisikawan dan ilmuwan baru, yang bukan tidak mungkin, beberapa dari mereka kelak akan mempersembahkan Nobel-nobel untuk mengangkat nama besar bangsa Indonesia. Karena topik-topik yang kami tangani sangat mendasar (Noble-able) dan berpotensi mengubah sejarah umat manusia.
            
            Topik-topik yang mewakili isi pikiran kami dapat dibaca di academia.edu/43084625/Risalah_ruang_and_waktu* Karena konsep ilmu fisika matematika yang kami gunakan berbeda dengan Newton, Einstein dan fisikawan pada umumnya (konsep tersebut menyempurnakan Fisika), maka komunitas kami sangat berpotensi mengubah konten ilmu pengetahuan secara umum.
            
            Penjelasan mengenai akar, dasar dan ketersambungan gagasan-gagasan kami dengan sains modern dapat ditonton di media kami:*
            
            
            Oleh karena itu, mari bantu kami mengembangkan laboratorium untuk kejayaan masa depan Indonesia ini. Kelak harapannya, pusat fisika dan teknologi mutakhir dunia akan berpindah ke negeri kita.
            
            Langkah-langkah untuk berdonasi adalah sebagai berikut:
            
            Klik tombol "Donasi" 
            Pilih nominal donasi yang Anda inginkan.
            Pilih metode pembayaran transfer Bank Syariah Indonesia.
            Kemudian klik "Lanjut Pembayaran."
            Kemudian melakukan pembayaran.
            Nama Anda akan tercatat dalam sejarah.
            Donasi yang terkumpul akan digunakan untuk pembangunan gedung laboratorium dan fasilitas-fasilitasnya.
            
            ____________________________________________
            
            Salam hangat,
            
            Jaki Umam
            
            Perintis KHO (083839362022)
            
            *Media fisikaisme yang lebih mudah diikuti dapat diakses di kanal youtube, instagram, quora atau facebook.
            
            ',
        ]);
        Campaign::create([
            'user_id' => 4,
            'cs_id' => 3,
            'category_id' => 1,
            'status' => 1,
            'title' => 'Lauk-pauk untuk para tetangga',
            'slug' => 'lauk-untuk-para-tetangga',
            'cover' => 'cover-image/a28wrPOS1LL2Ui8UGqH1XWoNLGWvxJEuzzUncyF8.jpg',
            'target' => 25000000,
            'end_date' => '2022-02-28',
            'caption' => 'Sedekah yang paling baik adalah memberi makan kepada orang yang membutuhkan makan. Mari bantu iyu Susi memberi makan tetangga-tetangganya yang janda dan fakir miskin.',
            'description' => "
            <div>Assalamu'alaikum warahmatullahi wa barakatuh.</div><div><br></div><div>Hai para penghobi sedekah, admin mau menceritakan satu sosok yang hobi sedekah di desa yang cukup jauh.</div><div><br></div><div>Mboke Kamidah dari desa Tegalandong, kec. Lebaksiu, kab. Tegal terkenal sebagai penjual lauk dari era 80-an. Namun sejak tahun 2000-an, tradisi berjualan lauk terhenti karena Simbok meninggal dunia.</div><div><br></div><div>Saat ini, rumah yang ditempati Simbok diwariskan ke salah satu cucunya. Beliau juga meneruskan tradisi Simbok mengolah lauk-pauk. Namun kali ini lauk-pauk tersebut tidak dijual, tapi dibagikan secara cuma-cuma.</div><div><br></div><div>Beliau adalah Susilowati, salah satu orang terkaya di desa, meskipun secara harta tidak begitu banyak, namun secara mental sangat kaya. Beliau tergerak untuk membantu meringankan beban pangan dan nutrisi untuk para janda dan fakir miskin di lingkungannya. Iyu Susi memasak lauk-pauk setiap hari tak kurang dari dua wajan besar untuk dibagikan kepada tetangga-tetangganya yang membutuhkan, terutama para janda dan fakir-miskin.</div><div><br></div><div>Kepedulian beliau ditularkan melalui aksi nyata karena keahliannya dalam mengolah makanan dan hobinya bersedekah.</div><div><br></div><div>Bagi Anda yang ingin mendukung gerakan lauk untuk para tetangga yang digagas iyu Susi dapat mengikuti langkah-langkah berikut ini:</div><div>1. Klik tombol donasi sekarang.</div><div>2. Pilih nominal untuk berdonasi.</div><div>3. Pilih metode pembayaran transfer.</div><div>4. Lakukan pembayaran.</div><div>5. Konfirmasikan ke customer service.</div><div>6. Dan Anda telah ikut berpartisipasi memberi makan tetangga-tetangga iyu Susi.</div><div><br></div><div>Dana yang terkumpul dari campaign ini akan digunakan untuk mendukung gerakan ini dan dana pengembangan dakwah untuk kemaslahatan platform ini.</div><div><br></div><div>Jazakumullahu khair katsir.</div>
            ",
        ]);
    }
}
