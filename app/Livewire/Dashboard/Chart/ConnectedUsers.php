<?php

namespace App\Livewire\Dashboard\Chart;

use Carbon\Carbon;
use Livewire\Component;

use App\Models\Client\Client;

class ConnectedUsers extends Component
{
	public $labels = [];
	public $data = [];
	public $title = null;

	public function render()
	{
		return view('livewire.dashboard.chart.connected-users');
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
		$this->data = array_fill(0, $daysInMonth, 0);

		// Fetch client data for the current month
		$clients = Client::selectRaw('DATE(created_at) as date, COUNT(*) as count')
			->whereYear('created_at', $currentYear)
			->whereMonth('created_at', $currentMonth)
			->groupBy('date')
			->orderBy('date', 'asc')
			->get();

		// Map the client counts to the respective days
		foreach ($clients as $client) {
			$day = Carbon::parse($client->date)->day;
			$this->data[$day - 1] = $client->count;
		}
	}

}
