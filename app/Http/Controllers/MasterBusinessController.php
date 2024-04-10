<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\DisclosedBusinessList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterBusinessController extends Controller
{
    public function index (Request $request) {
        $businesses = $request->user()->client->businesses;
        $lists = DisclosedBusinessList::where('client_id', $request->user()->client_id)->get();
        return view('pages.master.business', [
            'businesses' => $businesses,
            'lists' => $lists
        ]);
    }

    public function store (Request $request) {
        $business = new Business();
        $business->title = $request->title;
        $business->enabled = $request->enabled;
        $business->disclosed_business_list_id = $request->disclosed_business_list_id;
        $business->save();

        return back()->with('toast', ['success', '事業セグメントを新規作成しました']);
    }

    public function update (Request $request, Business $business) {
        $business->title = $request->title;
        $business->enabled = $request->enabled;
        $business->disclosed_business_list_id = $request->disclosed_business_list_id;
        $business->save();

        return back()->with('toast', ['success', '事業セグメントを更新しました']);
    }

    public function destroy (Request $request, Business $business) {
        $business->delete();

        return back()->with('toast', ['success', '事業セグメントを削除しました']);
    }
}
