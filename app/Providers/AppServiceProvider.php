<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        if (app()->environment('testing')) {
            $compiledPath = sys_get_temp_dir().DIRECTORY_SEPARATOR.'laravel-testing-views-'.Str::slug(base_path(), '-');

            if (! is_dir($compiledPath)) {
                mkdir($compiledPath, 0777, true);
            }

            config(['view.compiled' => $compiledPath]);
        }
    }
}
