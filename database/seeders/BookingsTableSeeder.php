<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
{
    /**
     * Seed the bookings table.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings')->insert([
            'start_date' => '2023-06-01',
            'end_date' => '2023-06-07',
            'price' => 1000,
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'john.doe@example.com',
            'phone' => '1234567890',
            'persons' => 2,
            'cottage_id' => 1,  // assuming you have a cottage with this id
            'status_id' => 1,   // assuming you have a status with this id
            'created_at' => now(),
            'updated_at' => now(),
        ]);

		\App\Models\Booking::factory()->count(50)->create();
    }
}
