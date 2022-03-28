<?php

namespace App\Models;


class Customer extends Model
{
    public function items(){
        return $this->hasMany(Item::class);
    }

    public function address(){
       return $this->hasOne(Address::class);
    }
}
