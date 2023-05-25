<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('status')->insert([
            'name' => 'En attente',
			'created_at' => now(),
            'updated_at' => now(),
        ]);

		DB::table('status')->insert([
			'name' => 'Confirmé',
			'created_at' => now(),
            'updated_at' => now(),
		]);

		DB::table('status')->insert([
			'name' => 'Annulé',
			'created_at' => now(),
            'updated_at' => now(),
		]);

		DB::table('status')->insert([
			'name' => 'Payé',
			'created_at' => now(),
            'updated_at' => now(),
		]);
    }
}
