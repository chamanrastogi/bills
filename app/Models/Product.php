<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function unit(): BelongsTo
    {
        return $this->belongsto(Unit::class, 'unit_id')->withDefault([
            'name' => '', // or any other attribute you want to default to ''
        ]);
    }
    public function formattedUnit(): string
    {
        return $this->unit->name ? "- Per " . $this->unit->name : '';
    }
}
