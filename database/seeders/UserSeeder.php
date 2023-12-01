<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin',
                'password' => bcrypt('12345'),
                'role' => '1',
                'slug' => 'admin'
            ],
            [
                'name' => 'Karyawan',
                'email' => 'karyawan',
                'password' => bcrypt('12345'),
                'role' => '2',
                'slug' => 'karyawan'
            ],

            // Tambahkan data perusahaan lainnya sesuai kebutuhan
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
