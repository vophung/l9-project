<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends UuidModel
{
    use HasFactory;

    protected $tables = 'products';

    protected $fillable = ['name','price','description','image'];

    public $incrementing = false;

}
