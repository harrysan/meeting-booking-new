@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Meeting Room</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('meeting-rooms.update', $meetingRoom) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Room Name</label>
                            <input type="text" name="room_name" class="form-control"
                                value="{{ old('room_name', $meetingRoom->room_name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Google Meet Link</label>
                            <input type="url" name="google_meet_link" class="form-control"
                                value="{{ old('google_meet_link', $meetingRoom->google_meet_link) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $meetingRoom->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" value="1"
                                    {{ $meetingRoom->is_active ? 'checked' : '' }}>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update Room</button>
                            <a href="{{ route('meeting-rooms.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
