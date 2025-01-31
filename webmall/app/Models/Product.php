<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // without json as array  n doesnt work with voyager
    // protected $casts = [
    //     'product_attributes' => 'array'
    // ];

    // protected static function booted()
    // {
    //     static::saving(function ($product) {
    //         // dd(request('product_attributes'));
    //         $product->product_attributes = request('product_attributes');
    //     });
    // }


    //add attribute with json when saving product
    protected static function booted()
    {
        static::saving(function ($product) {
            // dd(request('product_attributes'));
            $product->product_attributes = json_encode(request('product_attributes'));
        });
    }


    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}
