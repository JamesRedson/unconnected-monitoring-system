<?php

namespace Database\Factories\Client;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client\Client>
 */
class ClientFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'first_name' => fake()->name(),
			'last_name' => fake()->name(),
			'sex' => fake()->randomElement(['Male', 'Female']),
			'age' => fake()->randomDigit(),
			'voucher' => fake()->randomDigit(),
			'mac_address' => fake()->macAddress(),
			'site_name' => 'Gilutongan',
			'created_at' => $this->getRandomDateForCurrentMonth()
		];
	}

	protected function getRandomDateForCurrentMonth()
	{
		$start = Carbon::now()->startOfMonth();
		$end = Carbon::now()->endOfMonth();
		return fake()->dateTimeBetween($start, $end);
	}
}
