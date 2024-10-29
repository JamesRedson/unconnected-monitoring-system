<?php

namespace App\Livewire\PointVoucher;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

use App\Models\PointVoucher\PointVoucher;
use App\Models\Site\Site;

class Modal extends Component
{
    public $selectedPointVoucher = '';

    #[Validate('required|string')]
    public $site_id;
    
    #[Validate('required|string|unique:point_vouchers,name')]
    public $name;

    #[Validate('required|string|unique:point_vouchers,latitude')]
    public $latitude;

    #[Validate('required|string|unique:point_vouchers,longitude')]
    public $longitude;

    #[On('add-point-voucher')]
    public function openAddModal(): void
    {
        $this->resetForm();
        $this->dispatch('open-modal', 'create-point-voucher');
    }

    #[On('edit-point-voucher')]
    public function openEditModal(PointVoucher $pointVoucher): void
    {
        $this->selectedPointVoucher = $pointVoucher;
        $this->site_id = $pointVoucher->site_id;
        $this->name = $pointVoucher->name;
        $this->latitude = $pointVoucher->latitude;
        $this->longitude = $pointVoucher->longitude;
        $this->resetErrorBag();
        $this->dispatch('open-modal', 'edit-point-voucher');
    }
    
    #[On('delete-point-voucher')]
    public function openDeleteModal(PointVoucher $pointVoucher): void
    {
        $this->selectedPointVoucher = $pointVoucher;
        $this->dispatch('open-modal', 'delete-point-voucher');
    }

    public function store(): void
    {
        $validatedData = $this->validate();
        PointVoucher::create($validatedData);
        
        $this->dispatch('alert', type: 'success', message: 'Point Voucher Information has been successfully added.', title: 'Point Voucher Created');
        $this->dispatch('close-modal', 'create-point-voucher');
        $this->dispatch('refresh-parent');  
    }

    public function update(): void
    {
        $validatedData = $this->validate([
        'name' => 'required|string|unique:point_vouchers,name,' . $this->selectedPointVoucher->id,
        'latitude' => 'required|string|unique:point_vouchers,latitude,' . $this->selectedPointVoucher->id,
        'longitude' => 'required|string|unique:point_vouchers,longitude,' . $this->selectedPointVoucher->id
        ]);
        $this->selectedPointVoucher->update($validatedData);

        $this->dispatch('alert', type: 'success', message: 'Point Voucher Information has been successfully updated.', title: 'Point Voucher Updated');
        $this->dispatch('close-modal', 'edit-point-voucher');
        $this->dispatch('refresh-parent');
    }

    public function destroy()
    {
        if ($this->selectedPointVoucher->salesReports()->exists()) 
        {
            return $this->dispatch('alert', type: 'error', message: 'Point Voucher Deletion Failed. Data currently in use.', title: 'Point Voucher Deleted');
        };
        
        $this->selectedPointVoucher->delete();

        $this->dispatch('alert', type: 'success', message: 'Point Voucher Information has been successfully deleted.', title: 'Point Voucher Deleted');
        $this->dispatch('close-modal', 'delete-point-voucher');
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

    public function render(): View
    {
        $sites = Site::all();
        return view('livewire.point-voucher.modal', compact('sites'));
    }
}
