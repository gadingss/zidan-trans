<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    protected $primaryKey = 'booking_id';
    protected $fillable = [
        'user_id', 'service_id', 'vehicle_id', 'booking_date', 'pickup_date', 'end_date', 'pickup_time', 'status', 
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }
    

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'booking_id');
    }
    public function getKeyName()
    {
        return 'booking_id'; // Gunakan 'booking_id' sebagai key
    }

    // app/Models/Booking.php

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }

}

