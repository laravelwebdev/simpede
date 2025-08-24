<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Log;

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
        if ($this->app->environment('local')) {
            URL::forceRootUrl(env('APP_URL'));
            URL::forceScheme('https');
        }
        Model::preventLazyLoading();
        Model::handleLazyLoadingViolationUsing(function ($model, $relation) {
            Log::warning(sprintf('N+1 Query detected in %s::%s', get_class($model), $relation));
        });
    }
}
