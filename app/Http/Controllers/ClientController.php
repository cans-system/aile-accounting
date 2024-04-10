<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index (Request $request) {
        $clients = Client::all();
        
        return view('pages.admin.clients', [
            'clients' => $clients
        ]);
    }

    public function store (Request $request) {
        $client = new Client();
        $client->title = $request->title;
        $client->location = $request->location;
        $client->pic_name = $request->pic_name;
        $client->pic_contact = $request->pic_contact;
        $client->note = $request->note;
        $client->save();

        return back()->with('toast', ['success', 'ユーザー企業を新規作成しました']);
    }

    public function update (Request $request, Client $client) {
        $client->title = $request->title;
        $client->location = $request->location;
        $client->pic_name = $request->pic_name;
        $client->pic_contact = $request->pic_contact;
        $client->note = $request->note;
        $client->save();

        return back()->with('toast', ['success', 'ユーザー企業を更新しました']);
    }

    public function destroy (Request $request, Client $client) {
        $client->delete();

        return back()->with('toast', ['success', 'ユーザー企業を削除しました']);
    }
}
