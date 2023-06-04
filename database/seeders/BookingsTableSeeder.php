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
            'option_id' => 1,   // assuming you have an option with this id
            'status_id' => 1,   // assuming you have a status with this id
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('bookings')->insert([
            'start_date' => '2023-11-23',
            'end_date' => '2023-11-24',
            'price' => 3000,
            'name' => 'Marie',
            'surname' => 'Jane',
            'email' => 'marie.jane@example.com',
            'phone' => '1234567890',
            'persons' => 8,
            'cottage_id' => 3,  // assuming you have a cottage with this id
            'option_id' => 3,   // assuming you have an option with this id
            'status_id' => 1,   // assuming you have a status with this id
            'created_at' => '2023-06-01',
            'updated_at' => now(),
        ]);

        DB::table('bookings')->insert([
            'start_date' => '2023-08-21',
            'end_date' => '2023-08-24',
            'price' => 400,
            'name' => 'Sarah',
            'surname' => 'Croche',
            'email' => 'sarah.croche@example.com',
            'phone' => '1234567890',
            'persons' => 2,
            'cottage_id' => 2,  // assuming you have a cottage with this id
            'option_id' => 4,   // assuming you have an option with this id
            'status_id' => 1,   // assuming you have a status with this id
            'created_at' => '2023-06-02',
            'updated_at' => now(),
        ]);

        DB::table('bookings')->insert([
            'start_date' => '2023-12-22',
            'end_date' => '2023-12-24',
            'price' => 4334,
            'name' => 'Alex',
            'surname' => 'Térieur',
            'email' => 'alex.térieur@example.com',
            'phone' => '1234567890',
            'persons' => 4,
            'cottage_id' => 1,  // assuming you have a cottage with this id
            'option_id' => 1,   // assuming you have an option with this id
            'status_id' => 1,   // assuming you have a status with this id
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
