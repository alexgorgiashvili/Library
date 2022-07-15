<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        $books = 100;
        $authors = 30;

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('adminadmin'),
        ]);
        foreach (range(1, $authors) as $_) {
            DB::table('authors')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);
        }

        foreach (range(1, $books) as $_) {
            DB::table('books')->insert([
                'title' => $faker->company,
                'year' => rand(1970,2021),
                'status' => rand(0,1),
                
                'author_id' => rand(1,$authors),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);
        }

    }
}
