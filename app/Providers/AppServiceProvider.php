<?php

namespace App\Providers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
            // URL::forceScheme('https');
        }
        Model::preventLazyLoading();
        Model::handleLazyLoadingViolationUsing(function ($model, $relation) {

            $url = Request::fullUrl(); // URL lengkap yang sedang diakses

            Log::warning(sprintf(
                'N+1 Query detected. URL: %s | Model: %s::%s',
                $url,
                get_class($model),
                $relation
            ));
        });
    }
}
