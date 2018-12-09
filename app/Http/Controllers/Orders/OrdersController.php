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
use App\ServiceRequest;
use App\Services;
use App\ServiceForm;

class OrdersController extends Controller
{
    public function orders()
    {
        $orders = Orders::where('user_id',Helper::getCurrentUserByKey('user_id'))->paginate(50);
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

        $ticket = $order->ticket;
        if (!$serviceRequest = ServiceRequest::where('ticket', $ticket)->get()->first()) {
            $view = 'Pages.404';
            return view('Includes.commonTemplate',compact('view'));
        }
        
        $serviceForm = ServiceForm::where('service_id', $serviceRequest->service_id)->get()->first();
        $serviceForm->form_fields = Helper::maybe_unserialize($serviceForm->form_fields);

        $serviceRequest->company_details = Helper::maybe_unserialize($serviceRequest->company_details);

        return Helper::viewInvoice($order, '', $serviceRequest, $serviceForm);
    }
}
