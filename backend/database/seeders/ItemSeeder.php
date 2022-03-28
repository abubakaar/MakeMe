<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::find(1);
        $customer = Customer::find(1);


        for ($i = 0; $i < 10; $i++) {
            $item = new Item();
            $data = [
                'title' => "Iphone XS MAX",
                'description' => "screen py halaka sa dot ha baki 10/10 ha",
                'price' => "150000",
                'location' => "Rawalpindi",
                'is_sold' => "0",
                'at_ducan' => "0",
            ];
            $item->persist($data);
            $category->items()->save($item);
            $customer->items()->save($item);

        }
    }
}
