<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = new Country();

        $data = [
            'id'=> 1,
            'name'=> 'Pakistan',
            'country_code' => '+92'
        ];
        $country->persist($data);
    }
}
