<?php

namespace App\Providers;

use App\Helpers\Policy;
use App\Nova\BastMitra;
use App\Nova\DaftarSp2d;
use App\Nova\Dashboards\Main;
use App\Nova\Dipa;
use App\Nova\HargaSatuan;
use App\Nova\HonorKegiatan;
use App\Nova\IzinKeluar;
use App\Nova\KepkaMitra;
use App\Nova\KerangkaAcuan;
use App\Nova\KontrakMitra;
use App\Nova\Lenses\PemeliharaanBarang;
use App\Nova\Lenses\RekapBarangPersediaan;
use App\Nova\Lenses\RekapHonorMitra;
use App\Nova\Lenses\RencanaPenarikanDana;
use App\Nova\MasterBarangPemeliharaan;
use App\Nova\MasterPersediaan;
use App\Nova\Mitra;
use App\Nova\NaskahKeluar;
use App\Nova\NaskahMasuk;
use App\Nova\PembelianPersediaan;
use App\Nova\Pemeliharaan;
use App\Nova\PerjalananDinas;
use App\Nova\PermintaanPersediaan;
use App\Nova\PersediaanKeluar;
use App\Nova\PersediaanMasuk;
use App\Nova\RealisasiAnggaran;
use App\Nova\RewardPegawai;
use App\Nova\ShareLink;
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
        </p>
        <p class="mt-8 text-center text-xs text-80">
          Nova v'.Nova::version().'<span class="px-1">&middot;</span> Laravel v'.app()->version().'
        </p>'
        );

        Nova::userMenu(function (Request $request, Menu $menu) {
            return $menu
                ->prepend(MenuItem::link('Profil Saya', '/resources/users/'.$request->user()->getKey()));
        });

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('home'),
                MenuSection::make('Monitoring', [
                    MenuItem::lens(Mitra::class, RekapHonorMitra::class),
                    MenuItem::lens(MasterPersediaan::class, RekapBarangPersediaan::class),
                    MenuItem::lens(MasterBarangPemeliharaan::class, PemeliharaanBarang::class)->canSee(fn () => Policy::make()
                        ->allowedFor('admin,anggota,koordinator,kasubbag,bmn,kepala')
                        ->get()),
                    MenuGroup::make('Anggaran', [
                        MenuItem::link('Realisasi SP2D', '/resources/realisasi-anggarans/lens/realisasi-anggaran'),
                        MenuItem::lens(RealisasiAnggaran::class, RencanaPenarikanDana::class),
                    ])->collapsable(),

                ])->icon('chart-bar'),
                MenuSection::make('Manajemen', [
                    MenuItem::resource(KerangkaAcuan::class),
                    MenuItem::resource(HonorKegiatan::class),
                    MenuItem::resource(IzinKeluar::class),
                    MenuItem::resource(Pemeliharaan::class),
                    MenuItem::resource(PerjalananDinas::class),
                    MenuGroup::make('Kontrak', [
                        MenuItem::resource(KontrakMitra::class),
                        MenuItem::resource(BastMitra::class),
                    ])->collapsable(),
                    MenuGroup::make('Naskah', [
                        MenuItem::resource(NaskahMasuk::class),
                        MenuItem::resource(NaskahKeluar::class),
                    ])->collapsable(),
                    MenuGroup::make('Persediaan', [
                        MenuItem::resource(PembelianPersediaan::class),
                        MenuItem::resource(PersediaanMasuk::class),
                        MenuItem::resource(PermintaanPersediaan::class),
                        MenuItem::resource(PersediaanKeluar::class),
                        MenuItem::resource(RealisasiAnggaran::class),
                    ])->collapsable(),

                ]),
                MenuSection::make('Referensi', [
                    MenuItem::resource(TataNaskah::class),
                    MenuItem::resource(KepkaMitra::class),
                    MenuItem::resource(HargaSatuan::class),
                    MenuItem::resource(MasterPersediaan::class),
                    MenuItem::resource(MasterBarangPemeliharaan::class),

                ])->icon('book-open'),
                MenuSection::make('Kepegawaian', [
                    MenuItem::resource(User::class),
                    MenuItem::resource(RewardPegawai::class),
                ])->icon('user-group'),

                MenuSection::make('Anggaran', [
                    MenuItem::resource(Dipa::class),
                    MenuItem::resource(DaftarSp2d::class),
                ])->icon('currency-dollar'),

                MenuSection::make('Administrasi', [
                    MenuItem::resource(UnitKerja::class),
                    MenuItem::resource(Template::class),

                ])->icon('lock-open'),

                MenuSection::make('Share', [
                    MenuItem::resource(ShareLink::class),
                ])->icon('share'),

                MenuSection::make('Panduan', [
                    MenuItem::externalLink('Panduan Penggunaan', 'https://docs.simpede.my.id/')
                        ->openInNewTab(),
                ])
                    ->icon('light-bulb'),
            ];
        });
        Nova::withBreadcrumbs();
        Nova::showUnreadCountInNotificationCenter();
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
            return true;
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
