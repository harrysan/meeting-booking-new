<?php

namespace App\Http\Controllers;

use App\Models\MeetingRoom;
use Illuminate\Http\Request;

class MeetingRoomController extends Controller
{
    public function index()
    {
        $meetingRooms = MeetingRoom::all();
        return view('meeting-rooms.index', compact('meetingRooms'));
    }

    public function edit(MeetingRoom $meetingRoom)
    {
        return view('meeting-rooms.edit', compact('meetingRoom'));
    }

    public function update(Request $request, MeetingRoom $meetingRoom)
    {
        $request->validate([
            'room_name' => 'required|string|max:255',
            'google_meet_link' => 'required|url',
            'description' => 'nullable|string',
        ]);

        $meetingRoom->update($request->all());

        return redirect()->route('meeting-rooms.index')
            ->with('success', 'Meeting room updated successfully');
    }
}
