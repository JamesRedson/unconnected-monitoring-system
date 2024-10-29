<?php

namespace App\Http\Controllers\Web\PointVoucher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PointVoucherList extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view("point-vouchers.index");
    }
}
