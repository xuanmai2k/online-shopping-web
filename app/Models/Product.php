<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product';

    public $fillable = [
        'name',
        'price',
        'slug',
        'discount_price',
        'description',
        'short_description',
        'information',
        'qty',
        'shipping',
        'weight',
        'image_url',
        'status',
        'product_category_id'
    ];

    public function category(){
        return $this->belongsTo(ProductCategory::class, 'product_category_id')->withTrashed();
    }
}
