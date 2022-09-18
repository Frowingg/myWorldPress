<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // collego la tab categories a products
    public function products() {
        return $this->hasMany('App\Product');
    }
}
