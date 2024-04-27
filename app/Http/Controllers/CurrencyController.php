<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    public function index (Request $request, Client $client) {
        return view('pages.master.currencies', [
            'currencies' => $client->currencies
        ]);
    }

    public function store (Request $request, Client $client) {
        $currency = new Currency();
        $currency->title = $request->title;
        $client->currencies()->save($currency);

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
