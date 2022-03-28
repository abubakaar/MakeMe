<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $interest = new Interest();
        $data = [
            'id'=> 1,
            'name'=> 'Smoking',
        ];
        $interest->persist($data);
    }
}
