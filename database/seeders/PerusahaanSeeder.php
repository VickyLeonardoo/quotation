<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        foreach (range(1, 10) as $index) {
            DB::table('perusahaans')->insert([
                'kode' => $faker->unique()->ean13,
                'nama' => $faker->company,
                'email' => $faker->companyEmail,
                'kota' => $faker->city,
                'provinsi' => $faker->state,
                'kodePos' => $faker->postcode,
                'alamat' => $faker->streetAddress,
                'jalan1' => $faker->streetName,
                'jalan2' => $faker->secondaryAddress,
                'jalan3' => $faker->optional()->secondaryAddress,
                'noTelp' => $faker->phoneNumber,
                'fax' => $faker->optional()->phoneNumber,
                'pic' => $faker->name,
                'slug' => $faker->slug,
            ]);
        }
    }
}
