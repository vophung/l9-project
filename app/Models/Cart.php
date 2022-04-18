<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends UuidModel
{
    use HasFactory;

    protected $table = 'carts';

    public $incrementing = false;

    protected $guarded = [];

    public function product() {
        return $this->belongsToMany('App\Models\Product', 'carts_items');
    }
}
