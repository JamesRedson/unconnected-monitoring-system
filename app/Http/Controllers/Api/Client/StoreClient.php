<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreClientRequest;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Client\Client;
use Illuminate\Http\Request;

class StoreClient extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(Request $request)
	{
		
		Client::create($request->all());

		return response()->json([
			'success' => true
		], Response::HTTP_OK);
	}
}
