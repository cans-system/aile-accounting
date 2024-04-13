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
            'subjects' => [
                ['en' => 'master', 'ja' => 'マスタ設定'],
                ['en' => 'package', 'ja' => '連結パッケージ'],
                ['en' => 'settlement', 'ja' => '連結決算処理'],
                ['en' => 'users', 'ja' => 'ユーザー管理'],
                ['en' => 'closing', 'ja' => '締め処理'],
                ['en' => 'carryover', 'ja' => '繰越処理']
            ],
            'levels' => [
                ['en' => 'writable', 'ja' => '入力、編集、削除'],
                ['en' => 'approveonly', 'ja' => '承認のみ'],
                ['en' => 'readonly', 'ja' => '閲覧のみ'],
                ['en' => 'disabled', 'ja' => '使用不可']
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
