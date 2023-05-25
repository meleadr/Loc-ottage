<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CottagesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('cottages')->insert([
            'name' => 'Chamille',
            'area' => 100,
            'bedrooms' => 2,
            'persons' => 4,
            'description' => 'Un superbe chalet familial',
            'price' => 200,
			'created_at' => now(),
            'updated_at' => now(),
        ]);

		DB::table('cottages')->insert([
			'name' => 'Love',
			'area' => 50,
			'bedrooms' => 1,
			'persons' => 2,
			'description' => 'Un chalet pour les amoureux',
			'price' => 100,
			'created_at' => now(),
            'updated_at' => now(),
		]);

		DB::table('cottages')->insert([
			'name' => 'Family XL',
			'area' => 150,
			'bedrooms' => 3,
			'persons' => 6,
			'description' => 'Un chalet pour les familles nombreuses',
			'price' => 300,
			'created_at' => now(),
            'updated_at' => now(),
		]);
    }
}
