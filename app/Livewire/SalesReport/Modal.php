<?php

namespace App\Livewire\SalesReport;

use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

use App\Models\Site\Site;
use App\Models\PointVoucher\PointVoucher;
use App\Models\SalesReport\SalesReport;
class Modal extends Component
{
    public $selectedSalesReport;
    public $site_id;

    #[Validate('required|string')]
    public $point_voucher_id;

    #[Validate('required|numeric')]
    public $voucher_price;

    #[Validate('required|numeric')]
    public $total_voucher_sales;

    #[Validate('required|numeric')]
    public $total_amount;

    #[Validate('required|string')]
    public $reported_at;

    #[On('add-sales-report')]
    public function openAddModal(): void
    {
        $this->resetForm();
        $this->dispatch('open-modal', 'create-sales-report');
    }

    #[On('edit-sales-report')]
    public function openEditModal(SalesReport $salesReport): void
    {
        $this->selectedSalesReport = $salesReport;

        $this->site_id = $salesReport->pointVoucher->site_id;
        $this->point_voucher_id = $salesReport->point_voucher_id;
        $this->total_voucher_sales = $salesReport->total_voucher_sales;
        $this->total_amount = $salesReport->total_amount;
        $this->reported_at = $salesReport->reported_at;

        $this->resetErrorBag();
        $this->dispatch('open-modal', 'edit-sales-report');
    }

    #[On('delete-sales-report')]
    public function openDeleteModal(SalesReport $salesReport): void
    {
        $this->selectedSalesReport = $salesReport;
        $this->dispatch('open-modal', 'delete-sales-report');
    }

    public function mount(): void
    {
        $this->total_amount = 0;
    }

    public function store(): void
    {

        $validatedData = $this->validate();
        SalesReport::create($validatedData);

        $this->dispatch('alert', type: 'success', message: 'Sales Report Information has been successfully added.', title: 'Sales Report Created');
        $this->dispatch('close-modal', 'create-sales-report');
        $this->dispatch('refresh-parent');  

    }

    public function update(): void
    {
        $validatedData = $this->validate();
        $this->selectedSalesReport->update($validatedData);

        $this->dispatch('alert', type: 'success', message: 'Sales Report Information has been successfully updated.', title: 'Sales Report Updated');
        $this->dispatch('close-modal', 'edit-sales-report');
        $this->dispatch('refresh-parent');
        
    }

    public function destroy(): void
    {
        $this->selectedSalesReport->delete();

        $this->dispatch('alert', type: 'success', message: 'Sales Report Information has been successfully deleted.', title: 'Sales Report Deleted');
        $this->dispatch('close-modal', 'delete-sales-report');
        $this->dispatch('refresh-parent');
    }

    public function closeModal($modalName): void 
    {
        $this->dispatch('close-modal', $modalName);
    }

    private function resetForm(): void
    {
        $this->resetErrorBag();
        $this->reset();
    }

    public function render()
    {
        $sites = Site::all();
        $pointVouchers = $this->getFilteredPointVouchers();

        return view('livewire.sales-report.modal', compact('sites', 'pointVouchers'));
    }
    public function getFilteredPointVouchers()
    {
        if ($this->site_id) {
            return PointVoucher::where('site_id', $this->site_id)->get();
        }
        return collect();
    }

     public function updatedVoucherPrice(): void
    {
        $this->calculateTotalAmount();
    }

    public function updatedTotalVoucherSales(): void
    {
        $this->calculateTotalAmount();
    }

    public function updateTotalAmount($value): void
    {
        if (in_array($value, ['voucher_price', 'total_voucher_sales'])) {
            $this->calculateTotalAmount();
        }
    }

    private function calculateTotalAmount(): void
    {
        if ($this->voucher_price && $this->total_voucher_sales) {
            $this->total_amount = floatval($this->voucher_price) * floatval($this->total_voucher_sales);
        } else {
            $this->total_amount = 0;
        }
    }
}
