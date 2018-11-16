<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Packages;
use App\Orders;
use App\User;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper, PDF;
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
    public function pdf($invoice_id = null)
    {
        $order = Orders::where('invoice_id',$invoice_id)->first();
       
        if (empty($order->order_id)) {
            Session::flash('error','Something went wrong, You are not authorized to update this Order.');
            return Redirect::back()->withInput(Input::all());           
        }
        $type = 'admin';
        $command = 'pdf';
        $pdf = PDF::loadView('Template.createInvoice', compact('order','type','command'));
        return $pdf->download('invoice.pdf');
    }
    public function print($invoice_id = null)
    {
        $order = Orders::where('invoice_id',$invoice_id)->first();
       
        if (empty($order->order_id)) {
            Session::flash('error','Something went wrong, You are not authorized to update this Order.');
            return Redirect::back()->withInput(Input::all());           
        }
        ?>
        <link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/css/animate.css">
        <link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/css/default-style.css">
        
        <?php
        $invoice = Helper::createInvoice($order, 'admin');
        echo $invoice;
        echo '<script>window.print()</script>';
        die;
    }
    public function invoice($invoice_id = null)
    {
        $order = Orders::where('invoice_id',$invoice_id)->first();
       
        if (empty($order->order_id)) {
            Session::flash('error','Something went wrong, You are not authorized to update this Order.');
            return Redirect::back()->withInput(Input::all());           
        }
        return Helper::viewInvoice($order, '');
    }
}
