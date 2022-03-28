<?php

namespace App\Models;


class Address extends Model
{
    public function customer(){
       return  $this->belongsTo(Customer::class);
    }
}
