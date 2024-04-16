<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index (Request $request) {
        $users = $request->user()->client->users;
        $roles = $request->user()->client->roles;
        $companies = $request->user()->client->companies;
        return view('pages.management.users', [
            'users' => $users,
            'roles' => $roles,
            'companies' => $companies,
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
        
        $user->companies()->sync($request->company_id_list);

        return back()->with('toast', ['success', 'ユーザーを新規作成しました']);
    }

    public function update (Request $request, User $user) {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->save();

        $user->companies()->sync($request->company_id_list);

        return back()->with('toast', ['success', 'ユーザーを更新しました']);
    }

    public function destroy (Request $request, User $user) {
        $user->companies()->detach();
        $user->delete();

        return back()->with('toast', ['success', 'ユーザーを削除しました']);
    }
}
