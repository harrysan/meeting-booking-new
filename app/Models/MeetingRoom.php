<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingRoom extends Model
{
    protected $fillable = ['room_name', 'google_meet_link', 'description', 'is_active'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
