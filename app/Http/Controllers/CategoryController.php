<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index (Request $request, Client $client) {
        return view('pages.master.categories', [
            'categories' => $client->categories,
            'client' => $client
        ]);
    }

    public function store (Request $request, Client $client) {
        $category = new Category();
        $category->title = $request->title;
        $category->enabled = $request->enabled;
        $client->categories()->save($category);

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
