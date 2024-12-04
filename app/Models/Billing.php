<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Billing extends Model
{
    use HasFactory;
    protected $table= 'billing';
    protected $guarded = [];
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id')->select('name');
    }
}
