<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index (Request $request) {
        $users = DB::table('users')
        ->where('client_id', $request->user()->client)
        ->get();
        
        return view('pages.admin.users');
    }
}
