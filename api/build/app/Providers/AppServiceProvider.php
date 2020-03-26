<?php

namespace Docuco\Providers;

use Illuminate\Cache\NullStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
    public function boot()
    {
        Cache::extend('none', function ($app) {
            return Cache::repository(new NullStore());
        });
    }

  /**
   * Register any application services.
   *
   * @return void
   */
    public function register()
    {
      //
    }
}
