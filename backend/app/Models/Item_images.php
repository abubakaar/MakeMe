<?php

namespace App\Models;



class Item_images extends Model
{
    public function item(){
         return $this->belongsTo(Item::class);
    }
}
