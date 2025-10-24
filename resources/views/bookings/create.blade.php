@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">New Booking</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="booking_date" class="form-control" value="{{ $selectedDate }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meeting Room</label>
                            <select name="meeting_room_id" class="form-control" required>
                                <option value="">Pilih Ruangan</option>
                                @foreach ($meetingRooms as $room)
                                    <option value="{{ $room->id }}"
                                        {{ request('meeting_room_id') == $room->id ? 'selected' : '' }}>
                                        {{ $room->room_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Time Slot</label>
                            <select name="time_slot_id" class="form-control" required>
                                <option value="">Pilih Sesi</option>
                                @foreach ($timeSlots as $slot)
                                    <option value="{{ $slot->id }}"
                                        {{ request('time_slot_id') == $slot->id ? 'selected' : '' }}>
                                        {{ $slot->slot_name }} ({{ $slot->start_time }} - {{ $slot->end_time }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Booker</label>
                            <input type="text" name="booker_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul Meeting</label>
                            <input type="text" name="meeting_title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi (Optional)</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Book Now</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
