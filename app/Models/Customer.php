<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bills(): HasMany
    {
        return $this->hasMany(Billing::class, 'customer_id');
    }
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'customer_id');
    }

    public function balance()
    {
        $totalBills = $this->bills()->sum('grand_total');
        $opening_balance = $this->opening_balance;
        $totalPayments = $this->payments()->sum('amount');
        return $totalBills - $totalPayments-$opening_balance;
    }
}
