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
    }}
