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

/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaypalController extends Controller
{    
    private $_api_context;
    public function paypalConfig()
    {
        $paypal_conf = array(
                'client_id' =>'AdSizW9D5kLxyx3qryso-YDq3-2nKzH9cTAl_ervurJ2lrTOMsl4_YeaDAq4We7CAx_P0Xy0fBDwfA3y',
                'secret' => 'EKxhqWGnF24C7b2pW7sG1LtuG1nAdsk4aFkIEuOro2FphozzcNaLKCNJRCuogGQpScMBzOxacmSIDBz3',
                'settings' => array(
                    'mode' => 'sandbox',
                    'http.ConnectionTimeOut' => 1000,
                    'log.LogEnabled' => true,
                    'log.FileName' => storage_path() . '/logs/paypal.log',
                    'log.LogLevel' => 'FINE'
                ),
            );
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    public function postPaymentWithPaypal($invoice_id = '')
    {
        self::paypalConfig();
        $order = Orders::where('invoice_id',$invoice_id)->get()->first();
        if (empty($order->invoice_id)) {
            \Session::put('error','Some error occur, sorry for inconvenient');
            return Redirect('order/view/'.$invoice_id);
        }
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName($order->package_title) 
            ->setCurrency('USD')
            ->setQuantity($order->quantity)
            ->setPrice($order->grand_total); 
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($order->grand_total);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setInvoiceNumber($invoice_id)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(url('paypal/complete'))
            ->setCancelUrl(url('paypal/complete'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return Redirect('order/view/'.$invoice_id);
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect('order/view/'.$invoice_id);
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        Session::put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url)) {

            return Redirect::away($redirect_url);
        }
        \Session::put('error','Unknown error occurred');
        return Redirect('order/view/'.$invoice_id);
    }
    public function getPaymentStatus()
    {

        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            return Redirect('cancel');
        }
        $payment = Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);
        print_r($result);
        die;
        if ($result->getState() == 'approved') { 
            Orders::where('invoice_id',$invoice_id)
                    ->update([
                        'amount_status' => 'completed',
                        'payment_id' => $payment_id,
                        'payment_method' => 'paypal',
                        'updated_at' =>  new DateTime,
                    ]);
            \Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');

        }
        \Session::put('error','Payment failed');
        return Redirect('cancel');
    }
    
}