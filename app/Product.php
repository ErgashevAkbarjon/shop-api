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

    protected $casts = [
        "published" => "boolean"
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
