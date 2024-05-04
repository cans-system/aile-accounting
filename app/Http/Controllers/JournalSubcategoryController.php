<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\JournalSubcategory;
use Illuminate\Http\Request;

class JournalSubcategoryController extends Controller
{
    public function index (Request $request, Client $client) {
        return view('pages.master.journal_subcategories', [
            'journal_subcategories' => $client->journal_subcategories,
            'client' => $client,
            'journal_categories' => $client->journal_categories
        ]);
    }

    public function store (Request $request, Client $client) {
        $journal_subcategory = new JournalSubcategory();
        $journal_subcategory->title = $request->title;
        $journal_subcategory->journal_category_id = $request->journal_category_id;
        $journal_subcategory->save();

        return back()->with('toast', ['success', '連結仕訳小分類を新規作成しました']);
    }

    public function update (Request $request, JournalSubcategory $journal_subcategory) {
        $journal_subcategory->title = $request->title;
        $journal_subcategory->journal_category_id = $request->journal_category_id;
        $journal_subcategory->save();

        return back()->with('toast', ['success', '連結仕訳小分類を更新しました']);
    }

    public function destroy (Request $request, JournalSubcategory $journal_subcategory) {
        $journal_subcategory->delete();

        return back()->with('toast', ['success', '連結仕訳小分類を削除しました']);
    }
}
