<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class StoreScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $store_id = request('store_id') ?? (!Auth::guard('admin')->check() ? Auth::guard('stores')->id() : null);
        $store_id && $builder->where('store_id', $store_id);
    }
}
