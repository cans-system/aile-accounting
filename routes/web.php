<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\MasterCompanyController;
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

Route::middleware(['auth'])->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/{user}', function () {
            return 'user';
        });
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/', function () {
        return redirect('/home');
    });
    
    Route::get('/home', function () {
        return view('pages.home');
    });

    Route::prefix('master')->group(function () {
        Route::resource('master', MasterCompanyController::class);
    });

    Route::prefix('admin')->group(function () {
        Route::resource('users', AdminUserController::class)->only([
            'index', 'store', 'update', 'destroy'
        ]);
    });
});

