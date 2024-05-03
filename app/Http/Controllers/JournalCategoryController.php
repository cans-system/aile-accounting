<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\JournalCategory;
use Illuminate\Http\Request;

class JournalCategoryController extends Controller
{
    public function index (Request $request, Client $client) {
        $journal_categories = $client->journal_categories;
        return view('pages.master.journal_categories', [
            'journal_categories' => $journal_categories,
            'client' => $client
        ]);
    }

    public function store (Request $request, Client $client) {
        $category = new JournalCategory();
        $category->title = $request->title;
        $category->modify = $request->modify;
        $category->carryover = $request->carryover;
        $client->journal_categories()->save($category);

        return back()->with('toast', ['success', '科目分類を新規作成しました']);
    }

    public function update (Request $request, JournalCategory $category) {
        $category->title = $request->title;
        $category->modify = $request->modify;
        $category->modify = $request->modify;
        $category->carryover = $request->carryover;
        $category->save();

        return back()->with('toast', ['success', '科目分類を更新しました']);
    }

    public function destroy (Request $request, JournalCategory $category) {
        $category->delete();

        return back()->with('toast', ['success', '科目分類を削除しました']);
    }
}
