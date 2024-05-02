<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Rate;
use App\Models\Term;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function index (Request $request, Client $client) {
        $term_id = $request->session()->get('selected_term')->id;
        $rates = Term::find($term_id)->rates;
        $currencies = $client->currencies;
        return view('pages.master.rates', [
            'rates' => $rates,
            'currencies' => $currencies,
            'client' => $client
        ]);
    }

    public function store (Request $request, Client $client) {
        $rate = new Rate();
        $rate->last_day_rate = $request->last_day_rate;
        $rate->average_rate = $request->average_rate;
        $rate->currency_id = $request->currency_id;
        $rate->term_id = $request->session()->get('selected_term')->id;
        $rate->save();

        return back()->with('toast', ['success', '換算レートを新規作成しました']);
    }

    public function update (Request $request, Rate $rate) {
        $rate->last_day_rate = $request->last_day_rate;
        $rate->average_rate = $request->average_rate;
        $rate->currency_id = $request->currency_id;
        $rate->save();

        return back()->with('toast', ['success', '換算レートを更新しました']);
    }

    public function destroy (Request $request, Rate $rate) {
        $rate->delete();

        return back()->with('toast', ['success', '換算レートを削除しました']);
    }
}
