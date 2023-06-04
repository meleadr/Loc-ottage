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
        Schema::create('historique_bookings', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('id_user')->nullable();
			$table->foreign('id_user')->references('id')->on('users');
			$table->unsignedBigInteger('id_booking')->nullable();
			$table->foreign('id_booking')->references('id')->on('bookings');
			$table->unsignedBigInteger('id_status_before')->nullable();
			$table->foreign('id_status_before')->references('id')->on('status');
			$table->unsignedBigInteger('id_status_after')->nullable();
			$table->foreign('id_status_after')->references('id')->on('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_bookings');
    }
};
