<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DisclosedAccountList;
use Illuminate\Http\Request;

class DisclosedAccountListController extends Controller
{
    public function index (Request $request, Client $client) {
        $lists = $client->disclosed_account_lists;
        return view('pages.master.disclosed_account_lists', [
            'lists' => $lists,
            'client' => $client
        ]);
    }

    public function store (Request $request, Client $client) {
        $list = new DisclosedAccountList();
        $list->title = $request->title;
        $client->disclosed_account_lists()->save($list);

        return back()->with('toast', ['success', '開示科目を新規作成しました']);
    }

    public function update (Request $request, DisclosedAccountList $disclosed_account_list) {
        $disclosed_account_list->title = $request->title;
        $disclosed_account_list->save();

        return back()->with('toast', ['success', '開示科目を更新しました']);
    }

    public function destroy (Request $request, DisclosedAccountList $disclosed_account_list) {
        $disclosed_account_list->delete();

        return back()->with('toast', ['success', '開示科目を削除しました']);
    }

}
