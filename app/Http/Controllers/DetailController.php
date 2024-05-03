<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index (Request $request, Client $client) {
        $details = $client->details;
        return view('pages.journal.details', [
            'details' => $details
        ]);
    }

    public function store (Request $request, Client $client) {
        $category = new Category();
        $category->title = $request->title;
        $category->enabled = $request->enabled;
        $client->details()->save($category);

        return back()->with('toast', ['success', '科目分類を新規作成しました']);
    }

    public function update (Request $request, Category $category) {
        $category->title = $request->title;
        $category->enabled = $request->enabled;
        $category->save();

        return back()->with('toast', ['success', '科目分類を更新しました']);
    }

    public function destroy (Request $request, Category $category) {
        $category->delete();

        return back()->with('toast', ['success', '科目分類を削除しました']);
    }
}
