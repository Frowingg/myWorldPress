<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id'
    ];

    // collego la tab products
    public function category() {
        return $this->belongsTo('App\Category');
    }
}
