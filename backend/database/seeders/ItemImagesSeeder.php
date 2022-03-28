<?php

namespace Database\Seeders;


use App\Models\Item;
use App\Models\Item_images;
use Illuminate\Database\Seeder;

class ItemImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($w = 1; $w <= 10; $w++) {
            $item = Item::find($w);

            for ($i = 0; $i < 3; $i++) {
                $img = new Item_images();
                $data = [
                    'image' => "https://www.google.com/images/branding/googlelogo/2x/googlelogo_light_color_272x92dp.png",
                ];
                $img->persist($data);
                $item->itemImages()->save($img);
            }
        }
    }
}
