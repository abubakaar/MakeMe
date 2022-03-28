<?php

namespace Database\Seeders;

use App\Models\Category;
use \App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::find(1);
        $subcategory = new SubCategory();
        $data = [
            'name' => "Iphone",
        ];
        $subcategory->persist($data);
        $category->items()->save($subcategory);
    }
}
