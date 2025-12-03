<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function billings()
    {
        return $this->hasMany(SupplierBilling::class, 'supplier_id');
    }

    public function getBalanceAttribute()
    {
        $totalBills = $this->billings()->sum('bill_amount');
        $totalPaid  = $this->billings()->sum('paid');

        return $totalBills - $totalPaid;
    }
     public function scopeActive($query, $status)
    {
        return $query->where('status', $status);
    }
}
