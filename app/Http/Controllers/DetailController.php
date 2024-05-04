<?php

namespace App\Http\Controllers;

use App\Enums\DetailSummary;
use App\Models\detail;
use App\Models\Client;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function edit (Request $request, Client $client) {
        return view('pages.journal.details_edit', [
            'details' => $client->details,
            'client' => $client,
            'accounts' => $client->accounts()->where('detail_summary', DetailSummary::DETAIL)->get(),
            'cbs' => $client->cbs,
            'jscs' => $client->jscs,
        ]);
    }

    public function store (Request $request, Client $client) {
        $detail = new Detail();
        $detail->company_business_id = $request->company_business_id;
        $detail->target_company_business_id = $request->target_company_business_id;
        $detail->account_id = $request->account_id;
        $detail->dr_amount = $request->dr_amount;
        $detail->cr_amount = $request->cr_amount;
        $detail->note = $request->note;
        $detail->journal_subcategory_id = $request->journal_subcategory_id;
        // $detail->file_name = $request->note;
        $detail->save();

        return back()->with('toast', ['success', '科目分類を新規作成しました']);
    }

    public function update (Request $request, Detail $detail) {
        $detail->company_business_id = $request->company_business_id;
        $detail->target_company_business_id = $request->target_company_business_id;
        $detail->account_id = $request->account_id;
        $detail->dr_amount = $request->dr_amount;
        $detail->cr_amount = $request->cr_amount;
        $detail->note = $request->note;
        $detail->journal_subcategory_id = $request->journal_subcategory_id;
        // $detail->file_name = $request->note;
        $detail->save();

        return back()->with('toast', ['success', '科目分類を更新しました']);
    }

    public function destroy (Request $request, Detail $detail) {
        $detail->delete();

        return back()->with('toast', ['success', '科目分類を削除しました']);
    }
}
