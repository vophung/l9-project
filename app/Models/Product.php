<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BinaryCats\Sku\HasSku;

class Product extends UuidModel
{
    use HasFactory;

    protected $table = 'products';

    protected $guarded = [];

    public $incrementing = false;

    public function cart() {
        return $this->belongsToMany('App\Models\Cart');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function category() {
        return $this->belongsToMany('App\Models\Category', 'products_categories');
    }

    public function images() {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function images_default() {
        return $this->hasMany('App\Models\ProductImage')->where('product_image_caption', 'default');
    }

    public function images_hover() {
        return $this->hasMany('App\Models\ProductImage')->where('product_image_caption', 'hover');
    }
}
