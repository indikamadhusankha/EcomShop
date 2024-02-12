<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'supplier',
        'category_id',
        'sub_category_id',
        'band_id',
        'sku',
        'barcode',
        'status',
    ];
}
