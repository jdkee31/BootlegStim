<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamePricingSeeder extends Seeder
{
	public function run()
	{
		$gamesByTitle = DB::table('games')->pluck('id', 'title');

		if ($gamesByTitle->isEmpty()) {
			return;
		}

		$pricingTemplates = [
			'The Witcher 3: Wild Hunt' => [
				'price' => 39.99,
				'discount_percentage' => 25,
				'discounted_price' => 29.99,
				'currency' => 'USD',
			],
			'Cyberpunk 2077' => [
				'price' => 59.99,
				'discount_percentage' => null,
				'discounted_price' => null,
				'currency' => 'USD',
			],
			'Hades' => [
				'price' => 24.99,
				'discount_percentage' => 15,
				'discounted_price' => 21.24,
				'currency' => 'USD',
			],
		];

		$rows = [];

		foreach ($pricingTemplates as $gameTitle => $pricing) {
			$gameId = $gamesByTitle->get($gameTitle);

			if (! $gameId) {
				continue;
			}

			DB::table('game__pricings')->updateOrInsert(
				['game_id' => $gameId],
				[
					'price' => $pricing['price'],
					'discount_percentage' => $pricing['discount_percentage'],
					'discounted_price' => $pricing['discounted_price'],
					'currency' => $pricing['currency'],
				]
			);
		}
	}
}
