<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['categories'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            !$product->store_id && ($product->store_id = auth()->user()->store->id ?? Store::first()->id);
            $product->slug = Str::slug($product->name);
            !$product->qty && ($product->qty = 1);
        });

        static::deleting(function ($product) {
            $product->categories()->detach();
        });
    }
}
