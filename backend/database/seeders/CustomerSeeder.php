<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = new Customer();
        $data = [
            'name'=> 'Danish',
            'email'=> 'danish@mail.com',
            'password'=> 'asdasdasd',
            'phone_no' => "03315143998"
        ];
        $customer->persist($data);

    }
}
