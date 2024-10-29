<?php

namespace App\Livewire\SalesReport;

use Livewire\Component;

use App\Models\SalesReport\SalesReport;
use Livewire\WithPagination;
class SalesReportList extends Component
{
    use WithPagination;
    public $search;
    protected $listeners = [
        'refresh-parent' => '$refresh'
    ];
    public function render()
    {
        $totalSales = SalesReport::count();
        $salesReports = SalesReport::with('pointVoucher')
            ->whereHas('pointVoucher', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate(5);
        return view('livewire.sales-report.sales-report-list', compact('totalSales', 'salesReports'));
    }
}
