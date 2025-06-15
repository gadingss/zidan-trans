<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'payment_id';
    protected $fillable = ['booking_id', 'payment_date', 'amount', 'payment_method', 'payment_status', 'order_id', 'snap_token'];

    protected $attributes = [
        'payment_status' => 'pending',
    ];

    protected $with = ['booking'];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }
    
}
