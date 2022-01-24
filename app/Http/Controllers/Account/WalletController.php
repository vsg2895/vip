<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PaymentMethod;
use App\WalletPayment;
use App\WalletOperation;

class WalletController extends Controller
{
    // Pagination items count
    protected $pagination_items_count = 10;

    // Auth Validation
    public function __construct() 
    {
        $this->middleware('auth');
    }

    // Wallet
    public function index(Request $request, $locale = 'hy'){
        // Get middleware data
        $data = $request->data;

        // Get payment methods data
        $payment_methods = PaymentMethod::with('option')->orderBy('position_id', 'desc')->get();

        // Push data
        $data['payment_methods'] = $payment_methods;
        $data['page_name_account_aside'] = 'wallet';

        // Chek request type
        if($request->ajax()){ // Axios request
            // Send data to view
            return view('account.wallet.content')->with($data);
        }else{
            // Send data to view
            return view('account.wallet.index')->with($data);
        }
    }

    // Payments
    public function payments(Request $request, $locale = 'hy'){
        // Get middleware data
        $data = $request->data;

        // Get payments data
        $payments = WalletPayment::with([
            'payment_method',
        ])->where('wallet_id', Auth::user()->wallet['id'])->orderBy('id', 'desc')->paginate($this->pagination_items_count);

        // Push data
        $data['payments'] = $payments;
        $data['page_name_account_aside'] = 'wallet';

        // Chek request type
        if($request->ajax()){ // Axios request
            // Send data to view
            return view('account.wallet.payments')->with($data);
        }else{
            // Send data to view
            return view('account.wallet.index')->with($data);
        }
    }

    // Operations
    public function operations(Request $request, $locale = 'hy'){
        // Get middleware data
        $data = $request->data;

        // Get operations data
        $operations = WalletOperation::where('wallet_id', Auth::user()->wallet['id'])->orderBy('id', 'desc')->paginate($this->pagination_items_count);

        // Push data
        $data['operations'] = $operations;
        $data['page_name_account_aside'] = 'wallet';

        // Chek request type
        if($request->ajax()){ // Axios request
            // Send data to view
            return view('account.wallet.operations')->with($data);
        }else{
            // Send data to view
            return view('account.wallet.index')->with($data);
        }
    }
}
