<?php

namespace App\Livewire\Client;

use App\Models\Client\Client;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class ClientList extends Component
{
	use WithPagination;

	#[Url]
	public $search = null;

  protected $listeners = [
    'refresh-parent' => '$refresh'
  ];

	public function render()
	{
		$clients = Client::search($this->search)->paginate(5);

		return view('livewire.client.client-list', [
			'clients' => $clients
		]);
	}
}
