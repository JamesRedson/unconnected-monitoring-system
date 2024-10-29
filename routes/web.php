<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\Client\ClientList;
use App\Http\Controllers\Web\PointVoucher\PointVoucherList;
use App\Http\Controllers\Web\SalesReport\SalesReportList;
use App\Http\Controllers\Web\Site\SiteList;
use Illuminate\Support\Facades\Route;

use App\Models\Client\Client;
use App\Models\Site\Site;
use App\Models\PointVoucher\PointVoucher;
use App\Models\SalesReport\SalesReport;

Route::redirect('/', '/login')->name('root');

Route::middleware(['auth', 'verified'])->group(function () {

	Route::get('/dashboard', function () {
			$clientCount = Client::count();
			$salesCount = SalesReport::pluck('total_amount')->sum();
			$siteCount = Site::count();
			$pointVoucherCount = PointVoucher::count();
			return view('dashboard', compact('clientCount', 'salesCount', 'siteCount', 'pointVoucherCount'));
	})->name('dashboard');

	Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

	Route::prefix('clients')->name('clients.')->group( function() {
		Route::get('/', ClientList::class)->name('index');
	});

	Route::prefix('sites')->name('sites.')->group( function() {
		Route::get('/', SiteList::class)->name('index');
	});

	Route::prefix('point-vouchers')->name('point-vouchers.')->group( function() {
		Route::get('/', PointVoucherList::class)->name('index');
	});

	Route::prefix('sales-reports')->name('sales-reports.')->group( function() {
		Route::get('/', SalesReportList::class)->name('index');
	});

});

require __DIR__ . '/auth.php';
