<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Helper;

class OrdersController extends Controller
{
    public function orders()
    {
        echo view('Orders.Orders');
        die;
    }
    public function orderView()
    {
    	echo view('Orders.OrderView');
        die;
    }
}
