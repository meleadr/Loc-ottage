<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'test@test.com',
            'password' => Hash::make('test'),
            'remember_token' => Str::random(10),
			'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
