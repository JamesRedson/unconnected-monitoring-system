<?php

use App\Http\Controllers\Api\Client\StoreClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/client', StoreClient::class)->name('clients.store');