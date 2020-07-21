<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "name",
        "image",
        "price",
        "published"
    ];

    protected $casts = [
        "published" => "boolean",
        "price" => "decimal:2"
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeByCategory($query, $attribute, $value)
    {
        return $query->whereHas(
            'categories',
            function ($query) use($attribute, $value) {
                $query->where($attribute, $value);
            }
        );
    }
}
