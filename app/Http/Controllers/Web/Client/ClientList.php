<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\Client\Client;

class ClientList extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(Request $request): View
	{
		$totalClients = Client::count();
		return view('client.index', compact('totalClients'));
	}
}
