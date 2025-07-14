<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'ca_description',
        'en_description',
        'price',
        'category_id',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function images()
{
    return $this->hasMany(ProductImage::class);
}

    // Product.php
    public function getRouteKeyName()
    {
        return 'slug';
    }


}
