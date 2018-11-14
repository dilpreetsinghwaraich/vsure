<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\User;
use App\Packages;
use App\Orders;
use App\Terms;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
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
}
