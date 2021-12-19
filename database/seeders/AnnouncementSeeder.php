<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Announcement::create([
            'title' => "UAS Semester Ganjil",
            'body' => " Mengingat jadwal belajar semester 5  berakhir di bulan Desember 2021 Akhir.

            Bagi Dosen yg mempunyai pertemuan yg masih kurang, penggurus Kls yg bertanggung jawab, bisa koordinasi dengan Dosen yang bersangkutan,
             untuk make-up Class.

            Adapun Make -up Class di laksanakan di malam hari ,Senin sampai Jumat atau sesuai hari yg kosong.

            Mengingat dan mempertimbangan pada hari Sabtu banyak yg ber kerja untuk make -Up Class di tiadakan hari Sabtu dan hari Minggu.

            Hari Sabtu bisa di lakukan untuk bimbingan KKI.dan lain - lain.

            Terimakasi atas pengertian dan kerja samanya .

            Salam sehat selalu"
        ]);
    }
}
