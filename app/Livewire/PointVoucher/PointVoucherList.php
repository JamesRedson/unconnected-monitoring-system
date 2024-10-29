<?php

namespace App\Livewire\PointVoucher;

use App\Models\PointVoucher\PointVoucher;
use Livewire\Component;
use Livewire\WithPagination;

class PointVoucherList extends Component
{
    use WithPagination;
    public $search;
    protected $listeners = [
        'refresh-parent' => '$refresh'
    ];
    public function render()
    {
        $pointVouchers = PointVoucher::where('name', 'like', '%' . $this->search . '%')
        ->with('site')
        ->paginate(5);
        $totalPointVouchers = PointVoucher::count();
        return view('livewire.point-voucher.point-voucher-list', compact( 'pointVouchers', 'totalPointVouchers'));
    }
}
