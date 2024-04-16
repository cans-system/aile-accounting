<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Term;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function change_term(Request $request) {
        $term = Term::find($request->term_id);
        $request->session()->put('selected_term', $term);
        return back();
    }

    public function change_imperson_as(Request $request) {
        $client = Client::find($request->client_id);
        // 管理者のなりすましログインから
    }
}
