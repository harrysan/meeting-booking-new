<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TimeSlot;
use App\Models\MeetingRoom;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->get('date', date('Y-m-d'));

        $bookings = Booking::with(['meetingRoom', 'timeSlot'])
            ->where('booking_date', $selectedDate)
            ->orderBy('time_slot_id')
            ->orderBy('meeting_room_id')
            ->get();

        $meetingRooms = MeetingRoom::active()->get();
        $timeSlots = TimeSlot::active()->orderBy('order_number')->get();

        return view('dashboard', compact('bookings', 'meetingRooms', 'timeSlots', 'selectedDate'));
    }
}
