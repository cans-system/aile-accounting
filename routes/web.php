<?php

use App\Enums\Statement;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DisclosedAccountListController;
use App\Http\Controllers\DisclosedBusinessListController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScopeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TermController;
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
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/change_term', [SessionController::class, 'change_term']);

    Route::get('/', function () {
        return redirect('/home');
    });
    
    Route::get('/home', function () {
        return view('pages.home');
    });

    Route::prefix('clients/{client}')->group(function () {

        # master
        Route::resource('terms', TermController::class)->only(['index', 'store']);
        Route::resource('companies', CompanyController::class)->only(['index', 'store']);
        Route::resource('scopes', ScopeController::class)->only(['index', 'store']);
        Route::resource('categories', CategoryController::class)->only(['index', 'store']);
        Route::resource('accounts', AccountController::class)->only(['index', 'store']);
        Route::resource('disclosed_account_lists', DisclosedAccountListController::class)->only(['index', 'store']);
        Route::resource('currencies', CurrencyController::class)->only(['index', 'store']);
        Route::resource('rates', RateController::class)->only(['index', 'store']);
        Route::resource('businesses', BusinessController::class)->only(['index', 'store']);
        Route::resource('disclosed_business_lists', DisclosedBusinessListController::class)->only(['index', 'store']);

        # package
        Route::resource('{statement}', RecordController::class)->only(['index', 'store'])
        ->whereIn('statement', array_map(fn ($case) => $case->value, Statement::cases()));
        Route::put('{statement}', [RecordController::class, 'sync']);

        # managemant
        Route::resource('users', UserController::class)->only(['index', 'store']);
        Route::resource('roles', RoleController::class)->only(['index', 'store']);
    });

    # master
    Route::resource('terms', TermController::class)->only(['update', 'destroy']);
    Route::resource('companies', CompanyController::class)->only(['update', 'destroy']);
    Route::resource('scopes', ScopeController::class)->only(['update', 'destroy']);
    Route::resource('categories', CategoryController::class)->only(['update', 'destroy']);
    Route::resource('accounts', AccountController::class)->only(['update', 'destroy']);
    Route::resource('disclosed_account_lists', DisclosedAccountListController::class)->only(['update', 'destroy']);
    Route::resource('currencies', CurrencyController::class)->only(['update', 'destroy']);
    Route::resource('rates', RateController::class)->only(['update', 'destroy']);
    Route::resource('businesses', BusinessController::class)->only(['update', 'destroy']);
    Route::resource('disclosed_business_lists', DisclosedBusinessListController::class)->only(['update', 'destroy']);

    # package
    Route::resource('records', RecordController::class)->only(['update', 'destroy']);

    # management
    Route::resource('users', UserController::class)->only(['update', 'destroy']);
    Route::resource('roles', RoleController::class)->only(['update', 'destroy']);

    Route::prefix('admin')->group(function () {
        Route::resource('clients', ClientController::class)->only(['index', 'store', 'update', 'destroy']);

        Route::post('/change_support_login_client', [SessionController::class, 'change_support_login_client']);
    });
});

