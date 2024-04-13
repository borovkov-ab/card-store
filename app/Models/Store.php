<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Concerns\HasUuids;

use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Store extends Authenticatable
{
    use HasFactory;
    // use HasUuids;
    use Notifiable;

    protected $guarded = [];

    protected $hidden = ['password', 'remember_token'];

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

     /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
