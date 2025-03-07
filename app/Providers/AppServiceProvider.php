<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Sentry\Laravel\Facades\Sentry;

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
        Model::handleLazyLoadingViolationUsing(function ($model, $relation) {
            $message = "Lazy loading violation: Attempted to access [{$relation}] on model [".get_class($model).'].';

            // Report to Sentry
            Sentry::captureMessage($message);
        });
    }
}
