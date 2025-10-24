@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Time Slot</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('time-slots.update', $timeSlot) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Slot Name</label>
                            <input type="text" name="slot_name" class="form-control"
                                value="{{ old('slot_name', $timeSlot->slot_name) }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time</label>
                                    <input type="time" name="start_time" class="form-control"
                                        value="{{ old('start_time', $timeSlot->start_time) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time</label>
                                    <input type="time" name="end_time" class="form-control"
                                        value="{{ old('end_time', $timeSlot->end_time) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Order Number</label>
                            <input type="number" name="order_number" class="form-control"
                                value="{{ old('order_number', $timeSlot->order_number) }}" required>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" value="1"
                                    {{ $timeSlot->is_active ? 'checked' : '' }}>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update Time Slot</button>
                            <a href="{{ route('time-slots.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
