<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagePresets extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function scopeActive($query, $status)
    {
        return $query->where('status', $status);
    }
}
