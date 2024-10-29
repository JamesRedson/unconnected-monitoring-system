<?php

namespace App\Livewire\Dashboard\Chart;

use App\Models\Site\Site;
use Livewire\Component;

use Carbon\Carbon;

use App\Models\Client\Client;

class ConnectedUsersBySite extends Component
{

	public $labels = [];
	public $data = [];
	public $siteNames = [];
	public $title = null;

	public function render()
	{
		return view('livewire.dashboard.chart.connected-users-by-site');
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

		// Fetch client data for the current month, grouped by site_name and day
		$clients = Client::selectRaw('DAY(created_at) as day, site_name, COUNT(*) as count')
				->whereYear('created_at', $currentYear)
				->whereMonth('created_at', $currentMonth)
				->groupBy('day', 'site_name')
				->orderBy('day')
				->get();

		// Initialize data structure
		$this->data = [];

		// Organize data by site_name
		foreach ($clients as $client) {
			$dayIndex = $client->day - 1; // Convert day to array index (0-based)

			if (!isset($this->data[$client->site_name])) {
				$this->data[$client->site_name] = array_fill(0, $daysInMonth, 0);
			}

			$this->data[$client->site_name][$dayIndex] = $client->count;
		}

		// Get all distinct site names for the labels
		$this->siteNames = array_keys($this->data);

	}
}
