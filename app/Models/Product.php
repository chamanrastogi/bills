<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'stock_qty' => 'float',
    ];

    public function Type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function Purity(): BelongsTo
    {
        return $this->belongsTo(Purity::class);
    }

    public function Supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function Unit(): BelongsTo
    {
        return $this->belongsto(Unit::class, 'unit_id')->withDefault([
            'name' => '', // or any other attribute you want to default to ''
        ]);
    }

    public function formattedUnit(): string
    {
        return $this->unit->name ? '- Per '.$this->unit->name : '';
    }
}
