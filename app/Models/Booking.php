<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'meeting_room_id',
        'time_slot_id',
        'booking_date',
        'booker_name',
        'meeting_title',
        'description'
    ];

    protected $dates = ['booking_date'];

    public function meetingRoom()
    {
        return $this->belongsTo(MeetingRoom::class);
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class);
    }
}
