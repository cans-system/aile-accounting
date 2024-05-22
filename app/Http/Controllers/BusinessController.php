<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Client;
use App\Models\DisclosedBusinessList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusinessController extends Controller
{
    public function index (Request $request, Client $client) {
        $businesses = $client->businesses;
        $lists = $client->disclosed_business_lists;
        return view('pages.master.businesses', [
            'businesses' => $businesses,
            'lists' => $lists,
            'client' => $client
        ]);
    }

    public function store (Request $request, DisclosedBusinessList $disclosed_business_list) {
        $business = new Business();
        $business->title = $request->title;
        $business->enabled = $request->enabled;
        $business->disclosed_business_list_id = $disclosed_business_list->id;
        $business->save();

        return back()->withFragment($business->disclosed_business_list_id)->with('toast', ['success', '事業セグメントを新規作成しました']);
    }

    public function update (Request $request, Business $business) {
        $business->title = $request->title;
        $business->enabled = $request->input('enabled', 0);
        $business->save();

        return back()->withFragment($business->disclosed_business_list_id)->with('toast', ['success', '事業セグメントを更新しました']);
    }

    public function destroy (Request $request, Business $business) {
        $business->delete();

        return back()->with('toast', ['success', '事業セグメントを削除しました']);
    }
}
