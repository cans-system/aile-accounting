<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index (Request $request) {
        $users = User::
        where('client_id', $request->user()->client->id)
        ->get();
        
        return view('pages.admin.users', [
            'users' => $users,
            'roles' => Role::all()
        ]);
    }

    public function store (Request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = $request->password;
        $user->client_id = $request->user()->client_id;
        $user->save();

        return back()->with('toast', ['success', 'ユーザーを新規作成しました']);
    }

    public function update (Request $request, User $user) {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->save();

        return back()->with('toast', ['success', 'ユーザーを更新しました']);
    }

    public function destroy (Request $request, User $user) {
        $user->delete();

        return back()->with('toast', ['success', 'ユーザーを削除しました']);
    }
}
