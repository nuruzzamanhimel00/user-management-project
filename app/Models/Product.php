<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public const FILE_STORE_PATH = 'products';
    public const FILE_STORE_PATH_IMAGE = 'images/products';
}
