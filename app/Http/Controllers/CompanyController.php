<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Currency;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index (Request $request) {
        $companies = $request->user()->client->companies;
        $currencies = $request->user()->client->currencies;
        $businesses = $request->user()->client->businesses;
        return view('pages.master.companies', [
            'companies' => $companies,
            'currencies' => $currencies,
            'businesses' => $businesses
        ]);
    }

    public function store (Request $request) {
        $company = new Company();
        $company->title = $request->title;
        $company->fiscal_month = $request->fiscal_month;
        $company->currency_id = $request->currency_id;
        $company->business_id = $request->business_id;
        $company->client_id = $request->user()->client_id;
        $company->save();

        $company->businesses()->sync($request->business_id_list);

        return back()->with('toast', ['success', '会社を新規作成しました']);
    }

    public function update (Request $request, Company $company) {
        $company->title = $request->title;
        $company->fiscal_month = $request->fiscal_month;
        $company->currency_id = $request->currency_id;
        $company->business_id = $request->business_id;
        $company->save();

        $company->businesses()->sync($request->business_id_list);

        return back()->with('toast', ['success', '会社を更新しました']);
    }

    public function destroy (Request $request, Company $company) {
        $company->delete();

        return back()->with('toast', ['success', '会社を削除しました']);
    }
}
