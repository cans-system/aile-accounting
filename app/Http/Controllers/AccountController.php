<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Client;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index (Request $request, Client $client) {
        return view('pages.master.accounts', [
            'accounts' => $client->accounts,
            'disclosed_account_lists' => $client->disclosed_account_lists,
            'categories' => $client->categories,
            'client' => $client
        ]);
    }

    public function store (Request $request, Client $client) {
        $account = new Account();
        $account->title = $request->title;
        $account->title_en = $request->title_en;
        $account->detail_summary = $request->detail_summary;
        $account->statement = $request->statement;
        $account->category_id = $request->category_id;
        $account->dr_cr = $request->dr_cr;
        $account->year_disclosed_account_list_id = $request->year_disclosed_account_list_id;
        $account->quarter_disclosed_account_list_id = $request->quarter_disclosed_account_list_id;
        $account->conversion = $request->conversion;
        $account->fcta_account_id = $request->fcta_account_id;
        $account->enabled = $request->enabled;
        $account->save();

        return back()->with('toast', ['success', '勘定科目を新規作成しました']);
    }

    public function update (Request $request, Account $account) {
        $account->title = $request->title;
        $account->title_en = $request->title_en;
        $account->detail_summary = $request->detail_summary;
        $account->statement = $request->statement;
        $account->category_id = $request->category_id;
        $account->dr_cr = $request->dr_cr;
        $account->year_disclosed_account_list_id = $request->year_disclosed_account_list_id;
        $account->quarter_disclosed_account_list_id = $request->quarter_disclosed_account_list_id;
        $account->conversion = $request->conversion;
        $account->fcta_account_id = $request->fcta_account_id;
        $account->enabled = $request->enabled;
        $account->save();

        return back()->with('toast', ['success', '勘定科目を更新しました']);
    }

    public function destroy (Request $request, Account $account) {
        $account->delete();

        return back()->with('toast', ['success', '勘定科目を削除しました']);
    }
}
