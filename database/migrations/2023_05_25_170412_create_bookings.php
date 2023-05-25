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
			$table->date('start_date');
			$table->date('end_date');
			$table->string('name');
			$table->string('surname');
			$table->string('email');
			$table->string('phone');
			$table->integer('persons');
			$table->unsignedBigInteger('cottage_id')->nullable();
			$table->foreign('cottage_id')->references('id')->on('cottages');
			$table->unsignedBigInteger('option_id')->nullable();
			$table->foreign('option_id')->references('id')->on('options');
			$table->unsignedBigInteger('status_id')->nullable();
			$table->foreign('status_id')->references('id')->on('status');
            $table->timestamps();
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
