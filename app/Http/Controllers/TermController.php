<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermController extends Controller
{
    public function index (Request $request) {
        $terms = $request->user()->client->terms;
        return view('pages.master.terms', [
            'terms' => $terms
        ]);
    }

    public function store (Request $request) {
        $term = new Term();
        $term->group = $request->group;
        $term->month = $request->month;
        $term->type = $request->type;
        $term->period = $request->period;
        $term->client_id = $request->user()->client_id;
        $term->save();

        return back()->with('toast', ['success', '会計期間を新規作成しました']);
    }

    public function update (Request $request, Term $term) {
        $term->group = $request->group;
        $term->month = $request->month;
        $term->type = $request->type;
        $term->period = $request->period;
        $term->save();

        return back()->with('toast', ['success', '会計期間を更新しました']);
    }

    public function destroy (Request $request, Term $term) {
        $term->delete();

        return back()->with('toast', ['success', '会計期間を削除しました']);
    }
}
