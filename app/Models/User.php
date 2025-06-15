<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Primary Key Configuration
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    protected $keyType = 'int';

    // Mass-Assignable Attributes
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'phone_number',
    ];

    // Hidden Attributes
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Attribute Casting
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Default Attributes
    protected $attributes = [
        'role' => self::ROLE_CLIENT,
    ];

    // Constants for Roles
    const ROLE_ADMIN = 'admin';
    const ROLE_CLIENT = 'client';

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Check if user is a client.
     */
    public function isClient(): bool
    {
        return $this->role === self::ROLE_CLIENT;
    }

    /**
     * Get Filament-compatible name for the user.
     */
    public function getFilamentName(): string
    {
        return $this->username ?? $this->email ?? 'Guest';
    }

    /**
     * Override the default getAttribute method to alias 'name' to 'username'.
     */
    public function getAttribute($key)
    {
        if ($key === 'name') {
            return $this->username;
        }

        return parent::getAttribute($key);
    }

    /**
     * Define a one-to-many relationship with the Booking model.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    /**
     * Define a one-to-many relationship with the Report model (for admins).
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'admin_id');
    }

    /**
     * Get the user's full phone number with country code.
     */
    public function getFullPhoneNumberAttribute(): string
    {
        $countryCode = '+62'; // Example for Indonesia
        return "{$countryCode}{$this->phone_number}";
    }
}
