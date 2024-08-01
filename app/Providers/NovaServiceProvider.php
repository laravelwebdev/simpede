<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Visanduma\NovaBackNavigation\NovaBackNavigation;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::withBreadcrumbs();
        Nova::footer(fn () => 
        '<p class="mt-8 text-center text-xs text-80">
        <a href="https://hulusungaitengahkab.bps.go.id" class="text-primary dim no-underline">BPS Kabupaten Hulu Sungai Tengah</a>
        <span class="px-1">&middot;</span>
        &copy;'. date("Y").' Simpede - By Muhlis Abdi.
        <span class="px-1">&middot;</span>
        v '.Nova::version().'</p>'
    );
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes(default: true)
                // ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new NovaBackNavigation(),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //  Nova::initialPath('/resources/users');
    }
}
