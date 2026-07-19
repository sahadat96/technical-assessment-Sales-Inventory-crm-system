<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
        protected $fillable = [
        'invoice_no',
        'customer_id',
        'user_id',
        'subtotal',
        'discount',
        'tax',
        'total',
        'payment_method',
        'payment_status',
        'sold_at',
    ];

    protected $casts = [
        'sold_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    public function inventoryTransactions(): HasMany
    {
        return $this->hasMany(InventoryTransaction::class);
    }
}
