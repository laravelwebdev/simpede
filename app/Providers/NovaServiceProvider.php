<?php

namespace App\Providers;

use App\Helpers\Helper;
use App\Models\Pengelola;
use App\Nova\BastMitra;
use App\Nova\DaftarHonorMitra;
use App\Nova\Dashboards\Main;
use App\Nova\Dipa;
use App\Nova\HargaSatuan;
use App\Nova\HonorKegiatan;
use App\Nova\IzinKeluar;
use App\Nova\KepkaMitra;
use App\Nova\KerangkaAcuan;
use App\Nova\KontrakMitra;
use App\Nova\Lenses\RekapHonorMitra;
use App\Nova\NaskahKeluar;
use App\Nova\NaskahMasuk;
use App\Nova\TataNaskah;
use App\Nova\Template;
use App\Nova\UnitKerja;
use App\Nova\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\Menu\MenuGroup;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
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

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('user'),
                MenuSection::make('Monitoring', [
                    MenuItem::lens(DaftarHonorMitra::class, RekapHonorMitra::class),
                ])->icon('chart-bar'),
                MenuSection::make(session('year'), [
                    MenuGroup::make('Kerangka Acuan', [
                        MenuItem::resource(KerangkaAcuan::class),
                    ])->collapsable(),
                    MenuGroup::make('Kegiatan', [
                        MenuItem::resource(HonorKegiatan::class),
                    ])->collapsable(),
                    MenuGroup::make('Izin Keluar', [
                        MenuItem::resource(IzinKeluar::class),
                    ])->collapsable(),
                    MenuGroup::make('Kontrak', [
                        MenuItem::resource(KontrakMitra::class),
                        MenuItem::resource(BastMitra::class),
                    ])->collapsable(),
                    MenuGroup::make('Naskah', [
                        MenuItem::resource(NaskahMasuk::class),
                        MenuItem::resource(NaskahKeluar::class),
                    ])->collapsable(),

                ]),
                MenuSection::make('Referensi', [
                    MenuItem::resource(Dipa::class),
                    MenuItem::resource(TataNaskah::class),
                    MenuItem::resource(KepkaMitra::class),
                    MenuItem::resource(User::class),
                    MenuItem::resource(HargaSatuan::class),

                ])->icon('book-open'),
                MenuSection::make('Administrasi', [
                    MenuItem::resource(UnitKerja::class),
                    MenuItem::resource(Template::class),

                ])->icon('lock-open'),
            ];
        });
        Nova::withBreadcrumbs();
        Nova::showUnreadCountInNotificationCenter();
        // Nova::style('custom-fields-css', resource_path('css/app.css'));
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
