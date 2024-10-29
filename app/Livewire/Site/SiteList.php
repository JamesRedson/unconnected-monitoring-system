<?php

namespace App\Livewire\Site;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Site\Site;
class SiteList extends Component
{
    use WithPagination;
    public $search;
    protected $listeners = [
        'refresh-parent' => '$refresh'
    ];
    public function render()
    {
        $sites = Site::where('name', 'like', '%' . $this->search . '%')->paginate(5);
        $totalSites = Site::count();
        return view('livewire.site.site-list', compact('sites', 'totalSites'));
    }
}
