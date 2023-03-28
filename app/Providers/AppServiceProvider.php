<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Set Locale time to asia/jakarta
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set(env('LOCALE_TIMEZONE'));

        Paginator::useBootstrapFive();

        //* Menggunakan Gate untuk membatasi otorisasi user
        Gate::define('admin', function(User $user) {
            //* sama arti tapi beda penulisan.
            // return $user->is_admin == true;
            return $user->is_admin;
        });
    }
}
