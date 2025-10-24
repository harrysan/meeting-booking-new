<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TimeSlot;
use App\Models\MeetingRoom;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $meetingRooms = MeetingRoom::active()->get();
        $timeSlots = TimeSlot::active()->orderBy('order_number')->get();
        $selectedDate = $request->get('date', date('Y-m-d'));

        return view('bookings.create', compact('meetingRooms', 'timeSlots', 'selectedDate'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'meeting_room_id' => 'required|exists:meeting_rooms,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'booking_date' => 'required|date',
            'booker_name' => 'required|string|max:255',
            'meeting_title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Check for existing booking
        $existingBooking = Booking::where('meeting_room_id', $request->meeting_room_id)
            ->where('time_slot_id', $request->time_slot_id)
            ->where('booking_date', $request->booking_date)
            ->first();

        if ($existingBooking) {
            return back()->withErrors(['error' => 'Slot sudah dipesan!'])->withInput();
        }

        Booking::create($request->all());

        return redirect()->route('dashboard')
            ->with('success', 'Booking berhasil dibuat!');
    }

    public function index()
    {
        $bookings = Booking::with(['meetingRoom', 'timeSlot'])
            ->orderBy('booking_date', 'desc')
            ->orderBy('time_slot_id')
            ->paginate(20);

        return view('bookings.index', compact('bookings'));
    }

    public function edit(Booking $booking)
    {
        $meetingRooms = MeetingRoom::active()->get();
        $timeSlots = TimeSlot::active()->orderBy('order_number')->get();

        return view('bookings.edit', compact('booking', 'meetingRooms', 'timeSlots'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'meeting_room_id' => 'required|exists:meeting_rooms,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'booking_date' => 'required|date',
            'booker_name' => 'required|string|max:255',
            'meeting_title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Check for existing booking (excluding current booking)
        $existingBooking = Booking::where('meeting_room_id', $request->meeting_room_id)
            ->where('time_slot_id', $request->time_slot_id)
            ->where('booking_date', $request->booking_date)
            ->where('id', '!=', $booking->id)
            ->first();

        if ($existingBooking) {
            return back()->withErrors(['error' => 'Slot sudah dipesan!'])->withInput();
        }

        $booking->update($request->all());

        return redirect()->route('bookings.index')
            ->with('success', 'Booking updated successfully');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Booking deleted successfully');
    }
}
