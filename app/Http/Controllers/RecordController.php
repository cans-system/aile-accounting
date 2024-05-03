<?php

namespace App\Http\Controllers;

use App\Enums\Statement;
use App\Models\Client;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index (Request $request, Client $client, Statement $statement) {
        return view('pages.package.records', [
            'accounts' => $client->accounts()->where('statement', $statement)->get(),
            'categories' => $client->categories(),
            'client' => $client,
            'statement' => $statement
        ]);
    }

    public function sync (Request $request, Client $client, Statement $statement) {
        $term_id = $request->session()->get('selected_term')->id;
        $records = array_map(function ($account_id, $attrs) use ($term_id) {
            return [
                'amount' => $attrs['amount'],
                'note' => $attrs['note'],
                'account_id' => $account_id,
                'term_id' => $term_id,
            ];
        }, array_keys($request->accounts), array_values($request->accounts));
        Record::upsert($records, ['term_id', 'account_id'], ['amount', 'note']);

        return back()->with('toast', ['success', '貸借対照表を更新しました']);
    }
}
