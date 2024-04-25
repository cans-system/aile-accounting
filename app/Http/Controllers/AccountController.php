<?php

namespace App\Http\Controllers;

use App\Enums\Statement;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index (Request $request) {
        $accounts = $request->user()->client->accounts;
        $disclosed_account_lists = $request->user()->client->disclosed_account_lists;
        $categories = $request->user()->client->categories;
        return view('pages.master.accounts', [
            'accounts' => $accounts,
            'disclosed_account_lists' => $disclosed_account_lists,
            'categories' => $categories
        ]);
    }

    public function store (Request $request) {
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
        $account->fctr = $request->fctr;
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
        $account->fctr = $request->fctr;
        $account->enabled = $request->enabled;
        $account->save();

        return back()->with('toast', ['success', '勘定科目を更新しました']);
    }

    public function destroy (Request $request, Account $account) {
        $account->delete();

        return back()->with('toast', ['success', '勘定科目を削除しました']);
    }
}
