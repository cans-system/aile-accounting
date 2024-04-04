<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::view('/login', 'pages.login')->name('login');
    
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', function () {
    return view('pages.home');
});
