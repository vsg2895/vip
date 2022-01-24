<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Wallet;
use App\WalletPayment;
use App\WalletOperation;
use App\PaymentMethod;
use App\PaymentMethodOption;

class IdramController extends Controller
{
    // Account ID
    private $paymentAccount = '110000491';
    
    // Account Secret Key
    private $paymentSecret = 'kBgZLDB9tNTz4y9f8xsYyG7TCt4brjYshSeAd4';
    
    // Curl
    private $url = 'https://money.idram.am/payment.aspx';

    // Request from idram page handler
    public function index(Request $request)
    {
        // Get order id
        $order_id = $request->session()->get('order_id');
      
        // Idram Payment System provide it
        define("SECRET_KEY", $this->paymentSecret); 
        
        // Idram Payment System provide it
        define("EDP_REC_ACCOUNT", $this->paymentAccount); 

        // Check first request results
        if($request->has('EDP_PRECHECK') && $request->has('EDP_BILL_NO') && $request->has('EDP_REC_ACCOUNT') && $request->has('EDP_AMOUNT')){
            // Check precheck data
            if($request->EDP_PRECHECK == "YES"){
                // Check al data equeals
                if($request->EDP_REC_ACCOUNT == EDP_REC_ACCOUNT){
                    // Meke order id
                    $bill_no = $request->DP_BILL_NO;
                    
                    // Success response
                    exit("OK");
                }
            }
        }
        
        // Check account data
        if($request->has('EDP_PAYER_ACCOUNT') &&
            $request->has('EDP_BILL_NO') && $request->has('EDP_REC_ACCOUNT') &&
            $request->has('EDP_AMOUNT') && $request->has('EDP_TRANS_ID') && $request->has('EDP_CHECKSUM')){

            // String convert to hash
            $txtToHash = EDP_REC_ACCOUNT . ":" .
                         $request->EDP_AMOUNT . ":" .
                         SECRET_KEY . ":" .
                         $request->EDP_BILL_NO . ":" .
                         $request->EDP_PAYER_ACCOUNT . ":" .
                         $request->EDP_TRANS_ID . ":" .
                         $request->EDP_TRANS_DATE;
            
            // Secure checking
            if(strtoupper($request->EDP_CHECKSUM) != strtoupper(md5($txtToHash))){
                // Error response
                exit("FAIL");
            }else{
               // Get added balance price
               $added_balance_price = 5000;

                // Get wallet data
                $wallet = Wallet::where('user_id', Auth::user()->id)->first();
                $wallet->balance = intval($wallet->blanace) + intval($added_balance_price);
                
                // Save data
                $wallet->save();

                // Success response
                exit("OK");
            }
       }

       // Error response 
       exit("FAIL");
    }

    // Payment handling main operation
    public function payOrder(Request $request)
    {
        // Get data from middleware
        $data = $request->data;

        // Validation
        $request->validate([
            'price' => 'required'
        ]);

        // Get payment option data
        $payment_option = PaymentMethodOption::findOrFail($request->price);

        // Check auth
        if(!Auth::check()){
            // Redirect to home
            return redirect()->route('home', ['locale' => app()->getLocale()]);
        }

        // Get payment method data
        $payment_method_data = PaymentMethod::where('type', 'idram')->first();

        // Get wallet data
        $wallet_data = Wallet::where('user_id', Auth::user()->id)->first();

        // Validate wallet data
        if(!isset($wallet_data) || $wallet_data == NULL){
            // Redirect to home
            return redirect()->route('home', ['locale' => app()->getLocale()]);
        }

        // Validate payment method data
        if(!isset($payment_method_data) || $payment_method_data == NULL){
            // Redirect to home
            return redirect()->route('home', ['locale' => app()->getLocale()]);
        }

        // Make data to insert wallet payments
        $wallet_payment = new WalletPayment;
        $wallet_payment->payment_method_id = $payment_method_data->id;
        $wallet_payment->wallet_id = $wallet_data->id;
        $wallet_payment->price = intval(price_handler($payment_option->price, $data['currency']['value']));

        // Save data
        $wallet_payment->save();

        // Make session
        $request->session()->put('wallet_payment_id', $wallet_payment->id);

        // Make data to insert wallet operation
        $wallet_operation = new WalletOperation;
        $wallet_operation->wallet_id = $wallet_data->id;
        $wallet_operation->price = intval(price_handler($payment_option->price, $data['currency']['value']));
        $wallet_operation->description = translating('pending-payment-data');

        // Save data
        $wallet_operation->save();

        // Make session
        $request->session()->put('wallet_operation_id', $wallet_operation->id);

        // Make order id 
        $order_id = $wallet_payment->id;

        // Make order name
        $ordername = translating('add-to-balance');

        // Get pirce
        $amount = intval(price_handler($payment_option->price, $data['currency']['value']));

        // Make payment account data
        $payment_method = array(
            'client_secret_key' => $this->paymentSecret,
            'client_id' => $this->paymentAccount,
        );

        $payment_secure_data = array(
            'payment_method' => $payment_method,
            'order_id' => $order_id,
            'amount' => $amount,
            'ordername' => $ordername,
        );

        // Push data
        $data['payment_secure_data'] = $payment_secure_data;

        // Meke session id order id
        $request->session()->put('order_id', $order_id);
        
        // Meke session added price
        $request->session()->put('added_price', $amount);

        // Send data to idram blade and submit form to idram api page
        return view('account.wallet.payment.idram')->with($data);
    }

