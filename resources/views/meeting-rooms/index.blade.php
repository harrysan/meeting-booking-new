@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Manage Meeting Rooms</h2>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Room Name</th>
                                    <th>Google Meet Link</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($meetingRooms as $room)
                                    <tr>
                                        <td>{{ $room->room_name }}</td>
                                        <td>
                                            <a href="{{ $room->google_meet_link }}" target="_blank" class="text-truncate"
                                                style="max-width: 200px; display: inline-block;">
                                                {{ $room->google_meet_link }}
                                            </a>
                                        </td>
                                        <td>{{ $room->description }}</td>
                                        <td>
                                            <span class="badge {{ $room->is_active ? 'bg-success' : 'bg-danger' }}">
                                                {{ $room->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('meeting-rooms.edit', $room) }}"
                                                class="btn btn-sm btn-outline-primary">Edit</a>
                                        </td>
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
