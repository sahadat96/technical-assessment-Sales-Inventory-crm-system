<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'sale_id',
        'type',
        'quantity',
        'previous_stock',
        'new_stock',
        'user_id',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
