<?php

namespace App\Providers;

use App\Libs\MyUtil;
use App\Models\BigGroup;
use App\Models\Term;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('MyUtil', MyUtil::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('big_groups')) {
            $big_groups = BigGroup::all();
            view()->share('big_groups', $big_groups);
        }
    }
}
