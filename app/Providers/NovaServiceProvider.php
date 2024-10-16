<?php

namespace App\Providers;

use App\Helpers\Helper;
use App\Models\Pengelola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

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
        Nova::footer(fn () => '<p class="mt-8 text-center text-xs text-80">
        <a href="https://hulusungaitengahkab.bps.go.id" class="text-primary dim no-underline">BPS Kabupaten Hulu Sungai Tengah</a>
        <span class="px-1">&middot;</span>
        &copy;'.date('Y').' Simpede - By Muhlis Abdi.
        <span class="px-1">&middot;</span>
        v '.Nova::version().'</p>'
        );

        Nova::userMenu(function (Request $request, Menu $menu) {
            $roles = Pengelola::cache()->get('all')->where('user_id', $request->user()->id)->whereNull('inactive')->pluck('role', 'role')->toArray();
            foreach ($roles as $key => $value) {
                $menu->prepend(
                    MenuItem::externalLink(
                        Helper::$role[$key],
                        route('changerole', [
                            'role' => $key,
                        ])
                    )
                );
            }

            return $menu;
        });
        Nova::withBreadcrumbs();
        Nova::showUnreadCountInNotificationCenter();
        Nova::style('custom-fields-css', resource_path('css/app.css'));
        // Nova::withoutGlobalSearch();
        // Nova::withoutNotificationCenter();
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
