<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    public function index (Request $request) {
        $currencies = $request->user()->client->currencies;
        return view('pages.master.currencies', [
            'currencies' => $currencies
        ]);
    }

    public function store (Request $request) {
        $currency = new Currency();
        $currency->title = $request->title;
        $currency->client_id = $request->user()->client_id;
        $currency->save();

        return back()->with('toast', ['success', '通貨を新規作成しました']);
    }

    public function update (Request $request, Currency $currency) {
        $currency->title = $request->title;
        $currency->save();

        return back()->with('toast', ['success', '通貨を更新しました']);
    }

    public function destroy (Request $request, Currency $currency) {
        $currency->delete();

        return back()->with('toast', ['success', '通貨を削除しました']);
    }
}
