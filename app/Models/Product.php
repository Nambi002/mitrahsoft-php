<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
protected $fillable = [
    'name',
    'sku',
    'price',
    'short_description',
    'long_description',
    'stock',
    'saleable_quantity',
    'category_id',
    'image'
];
public function category()
{
    return $this->belongsTo(Category::class);
}

}
