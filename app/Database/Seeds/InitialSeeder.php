<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeeder extends Seeder
{
    public function run()
    {
        // 1. Seed `jadwal_sholat`
        $this->db->table('jadwal_sholat')->insertBatch([
            [
                'id'         => 81,
                'tanggal'    => '2026-09-17',
                'hijriyah'   => '6 Rabiulakhir 1448 H',
                'subuh'      => '04:27:00',
                'imsak'      => '04:17:00',
                'syuruq'     => '05:35:00',
                'dhuha'      => '06:06:00',
                'dzuhur'     => '11:48:00',
                'ashar'      => '15:01:00',
                'maghrib'    => '17:54:00',
                'isya'       => '18:58:00',
                'source'     => 'myquran',
                'created_at' => '2026-09-16 17:00:30',
            ],
        ]);

        // 2. Seed `media_slider`
        $this->db->table('media_slider')->insertBatch([
            [
                'id'       => 10,
                'filename' => '1788847829_988da7014a6121a4c9c8.png',
                'title'    => 'Sebaik-baiknya sholat',
                'type'     => 'image',
                'caption'  => null,
                'ordering' => 1788847829,
                'duration' => 10000,
                'enabled'  => 1,
            ],
            [
                'id'       => 11,
                'filename' => '1766098143_13e509ff1dc4cfdfc6ba.jpg',
                'title'    => 'Taklim Ukhuwwah',
                'type'     => 'image',
                'caption'  => null,
                'ordering' => 1788850055,
                'duration' => 10000,
                'enabled'  => 1,
            ],
        ]);

        // 3. Seed `pengaturan`
        $this->db->table('pengaturan')->insertBatch([
            ['id' => 1,  'keyname' => 'lokasi_lat', 'value' => '-6.914744', 'updated_at' => '2025-11-27 03:44:53'],
            ['id' => 2,  'keyname' => 'lokasi_lng', 'value' => '107.609810', 'updated_at' => '2025-11-27 03:44:53'],
            ['id' => 3,  'keyname' => 'durasi_iqamah_subuh', 'value' => '900', 'updated_at' => '2026-09-17 06:40:38'],
            ['id' => 4,  'keyname' => 'durasi_iqamah_dzuhur', 'value' => '600', 'updated_at' => '2026-09-13 09:02:48'],
            ['id' => 5,  'keyname' => 'durasi_iqamah_ashar', 'value' => '600', 'updated_at' => '2026-09-13 09:02:48'],
            ['id' => 6,  'keyname' => 'durasi_iqamah_maghrib', 'value' => '300', 'updated_at' => '2026-09-13 09:02:48'],
            ['id' => 7,  'keyname' => 'durasi_iqamah_isya', 'value' => '600', 'updated_at' => '2026-09-13 09:02:48'],
            ['id' => 8,  'keyname' => 'audio_adzan', 'value' => '0', 'updated_at' => '2025-11-27 03:44:53'],
            ['id' => 9,  'keyname' => 'theme', 'value' => 'default', 'updated_at' => '2025-11-27 03:44:53'],
            ['id' => 10, 'keyname' => 'nama_masjid', 'value' => 'Masjid Al Ukhuwwah Griya Saluyu', 'updated_at' => '2025-11-27 06:25:47'],
            ['id' => 11, 'keyname' => 'alamat_masjid', 'value' => 'Komp. Griya Saluyu, Rancasari', 'updated_at' => '2025-11-27 22:19:29'],
            ['id' => 12, 'keyname' => 'kode_kota', 'value' => 'fc221309746013ac554571fbd180e1c8', 'updated_at' => '2026-09-08 06:39:12'],
            ['id' => 13, 'keyname' => 'nama_kota', 'value' => 'KOTA BANDUNG', 'updated_at' => '2025-11-27 06:25:47'],
            ['id' => 14, 'keyname' => 'running_text', 'value' => 'Dukung operasional DKM Al Ukhuwwah. Donasi: Muamalat 1010106464 (DKM Al Ukhuwwah GS) | Jago Syariah 501010697891 (Dicky Nurdiansyah)', 'updated_at' => '2025-12-12 03:18:50'],
            ['id' => 15, 'keyname' => 'durasi_menjelang_adzan', 'value' => '600', 'updated_at' => '2025-11-28 22:27:51'],
            ['id' => 16, 'keyname' => 'durasi_adzan', 'value' => '240', 'updated_at' => '2025-11-28 22:27:51'],
            ['id' => 17, 'keyname' => 'durasi_menjelang_iqamah', 'value' => '300', 'updated_at' => '2025-11-28 22:27:51'],
            ['id' => 18, 'keyname' => 'durasi_waktu_sholat', 'value' => '600', 'updated_at' => '2025-11-28 22:27:51'],
            ['id' => 19, 'keyname' => 'durasi_khutbah_jumat', 'value' => '1200', 'updated_at' => '2025-11-28 22:27:51'],
            ['id' => 20, 'keyname' => 'mode', 'value' => 'online', 'updated_at' => '2026-09-08 06:27:26'],
            ['id' => 21, 'keyname' => 'jadwal_kode_kota', 'value' => 'fc221309746013ac554571fbd180e1c8', 'updated_at' => '2026-09-08 06:39:02'],
            ['id' => 32, 'keyname' => 'durasi_sholat_subuh', 'value' => '900', 'updated_at' => '2026-09-13 09:00:19'],
            ['id' => 33, 'keyname' => 'durasi_sholat_dzuhur', 'value' => '420', 'updated_at' => '2026-09-13 09:00:19'],
            ['id' => 34, 'keyname' => 'durasi_sholat_ashar', 'value' => '420', 'updated_at' => '2026-09-13 09:00:19'],
            ['id' => 35, 'keyname' => 'durasi_sholat_maghrib', 'value' => '900', 'updated_at' => '2026-09-13 09:00:19'],
            ['id' => 36, 'keyname' => 'durasi_sholat_isya', 'value' => '900', 'updated_at' => '2026-09-13 09:00:19'],
        ]);
    }
}