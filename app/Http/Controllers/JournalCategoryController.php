<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\JournalCategory;
use Illuminate\Http\Request;

class JournalCategoryController extends Controller
{
    public function index (Request $request, Client $client) {
        return view('pages.master.journal_categories', [
            'journal_categories' => $client->journal_categories,
            'client' => $client
        ]);
    }

    public function store (Request $request, Client $client) {
        $journal_category = new JournalCategory();
        $journal_category->title = $request->title;
        $journal_category->modify = $request->modify;
        $journal_category->carryover = $request->carryover;
        $client->journal_categories()->save($journal_category);

        return back()->with('toast', ['success', '連結仕訳分類を新規作成しました']);
    }

    public function update (Request $request, JournalCategory $journal_category) {
        $journal_category->title = $request->title;
        $journal_category->modify = $request->modify;
        $journal_category->carryover = $request->carryover;
        $journal_category->save();

        return back()->with('toast', ['success', '連結仕訳分類を更新しました']);
    }

    public function destroy (Request $request, JournalCategory $journal_category) {
        $journal_category->delete();

        return back()->with('toast', ['success', '連結仕訳分類を削除しました']);
    }
}
