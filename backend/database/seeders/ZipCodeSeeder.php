<?php

namespace Database\Seeders;

use App\Models\ZipCode;
use Illuminate\Database\Seeder;

class ZipCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $zipCode = new ZipCode();
        $data = [
            'id'=> 1,
            'zip_code'=> '4600',
            'country_id' => 1
        ];
        $zipCode->persist($data);
    }
}
