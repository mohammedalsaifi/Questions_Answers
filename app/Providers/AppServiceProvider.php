<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

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
        Validator::extend('filter', function ($attribute, $value){
            $black = ['god', 'sex'];
            foreach ($black as $word){
                if (stripos($value, $word) !== false){
                    return false;
                }
                return true;
            }
        }, 'This Word Is Not Allowed');
        Paginator::useBootstrap();
    }
}
