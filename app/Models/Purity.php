<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purity extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function type() : BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