    // Error response function
    public function error(Request $request)
    {
        // Get middleware dara
        $data = $request->data;

        // Check order id
        if($request->EDP_BILL_NO && $request->session()->has('wallet_payment_id') && $request->session()->has('wallet_operation_id')) {
            // Get order id
            $order_id = $request->EDP_BILL_NO;

            // Make data to insert wallet payments
            $wallet_payment = WalletPayment::findOrFail($request->session()->get('wallet_payment_id'));
            $wallet_payment->payment_method_id = $payment_method_data->id;
            $wallet_payment->wallet_id = $wallet_data->id;
            $wallet_payment->price = intval(price_handler($payment_option->price, $data['currency']['value']));
            $wallet_payment->status = 'error_finished';

            // Save data
            $wallet_payment->save();

            // Make data to insert wallet operation
            $wallet_operation = WalletOperation::findOrFail($request->session()->get('wallet_operation_id'));
            $wallet_operation->description = translating('pending-payment-data');
            $wallet_operation->status = 'error_finished';

            // Save data
            $wallet_operation->save();

            // Forget payment session
            $request->session()->forget('wallet_payment_id');

            // Forget operation session
            $request->session()->forget('wallet_operation_id');

            // Save sessions
            $request->session()->save();
        }

        // Redirect back with error response
        return view('account.wallet.payment.error')->with($data);
    }

    // Success response function
    public function success(Request $request)
    {
        // Get middleware dara
        $data = $request->data;

        // Check order id
        if($request->EDP_BILL_NO && $request->session()->has('wallet_payment_id') && $request->session()->has('wallet_operation_id')) {
            // Get order id
            $order_id = $request->EDP_BILL_NO;

            // Make data to insert wallet payments
            $wallet_payment = WalletPayment::findOrFail($request->session()->get('wallet_payment_id'));
            $wallet_payment->payment_method_id = $payment_method_data->id;
            $wallet_payment->wallet_id = $wallet_data->id;
            $wallet_payment->price = intval(price_handler($payment_option->price, $data['currency']['value']));
            $wallet_payment->status = 'success_finished';
            
            // Save data
            $wallet_payment->save();

            // Make data to insert wallet operation
            $wallet_operation = WalletOperation::findOrFail($request->session()->get('wallet_operation_id'));
            $wallet_operation->description = translating('pending-payment-data');
            $wallet_operation->status = 'success_finished';

            // Save data
            $wallet_operation->save();

            // Get wallet data
            $wallet = Wallet::where('user_id', Auth::user()->id)->first();
            $wallet->balance = intval($wallet->balance) + intval($request->session()->get('added_price'));

            // Save data
            $wallet->save();

            // Forget payment session
            $request->session()->forget('wallet_payment_id');

            // Forget operation session
            $request->session()->forget('wallet_operation_id');
            
            // Forget session added price
            $request->session()->forget('added_price');

            // Save session
            $request->session()->save();
            
        }

        // Redirect back with success response
        return view('account.wallet.payment.success')->with($data);
    }

    // Debug function
    public function debug()
    {

    }
}
