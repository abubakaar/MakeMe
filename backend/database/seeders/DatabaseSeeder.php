<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
//            CustomerSeeder::class,
//            CategorySeeder::class,
//            ItemSeeder::class,
//            ItemImagesSeeder::class,
//            SubCategorySeeder::class
              InterestSeeder::class,
              CountrySeeder::class,
              ZipCodeSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
