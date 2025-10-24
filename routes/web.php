<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TimeSlotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeetingRoomController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.get'); // Tambahkan GET untuk link

// Protected Routes
Route::middleware(['admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /// Meeting Rooms
    Route::get('/meeting-rooms', [MeetingRoomController::class, 'index'])->name('meeting-rooms.index');
    Route::get('/meeting-rooms/{meetingRoom}/edit', [MeetingRoomController::class, 'edit'])->name('meeting-rooms.edit');
    Route::put('/meeting-rooms/{meetingRoom}', [MeetingRoomController::class, 'update'])->name('meeting-rooms.update');

    // Time Slots
    Route::get('/time-slots', [TimeSlotController::class, 'index'])->name('time-slots.index');
    Route::get('/time-slots/{timeSlot}/edit', [TimeSlotController::class, 'edit'])->name('time-slots.edit');
    Route::put('/time-slots/{timeSlot}', [TimeSlotController::class, 'update'])->name('time-slots.update');

    // Bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

// Redirect root to login
Route::get('/', function () {
    return redirect('/login');
});
