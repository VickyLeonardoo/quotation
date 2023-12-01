<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        foreach (range(1, 20) as $index) {
            DB::table('produks')->insert([
                'kodeProduk' => $faker->unique()->ean13,
                'namaProduk' => $faker->word,
                'hargaProduk' => $faker->randomFloat(2, 1000, 1000000),
                'slug' => $faker->slug,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
