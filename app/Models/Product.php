<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'status'];

    protected static function booted()
    {
        
        static::created(function ($product) {
            $product->code = 'P' . str_pad($product->id, 5, '0', STR_PAD_LEFT);
            $product->saveQuietly();
        });
    }
}
