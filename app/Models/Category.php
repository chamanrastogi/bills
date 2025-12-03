<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $guarded = [];

    public function types(): HasMany
    {
        return $this->hasMany(Type::class);
    }
     public function scopeActive($query, $status)
    {
        return $query->where('status', $status);
    }
}
