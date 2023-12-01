<?php

namespace Database\Seeders;

use App\Models\Cv;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cv = [
            'nama' => 'CV Gabril Mitra Perkasa',
            'alamat' => 'Piayu',
            'email' => 'admin@mitra.com',
            'kota' => 'Batam',
            'provinsi' => 'Kepulauan Riau',
            'jalan1' => 'Komp, Jl. Ruko GMP No.6, Tj. Piayu',
            'jalan2' => 'Kec. Sei Beduk,',
            'jalan3' => '',
            'noTelp' => '07787878',
            'fax' => '',
            'kodePos' => '29432',
        ];
        Cv::create($cv);
    }
}
