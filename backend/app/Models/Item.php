<?php

namespace App\Models;


class Item extends Model
{
    public function category(){
      return  $this->belongsTo(Category::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function itemImages(){
        return $this->hasMany(Item_images::class);
    }
}
