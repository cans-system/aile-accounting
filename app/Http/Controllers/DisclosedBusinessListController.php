<?php

namespace App\Http\Controllers;

use App\Models\DisclosedBusinessList;
use Illuminate\Http\Request;

class DisclosedBusinessListController extends Controller
{
    public function index (Request $request) {
        $lists = DisclosedBusinessList::where('client_id', $request->user()->client_id)->get();
        return view('pages.master.disclosed_business_lists', [
            'lists' => $lists
        ]);
    }

    public function store (Request $request) {
        $list = new DisclosedBusinessList();
        $list->title = $request->title;
        $list->enabled = $request->enabled;
        $list->client_id = $request->user()->client_id;
        $list->save();

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
