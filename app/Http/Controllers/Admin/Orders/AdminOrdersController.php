<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\User;
use App\Packages;
use App\Orders;
use App\Terms;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper, PDF;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class AdminOrdersController extends Controller
{
    public function index()
    {
        $view = 'Admin.Orders.Index';
        $orders = Orders::paginate(50);    
        return view('Includes.adminCommonTemplate',compact('view','orders'));
    }
    
    public function edit($order_id = null)
    {
    	$view = 'Admin.Orders.Edit';
        $order = Orders::find($order_id);
       
    	if (empty($order->order_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Order.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}
        $package = Packages::find($order->package_id);
        return view('Includes.adminCommonTemplate',compact('view','order','package'));	
    }
    public function update(Request $request, $order_id = null)
    {
    	$order = Orders::find($order_id);
    	if (empty($order->order_id)) {
			Session::flash('error','Something went wrong, You are not authorized to update this Order.');
	    	return Redirect::back()->withInput(Input::all());    		
    	}                                                                                                                                                                                                                      
	    $order->order_status = $request->input('order_status');
	    $order->updated_at = date('Y-m-d h:i:s');
	    $order->save();
        Session::flash('success','Order Updated Successfully');
	    return redirect('admin/orders');
    }
    public function delete($order_id = null)
    {
        $order = Orders::find($order_id);
        if (empty($order->order_id)) {
            Session::flash('error','Something went wrong, You are not authorized to update this Order.');
            return Redirect::back()->withInput(Input::all());           
        }      
        $order->delete();
        Session::flash('success','Order Deleted Successfully');
        return redirect('admin/orders');
    }
    public function pdf($order_id = null)
    {
        $order = Orders::find($order_id);
       
        if (empty($order->order_id)) {
            Session::flash('error','Something went wrong, You are not authorized to update this Order.');
            return Redirect::back()->withInput(Input::all());           
        }
        $type = 'admin';
        $command = 'pdf';
        $pdf = PDF::loadView('Template.createInvoice', compact('order','type','command'));
        return $pdf->download('invoice.pdf');
    }
    public function print($order_id = null)
    {
        $order = Orders::find($order_id);
       
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
    public function sendOrderInvoiceMail($order_id = null)
    {
        $order = Orders::find($order_id);
        if (empty($order->order_id)) {
            Session::flash('error','Something went wrong, You are not authorized to update this Order.');
            return Redirect::back()->withInput(Input::all());           
        } 
        
        $htmlmessage = view('EmailTemplate.OrderInvoice', compact('order'));
        echo $htmlmessage;
        die;
        $email = $order->email;
        $user = Helper::getUser($order->user_id);
        if (!empty($user)) {
            Helper::SendEmail($user->email,'Order Invoice At Vsure CFO',$htmlmessage,'');    
        }
        if (empty($user) || $user->email != $email) {
            Helper::SendEmail($email,'Order Invoice At Vsure CFO',$htmlmessage,'');        
        }        
        Session::flash('success','Mail Sent Successfully TO '. $order->customer_name);
        return Redirect::back()->withInput(Input::all());
    }
}
