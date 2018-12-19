<?php
namespace App\Http\Controllers\Paypal;

use App\Http\Controllers\Controller;
use App\User;
use App\Packages;
use App\Orders;
use Validator, DateTime, DB, Hash, File, Config, Helpers, Helper;
use Session, Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\PayPal;

class PayPalController extends Controller
{
    public function postPaymentWithPaypal($invoice_id = '')
    {
        $order = Orders::where('invoice_id',$invoice_id)->get()->first();
        if (empty($order->invoice_id)) {
            Session::put('warning','Some error occur, sorry for inconvenient');
            return Redirect('order/view/'.$invoice_id);
        }

        $paypal = new PayPal;

        $response = $paypal->purchase([
            'amount' => $paypal->formatAmount(2),
            'transactionId' => $invoice_id,
            'currency' => 'USD',
            'cancelUrl' => $paypal->getCancelUrl($invoice_id),
            'returnUrl' => $paypal->getReturnUrl($invoice_id),
        ]);

        if ($response->isRedirect()) {
            return $response->redirect();
        }

        Session::put('warning',$response->getMessage());
        return Redirect('order/view/'.$invoice_id);
    }


    public function completed($invoice_id, Request $request)
    {
        
        $order = Orders::where('invoice_id',$invoice_id)->get()->first();
        if (empty($order->invoice_id)) {
            Session::put('warning','Some error occur, sorry for inconvenient');
            return Redirect('order/view/'.$invoice_id);
        }

        $paypal = new PayPal;

        $response = $paypal->complete([
            'amount' => $paypal->formatAmount(2),
            'transactionId' => $invoice_id,
            'currency' => 'USD',
            'cancelUrl' => $paypal->getCancelUrl($invoice_id),
            'returnUrl' => $paypal->getReturnUrl($invoice_id),
            'notifyUrl' => $paypal->getNotifyUrl($invoice_id),
        ]);
        if ($response->isSuccessful()) {
            Orders::where('invoice_id',$invoice_id)
                    ->update([
                        'amount_status' => 'completed',
                        'payment_id' => $response->getTransactionReference(),
                        'payment_method' => 'paypal',
                        'updated_at' =>  new DateTime,
                    ]);
            Session::put('success','You recent payment is sucessful with reference code ' . $response->getTransactionReference());
            return Redirect('order/view/'.$invoice_id);
        }
        Session::put('warning', $response->getMessage());
        return Redirect('order/view/'.$invoice_id);
    }

    public function cancelled($invoice_id)
    {
        Session::put('warning', 'You have cancelled your recent PayPal payment !');
        return Redirect('order/view/'.$invoice_id);
    }
    public function webhook($invoice_id, $env)
    {
       
    }
}