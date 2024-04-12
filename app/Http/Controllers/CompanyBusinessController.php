<?php

namespace App\Http\Controllers;

use App\Models\CompanyBusiness;
use Illuminate\Http\Request;

class CompanyBusinessController extends Controller
{
    public function index (Request $request) {
        $companies = $request->user()->client->companies;
        $businesses = $request->user()->client->businesses;
        return view('pages.master.company_business', [
            'relations' => $relations,
            'companies' => $companies,
            'businesses' => $businesses
        ]);
    }

    public function store (Request $request) {
        $company_business = new CompanyBusiness();
        $company_business->company_id = $request->company_id;
        $company_business->business_id = $request->business_id;
        $company_business->default = $request->default;
        $company_business->save();

        return back()->with('toast', ['success', '紐づけを新規作成しました']);
    }

    public function update (Request $request, CompanyBusiness $company_business) {
        $company_business->company_id = $request->company_id;
        $company_business->business_id = $request->business_id;
        $company_business->default = $request->default;
        $company_business->save();

        return back()->with('toast', ['success', '紐づけを更新しました']);
    }

    public function destroy (Request $request, CompanyBusiness $company_business) {
        $company_business->delete();

        return back()->with('toast', ['success', '紐づけを削除しました']);
    }
}
