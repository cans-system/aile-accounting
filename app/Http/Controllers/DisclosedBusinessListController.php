<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DisclosedBusinessList;
use Illuminate\Http\Request;

class DisclosedBusinessListController extends Controller
{
    public function index (Request $request, Client $client) {
        return view('pages.master.disclosed_business_lists', [
            'lists' => $client->disclosed_business_lists
        ]);
    }

    public function store (Request $request, Client $client) {
        $list = new DisclosedBusinessList();
        $list->title = $request->title;
        $list->enabled = $request->enabled;
        $client->disclosed_business_lists()->save($list);

        return back()->with('toast', ['success', '開示事業セグメントを新規作成しました']);
    }

    public function update (Request $request, DisclosedBusinessList $disclosed_business_list) {
        $disclosed_business_list->title = $request->title;
        $disclosed_business_list->enabled = $request->enabled;
        $disclosed_business_list->save();

        return back()->with('toast', ['success', '開示事業セグメントを更新しました']);
    }

    public function destroy (Request $request, DisclosedBusinessList $disclosed_business_list) {
        $disclosed_business_list->delete();

        return back()->with('toast', ['success', '開示事業セグメントを削除しました']);
    }

}
