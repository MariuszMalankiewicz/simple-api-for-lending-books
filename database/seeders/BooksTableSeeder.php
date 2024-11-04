<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 60; $i++) {
            DB::table('books')->insert([
                'title' => $faker->sentence(3),
                'author' => $faker->name,
                'publication_year' => $faker->year,
                'publisher' => $faker->company,
                'is_borrowed' => $faker->boolean(false),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
