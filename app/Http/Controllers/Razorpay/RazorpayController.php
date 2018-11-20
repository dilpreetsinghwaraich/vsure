<?php
namespace App\Http\Controllers\Razorpay;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Razorpay\Api\Api;
use Session;
use Redirect;

class RazorpayController extends Controller
{    
    public function payWithRazorpay()
    {        
        return view('payWithRazorpay');
    }

    public function payment()
    {
        //Input items of form
        $input = Input::all();
        echo '<pre>';
        print_r($input);
        echo '</pre>';
        //get API Configuration 
        $api = new Api(config('razorpay.razor_key'), config('razorpay.razor_secret'));
        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 

            } catch (\Exception $e) {
                return  $e->getMessage();
                \Session::put('error',$e->getMessage());
                //return redirect()->back();
            }

            // Do something here for store payment details in database...
        }
        echo '<pre>';
        print_r($response);
        die;
        \Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
        return redirect()->back();
    }
}