<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meeting_room_id')->constrained();
            $table->foreignId('time_slot_id')->constrained();
            $table->date('booking_date');
            $table->string('booker_name');
            $table->string('meeting_title');
            $table->text('description')->nullable();
            $table->timestamps();

            // Unique constraint untuk prevent double booking
            $table->unique(['meeting_room_id', 'time_slot_id', 'booking_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
