<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupplierBillingItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function supplierBilling(): BelongsTo
    {
        return $this->belongsTo(SupplierBilling::class);
    }

    public function metalType(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'metal_type_id');
    }

    public function purity(): BelongsTo
    {
        return $this->belongsTo(Purity::class);
    }
}

