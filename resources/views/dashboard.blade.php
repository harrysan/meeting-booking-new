@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Meeting Booking Dashboard</h2>
                <div>
                    <a href="{{ route('bookings.create', ['date' => $selectedDate]) }}" class="btn btn-primary">New
                        Booking</a>
                    <a href="{{ route('meeting-rooms.index') }}" class="btn btn-outline-secondary">Manage Rooms</a>
                    <a href="{{ route('time-slots.index') }}" class="btn btn-outline-secondary">Manage Time Slots</a>
                </div>
            </div>

            <!-- Date Selector -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('dashboard') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Pilih Tanggal:</label>
                                <input type="date" name="date" class="form-control" value="{{ $selectedDate }}"
                                    onchange="this.form.submit()">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Booking Table -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Bookings for {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Time Slot</th>
                                    @foreach ($meetingRooms as $room)
                                        <th>{{ $room->room_name }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($timeSlots as $timeSlot)
                                    <tr>
                                        <td class="fw-bold">
                                            {{ $timeSlot->slot_name }}<br>
                                            <small>{{ $timeSlot->start_time }} - {{ $timeSlot->end_time }}</small>
                                        </td>
                                        @foreach ($meetingRooms as $room)
                                            @php
                                                $booking = $bookings
                                                    ->where('meeting_room_id', $room->id)
                                                    ->where('time_slot_id', $timeSlot->id)
                                                    ->first();
                                            @endphp
                                            <td class="text-center">
                                                @if ($booking)
                                                    <div class="bg-warning bg-opacity-25 p-2 rounded">
                                                        <strong>{{ $booking->meeting_title }}</strong><br>
                                                        <small>By: {{ $booking->booker_name }}</small>
                                                        <br>
                                                        <a href="{{ route('bookings.edit', $booking) }}"
                                                            class="btn btn-sm btn-outline-primary mt-1">Edit</a>
                                                    </div>
                                                @else
                                                    <a href="{{ route('bookings.create', [
                                                        'date' => $selectedDate,
                                                        'meeting_room_id' => $room->id,
                                                        'time_slot_id' => $timeSlot->id,
                                                    ]) }}"
                                                        class="btn btn-success btn-sm">Available</a>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
