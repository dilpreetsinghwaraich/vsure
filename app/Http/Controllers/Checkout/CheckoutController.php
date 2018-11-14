<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Packages;
use App\User;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class CheckoutController extends Controller
{
    public function checkout($package_id = null)
    {
    	if (empty($package_id)) {
	    	$view = 'Pages.404';
        	return view('Includes.commonTemplate',compact('view'));
    	}
    	$package = Packages::find($package_id);

    	if (empty($package)) {
	    	$view = 'Pages.404';
        	return view('Includes.commonTemplate',compact('view'));
    	}
        $data = [];
    	$data['title'] = 'Checkout';
        $data['view'] = 'Checkout.Checkout';
        $data['package'] = $package;
        $data['profile'] = Helper::getCurrentUser(); 
        $data['states'] = DB::table('state_city')->select('state')->groupBy('state')->orderBy('state','asc')->get()->toArray();
        return view('Includes.commonTemplate',$data);
    }
    public function rules()
    {
        return array(
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
        );
    }
    public function completeOrder(Request $request, $package_id = null)
    {
        if (empty($package_id)) {
            $view = 'Pages.404';
            return view('Includes.commonTemplate',compact('view'));
        }
        $package = Packages::find($package_id);

        if (empty($package)) {
            $view = 'Pages.404';
            return view('Includes.commonTemplate',compact('view'));
        }
        $validator = Validator::make(Input::all(), self::rules());
        if(!$validator->passes()){
            Session::flash('warning',$validator->getMessageBag()->first());
            return Redirect::back()->withInput(Input::all());
        }
        $orderInsert = [];

        $orderInsert['user_id'] = Helper::getCurrentUserByKey('user_id');
        $orderInsert['invoice_id'] = 0;
        $orderInsert['package_id'] = $package_id;
        $orderInsert['package_title'] = $package->package_title;
        $orderInsert['quantity'] = 1;
        $orderInsert['order_status'] = 'pending';
        $orderInsert['order_date'] = date('Y-m-d');
        $orderInsert['billing_address'] = json_encode($request->all());
        $orderInsert['shipping_address'] = json_encode($request->all());
        $orderInsert['customer_name'] = $request->input('name');
        $orderInsert['email'] = $request->input('email');
        $orderInsert['phone'] = $request->input('phone');
        $orderInsert['purchase_details'] = json_encode($request->all());
        $orderInsert['product_package'] = json_encode([]);
        $orderInsert['products_details'] = json_encode($package);
        $orderInsert['amount_status'] = 'pending';
        $orderInsert['order_sub_total'] = Helper::displayPriceOnly($package);
        $orderInsert['order_tax'] = 0;
        $orderInsert['order_shipping'] = 0;
        $orderInsert['coupon_code'] = '';
        $orderInsert['coupon_value'] = 0;
        $orderInsert['coupon_status'] = '';
        $orderInsert['discount'] = 0;
        $orderInsert['grand_total'] = Helper::displayPriceOnly($package);
        $orderInsert['payment_id'] = '';
        $orderInsert['payment_method'] = 'razorpay';
        $orderInsert['created_at'] = new DateTime;
        $orderInsert['updated_at'] = new DateTime;

        $order_id = DB::table('product_order')->insertGetId($orderInsert);
        $order_number = time().$order_id;
        DB::table('product_order')->where('order_id', $order_id)->update(['invoice_id'=>$order_number]);
        Session::flash('success','Order submitted successfully');
        return redirect('thank-you');
    }
}
