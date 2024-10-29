<?php

namespace App\Livewire\Dashboard\Chart;

use Livewire\Component;

use Carbon\Carbon;

use App\Models\Client\Client;

class ConnectedUsersBySex extends Component
{
	public $labels = [];
	public $data = [];
	public $title = null;

	public function render()
	{
		return view('livewire.dashboard.chart.connected-users-by-sex');
	}

	public function mount()
	{
		$currentDate = Carbon::now();
		$currentMonth = $currentDate->month;
		$currentYear = $currentDate->year;
		$daysInMonth = $currentDate->daysInMonth;

		// Initialize labels and data arrays
		$this->title = 'Users - ' . $currentDate->format('F, Y');
		$this->labels = range(1, $daysInMonth);
		$this->data = [
			'Male' => array_fill(0, $daysInMonth, 0),
			'Female' => array_fill(0, $daysInMonth, 0),
		];

		// Fetch client data for the current month, grouped by day and sex
		$clients = Client::selectRaw('DAY(created_at) as day, sex, COUNT(*) as count')
			->whereYear('created_at', $currentYear)
			->whereMonth('created_at', $currentMonth)
			->groupBy('day', 'sex')
			->orderBy('day')
			->get();

		// Count male and female clients for each day and map to $data array
		foreach ($clients as $client) {
			$dayIndex = $client->day - 1; // Convert day to array index (0-based)
			$this->data[$client->sex][$dayIndex] = $client->count;
		}

	}

}
