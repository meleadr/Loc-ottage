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
        Schema::create('booking_has_options', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('booking_id')->nullable();
			$table->foreign('booking_id')->references('id')->on('bookings');
			$table->unsignedBigInteger('option_id')->nullable();
			$table->foreign('option_id')->references('id')->on('options');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_has_options');
    }
};
