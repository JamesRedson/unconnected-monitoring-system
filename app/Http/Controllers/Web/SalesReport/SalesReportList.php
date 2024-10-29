<?php

namespace App\Http\Controllers\Web\SalesReport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesReportList extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view("sales-reports.index");
    }
}
