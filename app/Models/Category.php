<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends UuidModel
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['title', 'metaTitle', 'product_id', 'slug'];
    
    public $incrementing = false;

    public function parent_category() {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }
}
