<?php

namespace Database\Seeders;

use App\Models\TimeSlot;
use App\Models\MeetingRoom;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InitialDataSeeder extends Seeder
{
    public function run()
    {
        // Time Slots
        TimeSlot::create([
            'slot_name' => 'Sesi Pagi',
            'start_time' => '08:00',
            'end_time' => '12:00',
            'is_active' => true,
            'order_number' => 1,
        ]);

        TimeSlot::create([
            'slot_name' => 'Sesi Siang',
            'start_time' => '13:00',
            'end_time' => '17:00',
            'is_active' => true,
            'order_number' => 2,
        ]);

        // Meeting Rooms
        $rooms = [
            ['Ruang Rapat 1', 'https://meet.google.com/abc-123-def'],
            ['Ruang Rapat 2', 'https://meet.google.com/ghi-456-jkl'],
            ['Ruang Rapat 3', 'https://meet.google.com/mno-789-pqr'],
            ['Ruang Rapat 4', 'https://meet.google.com/stu-012-vwx'],
            ['Ruang Rapat 5', 'https://meet.google.com/yza-345-bcd'],
            ['Ruang Rapat 6', 'https://meet.google.com/efg-678-hij'],
        ];

        foreach ($rooms as $index => $room) {
            MeetingRoom::create([
                'room_name' => $room[0],
                'google_meet_link' => $room[1],
                'description' => 'Meeting room ' . ($index + 1),
                'is_active' => true,
            ]);
        }
    }
}
