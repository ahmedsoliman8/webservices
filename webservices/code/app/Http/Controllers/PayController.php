<?php

namespace App\Http\Controllers;

use App\Pay;
use App\Profit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PHPUnit\TextUI\ResultPrinter;

class PayController extends Controller
{
    private $_apiContext;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public  function contextPaypal(){
       $this->_apiContext=new ApiContext(
           new OAuthTokenCredential(
               config('paypal_payment.Account.ClientId'),
               config('paypal_payment.Account.ClientSecret')
               ));
       $this->_apiContext->setConfig(config('paypal_payment.Setting'));
    }

    public  function AddCreditNow(Request $request){
     $price= intval ($request->price);

     $this->contextPaypal();
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($price);


        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription("Payment description");

        $baseUrl = url('/');
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/doneCharge?success=true")
            ->setCancelUrl("$baseUrl/errorCharge?success=false");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        $request = clone $payment;
        $curl_info=curl_version();
        try {
            $payment->create($this->_apiContext);




        } catch (PayPalConnectionException $ex) {
          echo $ex->getCode();
          echo $ex->getData();
        }
        $redirect=null;
        foreach ($payment->getLinks() as $link){
            if($link->getRel() == 'approval_url'){
                $redirect=$link->getHref();
            }
        }

        if($redirect != null){
            return  redirect()->away($redirect);
        }
        abort('403');





    }
    public  function getPaymentInfoByID($id){
       $pay=Payment::get($id,$this->_apiContext);
       return $pay;
    }

    public function doneCharge(Request $request){
        if($request->success == true && $request->paymentId  && $request->token && $request->PayerID){
            $this->contextPaypal();
           $info= $this->getPaymentInfoByID($request->paymentId);
           if($info->state ==  "created"){
               $pay=new Pay();
               $pay->id_pay=$request->paymentId ;
               $pay->user_id=Auth::user()->id;
               $pay->payment_method=$info->payer->payment_method;
               $pay->state=$info->state;
               $pay->PayerID=$request->PayerID;
               $pay->price=$info->transactions[0]->amount->total;
               $pay->save();
               return Redirect("/#/ShowAllCharge");
           }
         abort('403');
        }
        abort('403');
    }

    public  function errorCharge(){
        return Redirect("/#/AddCredit");
    }

    public  function AdminSendMoney ($id){
        $profit=Profit::findOrfail($id);
        if($profit){
            $user=User::findOrfail($profit->user_id);
            if($user){
                $this->contextPaypal();
                $payouts = new \PayPal\Api\Payout();
                $senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();
                $senderBatchHeader->setSenderBatchId(uniqid())
                    ->setEmailSubject("5dmat Ahmed mahmoud send profit !");
                $senderItem = new \PayPal\Api\PayoutItem(
                    array(
                        "recipient_type" => "EMAIL",
                        "receiver" => $user->email,
                        "note" => "5dmat Ahmed mahmoud send profit",
                        "sender_item_id" => uniqid(),
                        "amount" => array(
                            "value" => $profit->profit_price,
                            "currency" => "USD"
                        )
                    )
                );
                $payouts->setSenderBatchHeader($senderBatchHeader)->addItem($senderItem);
                $request = clone $payouts;
                try {

                    $output = $payouts->createSynchronous($this->_apiContext);


                } catch (PayPalConnectionException $ex) {
                   abort(403);
               }


            }

        }
        abort('403');
    }


}
