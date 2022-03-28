<?php

namespace App\Models;

class Category extends Model
{
    public function items(){
        return $this->hasMany(Item::class);
    }
}
