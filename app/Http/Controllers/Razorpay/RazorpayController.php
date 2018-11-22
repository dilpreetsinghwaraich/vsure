<?php
namespace App\Http\Controllers\Razorpay;

use App\Http\Controllers\Controller;
use App\User;
use App\Packages;
use App\Orders;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{    
    public function payWithRazorpay()
    {        
        return view('payWithRazorpay');
    }

    public function payment($invoice_id = null)
    {
        $input = Input::all();
        $api = new Api(config('razorpay.razor_key'), config('razorpay.razor_secret'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                Orders::where('invoice_id',$invoice_id)
                        ->update([
                            'amount_status' => 'completed',
                            'payment_id' => $input['razorpay_payment_id'],
                            'payment_method' => 'razorpay',
                            'updated_at' =>  new DateTime,
                        ]);
            } catch (\Exception $e) {
                \Session::put('warning',$e->getMessage());
                return redirect()->back();
            }
        }
        \Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
        return redirect()->back();
    }
}