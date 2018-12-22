<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Packages;
use App\Orders;
use App\User;
use App\ServiceRequest;
use App\Services;
use App\ServiceForm;
use Illuminate\Http\Request;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Support\Facades\Input;

class CheckoutController extends Controller
{
    public function checkout(Request $request, $package_id = null)
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
        $ticket = $request->input('ticket');
        if (!$serviceRequest = ServiceRequest::where('ticket', $ticket)->get()->first()) {
           $view = 'Pages.404';
            return view('Includes.commonTemplate',compact('view'));
        }
        
        $serviceForm = ServiceForm::where('service_id', $serviceRequest->service_id)->get()->first();
        $serviceForm->form_fields = Helper::maybe_unserialize($serviceForm->form_fields);

        $serviceRequest->company_details = Helper::maybe_unserialize($serviceRequest->company_details);

        $data = [];
    	$data['title'] = 'Checkout';
        $data['view'] = 'Checkout.Checkout';
        $data['package'] = $package;
        $data['serviceRequest'] = $serviceRequest;
        $data['serviceForm'] = $serviceForm;
        $data['profile'] = Helper::getCurrentUser(); 
        $data['states'] = DB::table('state_city')->select('state')->groupBy('state')->orderBy('state','asc')->get()->toArray();
        return view('Includes.commonTemplate',$data);
    }
    public function servicePackages($ticket = null)
    {
        if (empty($ticket)) {
            $view = 'Pages.404';
            return view('Includes.commonTemplate',compact('view'));
        }
        if (!$serviceRequest = ServiceRequest::where('ticket', $ticket)->get()->first()) {
           $view = 'Pages.404';
            return view('Includes.commonTemplate',compact('view'));
        }
        
        $serviceForm = ServiceForm::where('service_id', $serviceRequest->service_id)->get()->first();
        $serviceForm->form_fields = Helper::maybe_unserialize($serviceForm->form_fields);

        $serviceRequest->company_details = Helper::maybe_unserialize($serviceRequest->company_details);

        $service = Services::where('status',1)->where('service_id', $serviceRequest->service_id)->get()->first();

        if (empty($service)) {
            $view = 'Pages.404';
            return view('Includes.commonTemplate',compact('view'));
        }
        $data = [];
        $data['service'] = $service;
        $data['serviceRequest'] = $serviceRequest;
        $data['serviceForm'] = $serviceForm;
        $data['service_package'] = \Helper::maybe_unserialize($service->service_packages);        
        $data['packages'] = Packages::whereIn('package_terms', (isset($data['service_package']['package_terms'])?$data['service_package']['package_terms']:[]))->get();
        $data['title'] = $service->service_title;
        $data['view'] = 'Service.ServicePackages';
        
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
        if ($order = DB::table('product_order')->where('ticket', $request->input('ticket'))->where('package_id', $package_id)->get()->first()) {
            Session::flash('success','Order already submitted');
            return redirect('checkout/invoice/'.$order->invoice_id);
        }
        $orderInsert['user_id'] = Helper::getCurrentUserByKey('user_id');
        $orderInsert['invoice_id'] = 0;
        $orderInsert['package_id'] = $package_id;
        $orderInsert['ticket'] = $request->input('ticket');
        $orderInsert['package_title'] = $package->package_title;
        $orderInsert['quantity'] = 1;
        $orderInsert['order_status'] = 'pending';
        $orderInsert['order_date'] = date('Y-m-d');
        $orderInsert['order_due_date'] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 10 days'));
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
        $orderInsert['payment_method'] = $request->input('payment_method');
        $orderInsert['created_at'] = new DateTime;
        $orderInsert['updated_at'] = new DateTime;

        $order_id = DB::table('product_order')->insertGetId($orderInsert);
        $invoice_id = time().$order_id;
        DB::table('product_order')->where('order_id', $order_id)->update(['invoice_id'=>$invoice_id]);
        Session::flash('success','Order submitted successfully');
        return redirect('checkout/invoice/'.$invoice_id);
    }
    public function checkoutInvoive($invoice_id = null){
        if (empty($invoice_id)) {
            $view = 'Pages.404';
            return view('Includes.commonTemplate',compact('view'));
        }
        $order = Orders::where('invoice_id',$invoice_id)->first();
        if (empty($order)) {
            $view = 'Pages.404';
            return view('Includes.commonTemplate',compact('view'));
        }
        $ticket = $order->ticket;
        if (!$serviceRequest = ServiceRequest::where('ticket', $ticket)->get()->first()) {
           $view = 'Pages.404';
            return view('Includes.commonTemplate',compact('view'));
        }
        
        $serviceForm = ServiceForm::where('service_id', $serviceRequest->service_id)->get()->first();
        $serviceForm->form_fields = Helper::maybe_unserialize($serviceForm->form_fields);

        $serviceRequest->company_details = Helper::maybe_unserialize($serviceRequest->company_details);

        $invoiceView = Helper::createInvoice($order,'');
        $view = 'Checkout.Invoice';
        return view('Includes.commonTemplate',compact('view','invoiceView','serviceRequest','serviceForm'));
    }
}
