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
			'description' => "Ce chalet familial est un havre de paix au cœur d'un paysage pittoresque. Avec son architecture traditionnelle en bois, son intérieur chaleureux et ses vues magnifiques, il offre un refuge parfait pour des moments de détente et de partage en famille. Doté d'un salon spacieux avec cheminée, d'une cuisine entièrement équipée, de chambres confortables et d'une terrasse extérieure avec jacuzzi, ce chalet est l'endroit idéal pour des vacances inoubliables au milieu de la nature.",
			'price' => 200,
			'image_url' => '/assets/images/cottage/classic_cottage.jpg',
			'created_at' => now(),
			'updated_at' => now(),
		]);

		DB::table('cottages')->insert([
			'name' => 'Love',
			'area' => 50,
			'bedrooms' => 1,
			'persons' => 2,
			'description' => "Niché dans un cadre romantique, ce charmant chalet en amoureux offre l'intimité parfaite pour une escapade romantique. Lové au milieu d'un paysage enchanteur, ce chalet vous invite à vous détendre et à vous reconnecter avec votre partenaire. Le chalet, doté d'un design pittoresque en bois, crée une atmosphère chaleureuse et intime. À l'intérieur, vous trouverez un espace confortable et cosy, conçu pour créer une ambiance romantique.",
			'price' => 100,
			'image_url' => '/assets/images/cottage/love_cottage.jpeg',
			'created_at' => now(),
			'updated_at' => now(),
		]);

		DB::table('cottages')->insert([
			'name' => 'Family XL',
			'area' => 150,
			'bedrooms' => 3,
			'persons' => 6,
			'description' => "Ce spacieux chalet familial XL est l'endroit idéal pour des vacances mémorables en famille. Niché au cœur d'un paysage pittoresque, ce chalet offre amplement d'espace pour accueillir toute la famille et créer des souvenirs inoubliables. Le chalet, avec son architecture en bois traditionnelle, dégage une atmosphère chaleureuse et conviviale. À l'intérieur, vous découvrirez de vastes espaces de vie conçus pour offrir confort et détente à tous les membres de la famille.",
			'price' => 300,
			'image_url' => '/assets/images/cottage/familial_cottage.jpeg',
			'created_at' => now(),
			'updated_at' => now(),
		]);
	}
}
