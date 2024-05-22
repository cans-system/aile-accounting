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
use App\Http\Controllers\DetailController;
use App\Http\Controllers\DisclosedAccountListController;
use App\Http\Controllers\DisclosedBusinessListController;
use App\Http\Controllers\JournalCategoryController;
use App\Http\Controllers\JournalSubcategoryController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScopeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TermController;
use Illuminate\Support\Facades\Route;

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
        Route::put('{statement}', [RecordController::class, 'sync']);
    });

    # master
    Route::apiResource('clients.terms', TermController::class)->shallow()->except(['show']);
    Route::apiResource('clients.companies', CompanyController::class)->shallow()->except(['show']);
    Route::apiResource('clients.scopes', ScopeController::class)->shallow()->except(['show']);
    Route::apiResource('clients.categories', CategoryController::class)->shallow()->except(['show']);
    Route::apiResource('clients.accounts', AccountController::class)->shallow()->except(['show']);
    Route::apiResource('clients.disclosed_account_lists', DisclosedAccountListController::class)->shallow()->except(['show']);
    Route::apiResource('clients.currencies', CurrencyController::class)->shallow()->except(['show']);
    Route::apiResource('clients.rates', RateController::class)->shallow()->except(['show']);
    Route::apiResource('clients.businesses', BusinessController::class)->shallow()->except(['show']);
    Route::apiResource('clients.disclosed_business_lists', DisclosedBusinessListController::class)->shallow()->except(['show']);
    Route::apiResource('clients.journal_categories', JournalCategoryController::class)->shallow()->except(['show']);
    Route::apiResource('clients.journal_subcategories', JournalSubcategoryController::class)->shallow()->except(['show']);
    
    # package
    Route::apiResource('clients.{statement}', RecordController::class)->except(['show'])
    ->whereIn('statement', array_map(fn ($case) => $case->value, Statement::cases()));
    Route::apiResource('records', RecordController::class)->only(['update', 'destroy']);
    
    # journal
    Route::get('details_edit', [DetailController::class, 'edit']);
    Route::apiResource('clients.details', RecordController::class)->shallow()->except(['show']);
    Route::get('balance', [DetailController::class, 'balance']);
    
    # managemant
    Route::apiResource('clients.users', UserController::class)->shallow()->except(['show']);
    Route::apiResource('clients.roles', RoleController::class)->shallow()->except(['show']);

    # admin    
    Route::prefix('admin')->group(function () {
        Route::apiResource('clients', ClientController::class)->shallow()->except(['show']);

        Route::post('/change_support_login_client', [SessionController::class, 'change_support_login_client']);
    });
});

