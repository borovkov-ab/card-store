<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

use Illuminate\Support\Str;


class Store extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($store) {
            $store->slug = Str::slug($store->name);
        });
    }
}
