<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cabang;

class CabangSeeder extends Seeder
{
    public function run(): void
    {
        $cabang = [
            [
                'nama_cabang' => 'Dimsum BOS Antapani',
                'alamat' => 'Jl. Antapani No. 123, Antapani, Bandung, Jawa Barat',
                'telepon' => '(022) 2001-0001',
                'email' => 'antapani@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Cabang Dimsum BOS di area Antapani dengan suasana modern',
                'urutan' => 1,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS Metro',
                'alamat' => 'Jl. Metro Indah Mall Lt. 2, Bandung, Jawa Barat',
                'telepon' => '(022) 2001-0002',
                'email' => 'metro@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Outlet di Metro Indah Mall dengan konsep food court premium',
                'urutan' => 2,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS Ciguruwik',
                'alamat' => 'Jl. Raya Ciguruwik No. 45, Ciguruwik, Bandung, Jawa Barat',
                'telepon' => '(022) 2001-0003',
                'email' => 'ciguruwik@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Cabang strategis di area Ciguruwik',
                'urutan' => 3,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS Cimahi',
                'alamat' => 'Jl. Raya Cimahi No. 67, Cimahi, Jawa Barat',
                'telepon' => '(022) 2001-0004',
                'email' => 'cimahi@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Melayani area Cimahi dan sekitarnya dengan menu terlengkap',
                'urutan' => 4,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS Cianjur',
                'alamat' => 'Jl. Ir. H. Juanda No. 89, Cianjur, Jawa Barat',
                'telepon' => '(0263) 2001-0005',
                'email' => 'cianjur@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Cabang pertama di Cianjur dengan cita rasa autentik',
                'urutan' => 5,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS Garut',
                'alamat' => 'Jl. Cimanuk No. 12, Garut, Jawa Barat',
                'telepon' => '(0262) 2001-0006',
                'email' => 'garut@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Hadir di kota Garut dengan suasana hangat khas daerah',
                'urutan' => 6,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS Jatinagor',
                'alamat' => 'Jl. Raya Jatinagor No. 34, Jatinagor, Sumedang, Jawa Barat',
                'telepon' => '(022) 2001-0007',
                'email' => 'jatinagor@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Lokasi strategis dekat kampus dengan harga mahasiswa friendly',
                'urutan' => 7,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS Majalaya',
                'alamat' => 'Jl. Raya Majalaya No. 56, Majalaya, Bandung, Jawa Barat',
                'telepon' => '(022) 2001-0008',
                'email' => 'majalaya@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Melayani masyarakat Majalaya dengan menu favorit',
                'urutan' => 8,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS Majalengka',
                'alamat' => 'Jl. K.H. Ahmad Sanusi No. 78, Majalengka, Jawa Barat',
                'telepon' => '(0233) 2001-0009',
                'email' => 'majalengka@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Expansion terbaru di Majalengka dengan konsep modern',
                'urutan' => 9,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS Sumedang',
                'alamat' => 'Jl. Mayor Abdurahman No. 90, Sumedang, Jawa Barat',
                'telepon' => '(0261) 2001-0010',
                'email' => 'sumedang@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Terletak di pusat kota Sumedang yang mudah diakses',
                'urutan' => 10,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS Tasikmalaya',
                'alamat' => 'Jl. Ir. H. Juanda No. 112, Tasikmalaya, Jawa Barat',
                'telepon' => '(0265) 2001-0011',
                'email' => 'tasik@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Menghadirkan kelezatan dimsum di kota Tasikmalaya',
                'urutan' => 11,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS Ciumbuleuit',
                'alamat' => 'Jl. Ciumbuleuit No. 134, Cidadap, Bandung, Jawa Barat',
                'telepon' => '(022) 2001-0012',
                'email' => 'ciumbuleuit@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Cabang premium di area Ciumbuleuit dengan view pegunungan',
                'urutan' => 12,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS Ujung Berung',
                'alamat' => 'Jl. Raya Ujung Berung No. 156, Ujung Berung, Bandung, Jawa Barat',
                'telepon' => '(022) 2001-0013',
                'email' => 'ujungberung@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Melayani area Ujung Berung dan kawasan timur Bandung',
                'urutan' => 13,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS Bekasi',
                'alamat' => 'Jl. Raya Bekasi No. 178, Bekasi, Jawa Barat',
                'telepon' => '(021) 2001-0014',
                'email' => 'bekasi@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Ekspansi ke area Bekasi dengan fasilitas lengkap',
                'urutan' => 14,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS Kuningan',
                'alamat' => 'Jl. Siliwangi No. 200, Kuningan, Jawa Barat',
                'telepon' => '(0232) 2001-0015',
                'email' => 'kuningan@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Hadir di Kuningan dengan menu andalan dan pelayanan terbaik',
                'urutan' => 15,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS Cirebon',
                'alamat' => 'Jl. Tuparev No. 222, Cirebon, Jawa Barat',
                'telepon' => '(0231) 2001-0016',
                'email' => 'cirebon@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Membawa cita rasa dimsum terbaik ke kota Cirebon',
                'urutan' => 16,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS Sukabumi',
                'alamat' => 'Jl. Ahmad Yani No. 244, Sukabumi, Jawa Barat',
                'telepon' => '(0266) 2001-0017',
                'email' => 'sukabumi@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Outlet terbaru di Sukabumi dengan konsep family friendly',
                'urutan' => 17,
                'status_aktif' => true
            ],
            [
                'nama_cabang' => 'Dimsum BOS NHI',
                'alamat' => 'Jl. Raya NHI No. 266, Bandung, Jawa Barat',
                'telepon' => '(022) 2001-0018',
                'email' => 'nhi@dimsumbos.com',
                'jam_operasional' => 'Senin-Minggu: 10:00-22:00',
                'deskripsi' => 'Cabang Dimsum BOS di area NHI',
                'urutan' => 18,
                'status_aktif' => true
            ]
        ];

        foreach ($cabang as $item) {
            Cabang::create($item);
        }
    }
}
