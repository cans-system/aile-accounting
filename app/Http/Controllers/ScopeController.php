<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Scope;
use App\Models\Term;
use Illuminate\Http\Request;

class ScopeController extends Controller
{
    public function index (Request $request, Client $client) {
        $term_id = $request->session()->get('selected_term')->id;
        $scopes = Term::find($term_id)->scopes;
        $companies = $client->companies;
        return view('pages.master.scopes', [
            'scopes' => $scopes,
            'companies' => $companies
        ]);
    }

    public function store (Request $request, Client $client) {
        $scope = new Scope();
        $scope->company_id = $request->company_id;
        $scope->relation = $request->relation;
        $scope->term_id = $request->session()->get('selected_term')->id;
        $scope->save();

        return back()->with('toast', ['success', '連結範囲を新規作成しました']);
    }

    public function update (Request $request, Scope $scope) {
        $scope->company_id = $request->company_id;
        $scope->relation = $request->relation;
        $scope->save();

        return back()->with('toast', ['success', '連結範囲を更新しました']);
    }

    public function destroy (Request $request, Scope $scope) {
        $scope->delete();

        return back()->with('toast', ['success', '連結範囲を削除しました']);
    }
}
