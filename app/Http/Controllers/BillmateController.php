<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ttrig\Billmate\Order;

class BillmateController extends Controller
{
    public function accept()
    {
        return view('payment.success');
    }

    public function cancel(Request $request)
    {
        $order = new Order($request->data);

        if ($order->cancelled()) {
            return view('payment.cancelled');
        }

        return view('payment.failed');
    }
}
