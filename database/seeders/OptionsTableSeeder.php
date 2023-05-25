<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('options')->insert([
            'name' => 'Petit déjeuner',
			'created_at' => now(),
            'updated_at' => now(),
        ]);

		DB::table('options')->insert([
			'name' => 'Diner',
			'created_at' => now(),
            'updated_at' => now(),
		]);

		DB::table('options')->insert([
			'name' => 'Spa',
			'created_at' => now(),
            'updated_at' => now(),
		]);

		DB::table('options')->insert([
			'name' => 'All-in',
			'created_at' => now(),
            'updated_at' => now(),
		]);
    }
}
