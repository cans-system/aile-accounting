<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index (Request $request) {
        $roles = $request->user()->client->roles;
        return view('pages.management.roles', [
            'roles' => $roles,
            'collection' => [
                'マスタ設定', '連結パッケージ', '連結決算処理', 'ユーザー管理', '締め処理', '繰越処理'
            ]
        ]);
    }

    public function store (Request $request) {
        $role = new Role();
        $role->title = $request->title;
        $role->master = $request->master;
        $role->package = $request->package;
        $role->settlement = $request->settlement;
        $role->users = $request->users;
        $role->closing = $request->closing;
        $role->carryover = $request->carryover;
        $role->client_id = $request->user()->client_id;
        $role->save();
        
        $role->companies()->sync($request->company_id_list);

        return back()->with('toast', ['success', 'ロールを新規作成しました']);
    }

    public function update (Request $request, Role $role) {
        $role->title = $request->title;
        $role->master = $request->master;
        $role->package = $request->package;
        $role->settlement = $request->settlement;
        $role->users = $request->users;
        $role->closing = $request->closing;
        $role->carryover = $request->carryover;
        $role->save();

        return back()->with('toast', ['success', 'ロールを更新しました']);
    }

    public function destroy (Request $request, Role $role) {
        $role->delete();

        return back()->with('toast', ['success', 'ロールを削除しました']);
    }
}
