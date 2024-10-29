<?php

namespace App\Livewire\Dashboard\Chart;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\SalesReport\SalesReport;
use App\Models\Site\Site;
use Log;

class SalesperSite extends Component
{
    public $labels = [];
    public $data = [];
    public $title = null;
    public $siteNames = [];
    public $selectedSite = "All Sites";
    public $selectedDate;

    public function mount()
    {
        $sites = Site::pluck('name')->toArray();
        $this->siteNames = array_merge($this->siteNames, $sites);
        
        // Initialize with current date in YYYY-MM format
        $now = Carbon::now();
        $this->selectedDate = $now->format('Y-m');
        
        $this->loadSalesData();
    }

    public function updatedSelectedSite()
    {
        $this->loadSalesData();
        $this->dispatch('update-chart');
    }

    public function updatedSelectedDate($value)
    {
        try {
            // Validate the date format
            if ($value) {
                // Append day to make a complete date for Carbon
                $dateString = $value . '-01';
                $date = Carbon::createFromFormat('Y-m-d', $dateString);
                
                if (!$date) {
                    // If date creation fails, reset to current month
                    $this->selectedDate = Carbon::now()->format('Y-m');
                }
            } else {
                // If value is empty, reset to current month
                $this->selectedDate = Carbon::now()->format('Y-m');
            }
            
            $this->loadSalesData();
            $this->dispatch('update-chart');
        } catch (\Exception $e) {
            // Reset to current month if there's an error
            $this->selectedDate = Carbon::now()->format('Y-m');
            $this->loadSalesData();
            $this->dispatch('update-chart');
        }
    }

    private function loadSalesData()
    {
        try {
            // Ensure we have a valid date by appending the day
            $dateString = $this->selectedDate . '-01';
            $selectedDate = Carbon::createFromFormat('Y-m-d', $dateString);
            
            if (!$selectedDate) {
                $selectedDate = Carbon::now();
            }

            $daysInMonth = $selectedDate->daysInMonth;

            $this->title = 'Sales - ' . $selectedDate->format('F, Y');
            $this->labels = range(1, $daysInMonth);

            // Clear previous data
            $this->data = [];

            // Base query with proper joins and conditions
            $baseQuery = SalesReport::selectRaw('DAY(reported_at) as day, SUM(total_amount) as total_amount, sites.name')
                ->join('point_vouchers', 'sales_reports.point_voucher_id', '=', 'point_vouchers.id')
                ->join('sites', 'point_vouchers.site_id', '=', 'sites.id')
                ->whereYear('reported_at', $selectedDate->year)
                ->whereMonth('reported_at', $selectedDate->month)
                ->groupBy('day', 'sites.name')
                ->orderBy('day');

            if ($this->selectedSite !== 'All Sites') {
                // Single site query
                $sales = $baseQuery->where('sites.name', $this->selectedSite)->get();
                
                // Initialize array with zeros
                $this->data[$this->selectedSite] = array_fill(0, $daysInMonth, 0);
                
                // Fill in actual values
                foreach ($sales as $sale) {
                    $dayIndex = $sale->day - 1; // Convert to 0-based index
                    $this->data[$this->selectedSite][$dayIndex] = round((float)$sale->total_amount, 2);
                }
            } else {
                // All sites query
                $sales = $baseQuery->get();
                
                // Get all site names to ensure we create arrays for all sites
                $siteNames = Site::pluck('name')->toArray();
                
                // Initialize arrays for all sites with zeros
                foreach ($siteNames as $siteName) {
                    $this->data[$siteName] = array_fill(0, $daysInMonth, 0);
                }
                
                // Fill in actual values
                foreach ($sales as $sale) {
                    $dayIndex = $sale->day - 1; // Convert to 0-based index
                    if (!isset($this->data[$sale->name])) {
                        $this->data[$sale->name] = array_fill(0, $daysInMonth, 0);
                    }
                    $this->data[$sale->name][$dayIndex] = round((float)$sale->total_amount, 2);
                }
            }
        } catch (\Exception $e) {
            // Initialize empty data if there's an error
            $this->data = [];
            $this->labels = range(1, Carbon::now()->daysInMonth);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.chart.salesper-site');
    }
}