<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Packages;
use App\Orders;
use App\User;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class OrdersController extends Controller
{
    public function orders()
    {
        $orders = Orders::paginate(50);
        echo view('Orders.Orders', compact('orders'));
        die;
    }
    public function orderView($invoice_id = null)
    {        
        $order = Orders::where('invoice_id',$invoice_id)->first();
        echo Helper::createInvoice($order,'');
        die;
    }
}
