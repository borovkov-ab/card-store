<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\StoreScope;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('qty');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new StoreScope);
    }
}
