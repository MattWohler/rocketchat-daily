<?php

namespace App\Providers;

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
        $this->app->singleton(\RocketChat\User::class, function() {
            return tap(new \RocketChat\User(env('RC_LOGIN_EMAIL'), env('RC_LOGIN_PASSWORD')))->login(true);
        });
    }
}
