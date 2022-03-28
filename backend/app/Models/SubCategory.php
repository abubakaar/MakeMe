<?php

namespace App\Models;


class SubCategory extends Model
{
    public function category(){
        return $this->belongsTo(Category::class);
    }

}
