<?php

namespace App\Livewire\Dashboard\Chart;

use Carbon\Carbon;
use Livewire\Component;

use App\Models\Client\Client;

class ConnectedUsersByAge extends Component
{

	public $labels = [];
	public $data = [];
	public $title = null;

	public function render()
	{
		return view('livewire.dashboard.chart.connected-users-by-age');
	}

	public function mount()
	{
		$currentDate = Carbon::now();
		$currentMonth = $currentDate->month;
		$currentYear = $currentDate->year;
		
		// Initialize title and data arrays
		$this->title = 'Users by Age Group - ' . $currentDate->format('F, Y');
		$this->data = [
			'0-11' => 0,
			'12-29' => 0,
			'30-44' => 0,
			'45-59' => 0,
			'60+' => 0,
		];
		
		// Fetch client data for the current month, grouped by age range
		$clients = Client::selectRaw('
			CASE
					WHEN age BETWEEN 0 AND 11 THEN "0-11"
					WHEN age BETWEEN 12 AND 29 THEN "12-29"
					WHEN age BETWEEN 30 AND 44 THEN "30-44"
					WHEN age BETWEEN 45 AND 59 THEN "45-59"
					ELSE "60+"
			END as age_range, COUNT(*) as count')
			->whereYear('created_at', $currentYear)
			->whereMonth('created_at', $currentMonth)
			->groupBy('age_range')
			->get();
	
		// Map total client counts to the respective age groups
		foreach ($clients as $client) {
			$this->data[$client->age_range] = $client->count;
		}

	}
}
