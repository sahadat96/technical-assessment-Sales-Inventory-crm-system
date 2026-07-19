<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerCampaign extends Model
{
    protected $fillable = [
        'customer_id',
        'user_id',
        'channel',
        'subject',
        'message',
        'status',
        'sent_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
