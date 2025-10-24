<?php

namespace App\Http\Controllers;

use App\Models\TimeSlot;
use Illuminate\Http\Request;

class TimeSlotController extends Controller
{
    public function index()
    {
        $timeSlots = TimeSlot::orderBy('order_number')->get();
        return view('time-slots.index', compact('timeSlots'));
    }

    public function edit(TimeSlot $timeSlot)
    {
        return view('time-slots.edit', compact('timeSlot'));
    }

    public function update(Request $request, TimeSlot $timeSlot)
    {
        $request->validate([
            'slot_name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_active' => 'boolean',
            'order_number' => 'required|integer',
        ]);

        $timeSlot->update($request->all());

        return redirect()->route('time-slots.index')
            ->with('success', 'Time slot updated successfully');
    }
}
