<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CurrencyApi;

class CurrencyApiController extends Controller
{
    private $valyuts = ['amd', 'usd', 'rub', 'eur'];

    public function index(Request $request)
    {
//        $valyuts = ['amd','usd','rub','rub'];
//        dd($request->all());
        // Get api data
        $api_data = CurrencyApi::first();
        $sel_valyuta = $request->dataString['currency_1'];
        $all_converts = [];
//        $sel_valyuta = CurrencyApi::first([$request->dataString['currency_1']]);
        foreach ($this->valyuts as $v) {
            if ($v != $sel_valyuta) {
                $price = $request->dataString['price_value_1'] * (floatval($api_data->$v) / floatval($api_data->$sel_valyuta));
                $all_converts[$v] = number_format((float)$price, 2, '.', '');

            }
//            dump($api_data->$v);

        }


        // Generated request 1 data
//        $req1 = $request->dataString['currency_1'];
//
//        $cur1 = $api_data->$req1;
//
////        $valuts_cur = CurrencyApi::where(['type','amd'])->pluck('')
////        $valuts_cur = app(CurrencyApi::class)
////            ->first();
////            dd($valuts_cur);
//        // Generated request 2 data
//        $req2 = $request->dataString['currency_2'];
//        $cur2 = $api_data->$req2;

        // Price handler

//        $price = $request->dataString['price_value_1'] * (floatval($cur2) / floatval($cur1));

        // Resturn data
//        dd($all_prices);
        return response()->json(['all_converts'=>$all_converts]);
//        echo json_encode($all_prices, true);

//        echo number_format((float)$price, 2, '.', '');
    }
}
