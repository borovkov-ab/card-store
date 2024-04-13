<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Scopes\StoreScope;


use App\Models\Store;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setAttribute($key, $value) {
        switch($key) {
            case 'name':
                $this->attributes['name'] = $value;
                $this->attributes['slug'] = Str::slug($value);
                break;
            default:
                $this->attributes[$key] = $value;
        }
        parent::setAttribute($key, $value);
    }



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            !$category->store_id && ($category->store_id = Auth::guard('stores')->id() ?? Store::first()->id);
        });

        static::deleting(function ($category) {
            $category->products()->detach();
        });
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new StoreScope);
    }

}
