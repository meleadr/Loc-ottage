<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistoriqueBookingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		
		DB::table('historique_bookings')->insert([
			'id_user' => 1,
			'id_booking' => 1,
			'id_status_before' => 1,
			'id_status_after' => 2,
			'created_at' => now(),
			'updated_at' => now(),
		]);

		DB::table('historique_bookings')->insert([
			'id_user' => 1,
			'id_booking' => 2,
			'id_status_before' => 1,
			'id_status_after' => 2,
			'created_at' => now(),
			'updated_at' => now(),
		]);
    }
}
