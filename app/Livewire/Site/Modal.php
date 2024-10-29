<?php

namespace App\Livewire\Site;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

use App\Models\Site\Site;

class Modal extends Component
{
    public $selectedSite = '';

    #[Validate('required|string|unique:sites,name')]
    public $name;
    #[On('add-site')]
    public function openAddModal(): void
    {
        $this->resetForm();
        $this->dispatch('open-modal', 'create-site');
    }
    
    #[On('edit-site')]
    public function openEditModal(Site $site): void
    {
        $this->selectedSite = $site;
        $this->name = $site->name;
        $this->resetErrorBag();
        $this->dispatch('open-modal', 'edit-site');
    }
    #[On('delete-site')]
    public function openDeleteModal(Site $site): void
    {
        $this->selectedSite = $site;

        $this->dispatch('open-modal', 'delete-site');
    }

    public function store(): void
    {
        $validatedData = $this->validate();
        Site::create($validatedData);
        
        $this->dispatch('alert', type: 'success', message: 'Site Information has been successfully added.', title: 'Site Created');
        $this->dispatch('close-modal', 'create-site');
        $this->dispatch('refresh-parent');  
    }

    public function update(): void
    {
        $validatedData = $this->validate(['name' => 'required|string|unique:sites,name,' . $this->selectedSite->id,]);
        $this->selectedSite->update($validatedData);

        $this->dispatch('alert', type: 'success', message: 'Site Information has been successfully updated.', title: 'Site Updated');
        $this->dispatch('close-modal', 'edit-site');
        $this->dispatch('refresh-parent');
        
    }

     public function destroy()
    {
        if ($this->selectedSite->pointVouchers()->exists()) 
        {
            return $this->dispatch('alert', type: 'error', message: 'Site Deletion Failed. Data currently in use.', title: 'Site Deleted');
        };  

        $this->selectedSite->delete();

        $this->dispatch('alert', type: 'success', message: 'Site Information has been successfully deleted.', title: 'Site Deleted');
        $this->dispatch('close-modal', 'delete-site');
        $this->dispatch('refresh-parent');
    }

     public function closeModal($modalName): void 
    {
        $this->dispatch('close-modal', $modalName);
    }

    private function resetForm(): void
    {
        $this->reset();
        $this->resetErrorBag();
    }

    public function render(): View
    {
        return view('livewire.site.modal');
    }
}
