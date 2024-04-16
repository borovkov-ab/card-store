<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attribure;
use App\Models\Scopes\StoreScope;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'products'];

    protected $casts = [
        'customer' => 'array',
    ];

    protected function customer(): Attribute
    {
        return Attribute::make(
            set: fn (array $value) => json_encode($value),
        );
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('qty');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->store_id = session('store_id');
        });
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new StoreScope);
    }
}
