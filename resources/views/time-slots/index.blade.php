@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Manage Time Slots</h2>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Slot Name</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($timeSlots as $slot)
                                    <tr>
                                        <td>{{ $slot->slot_name }}</td>
                                        <td>{{ $slot->start_time }}</td>
                                        <td>{{ $slot->end_time }}</td>
                                        <td>{{ $slot->order_number }}</td>
                                        <td>
                                            <span class="badge {{ $slot->is_active ? 'bg-success' : 'bg-danger' }}">
                                                {{ $slot->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('time-slots.edit', $slot) }}"
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
