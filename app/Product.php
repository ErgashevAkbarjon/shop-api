<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "name",
        "image",
        "price",
        "published"
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
