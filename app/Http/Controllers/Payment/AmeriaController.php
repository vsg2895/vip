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

class AmeriaController extends Controller
{
    // Account ID
    private $client_id = '3d19541048';

    // Account Secret Key
    private $client_secret_key = '77cf7c0a-d380-41c9-9ed4-b6e9bca8832e';
    
    // Account Secret Password
    private $client_secret_password = 'lazY2k';
    
    // Curl
    private $url = 'https://servicestest.ameriabank.am/VPOS/';
    // private $url = 'https://services.ameriabank.am/VPOS/';

    // Request from ameria page handler
    public function index(Request $request)
    {
        // Get order id
        $order_id = $request->session()->get('order_id');

        // Get payment data
        $payment_method = array(
            'client_id' => $this->client_id,
            'client_secret_key' => $this->client_secret_key,
            'client_secret_password' => $this->client_secret_password,
        );

        // Get current language
        $lang = app()->getLocale();

        // Check data
        if($request['resposneCode'] != '00'){ // Error
            // Rediret to error payment page
            return view('account.wallet.payment.error')->with($data);
        }
        else{
            // Checking status with ameria
            return redirect()->route('ameriaGetDetails', ['payment_id' => $request['paymentID'], 'order_id' => $order_id ]);
        }
    }

    // Pay Order
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

        // Get payment data
        $payment_method = array(
            'client_id' => $this->client_id,
            'client_secret_key' => $this->client_secret_key,
            'client_secret_password' => $this->client_secret_password,
        );

        $orderdetails = '';

        // Get current currency
        $currency = strtoupper($data['currency']['type']);

        // Make sending data
        $data = array(
            'ClientID' => $payment_method['client_secret_key'],
            // 'Amount' => $amount,
            'Amount' => 10,
            'OrderID' => 2357655,
            // 'OrderID' => $order_id,
            'BackURL' => route('ameria', ['locale' => app()->getLocale()]),
            'Username' => $payment_method['client_id'],
            'Password' => $payment_method['client_secret_password'],
            'Description' => $orderdetails,
            // 'Currency' => $data['currency']['type'],
        );

        $data_string = json_encode($data);

        $ch = curl_init($this->url.'api/VPOS/InitPayment');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );

        // Execute!
        $response = curl_exec($ch);

        // Close the connection, release resources used
        curl_close($ch);

        // Do anything with response
        $response = json_decode($response);

        if ($response->ResponseCode != 1 && $request->session()->has('wallet_payment_id') && $request->session()->has('wallet_operation_id')) { // Error
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
        
            // Redirect back with error response
            return view('account.wallet.payment.error')->with($data);
        }else{
            // Get payment id
            $paymentID = $response->PaymentID;

            // Success
            return redirect($this->url.'Payments/Pay?id='.$paymentID.'&lang=hy');
        }
    }

    public function getDetails(Request $request, $payment_id, $order_id)
    {
        // Get payment data
        $payment_method = array(
        'client_id' => $this->client_id,
        'client_secret_key' => $this->client_secret_key,
        'client_secret_password' => $this->client_secret_password,
        );

        // Get pay Details
        $data = array(
            'PaymentID' => $payment_id,
            'Username' => $payment_method['client_id'],
            'Password' => $payment_method['client_secret_password'],
        );

        // Resposnse convert to string
        $data_string = json_encode($data);
            $ch = curl_init($this->url.'api/VPOS/GetPaymentDetails');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );

        // Execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);

        // Do anything with response
        $response = json_decode($response);

        if ($response->ResponseCode == '00') {
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

            // Save sessions
            $request->session()->save();
        
            // Redirect back with error response
            return view('account.wallet.payment.success')->with($data);
        }else{
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
        
            // Redirect back with error response
            return view('account.wallet.payment.error')->with($data);

            // Error
            return redirect()->route('checkout-error');
        }
    }
}
