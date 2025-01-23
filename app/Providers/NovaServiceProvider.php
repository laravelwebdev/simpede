<?php

namespace App\Providers;

use App\Helpers\Policy;
use App\Models\Pengelola;
use App\Models\User as UserModel;
use App\Nova\AnalisisSakip;
use App\Nova\BastMitra;
use App\Nova\DaftarKegiatan;
use App\Nova\DaftarReminder;
use App\Nova\DaftarSp2d;
use App\Nova\Dashboards\Main;
use App\Nova\Dipa;
use App\Nova\DokumentasiKegiatan;
use App\Nova\DokumentasiLink;
use App\Nova\HargaSatuan;
use App\Nova\HonorKegiatan;
use App\Nova\IzinKeluar;
use App\Nova\KepkaMitra;
use App\Nova\KerangkaAcuan;
use App\Nova\KodeBank;
use App\Nova\KontrakMitra;
use App\Nova\Lenses\PemeliharaanBarang;
use App\Nova\Lenses\RekapBarangPersediaan;
use App\Nova\Lenses\RekapHonorMitra;
use App\Nova\Lenses\RencanaPenarikanDana;
use App\Nova\MasterBarangPemeliharaan;
use App\Nova\MasterPersediaan;
use App\Nova\MasterWilayah;
use App\Nova\Mitra;
use App\Nova\NaskahKeluar;
use App\Nova\NaskahMasuk;
use App\Nova\PembelianPersediaan;
use App\Nova\Pemeliharaan;
use App\Nova\PerjalananDinas;
use App\Nova\PermintaanPersediaan;
use App\Nova\PersediaanKeluar;
use App\Nova\PersediaanMasuk;
use App\Nova\RapatInternal;
use App\Nova\RealisasiAnggaran;
use App\Nova\ResponRate;
use App\Nova\RewardPegawai;
use App\Nova\ShareLink;
use App\Nova\SkTranslok;
use App\Nova\TataNaskah;
use App\Nova\Template;
use App\Nova\UnitKerja;
use App\Nova\User;
use App\Nova\UserEksternal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Laravelwebdev\NovaCalendar\NovaCalendar;
use Laravelwebdev\Updater\Updater;

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
        Copyright &copy;2021 - '.date('Y').' <a href="'.config('satker.website').'" class="text-primary dim no-underline">BPS '.config('satker.kabupaten').'</a>
        </p>
        <p class="mt-8 text-center text-xs text-80"> By Muhlis Abdi <span class="px-1">&middot;</span> Laravel v'.app()->version().'
        </p>'
        );

        Nova::userMenu(function (Request $request, Menu $menu) {
            return $menu
                ->prepend(MenuItem::link('Panduan', 'https://docs.simpede.my.id/')->openInNewTab())
                ->prepend(MenuItem::link('Profil Saya', '/resources/users/'.$request->user()->getKey()));
        });

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('home'),
                MenuSection::make('Kalender', [
                    MenuItem::link(__('Kalender'), NovaCalendar::pathToCalendar('kalender-kegiatan')),
                    MenuItem::resource(DaftarKegiatan::class),
                    MenuItem::resource(DaftarReminder::class),
                ])
                    ->collapsable()
                    ->icon('calendar'),

                MenuSection::make('Monitoring', [
                    MenuItem::lens(RealisasiAnggaran::class, RencanaPenarikanDana::class),
                    MenuItem::link('Realisasi Anggaran', '/resources/realisasi-anggarans/lens/realisasi-anggaran'),
                    MenuItem::lens(MasterPersediaan::class, RekapBarangPersediaan::class),
                    MenuItem::lens(Mitra::class, RekapHonorMitra::class),
                    MenuItem::lens(MasterBarangPemeliharaan::class, PemeliharaanBarang::class)->canSee(fn () => Policy::make()
                        ->allowedFor('admin,anggota,koordinator,kasubbag,bmn,kepala')
                        ->get()),
                ])->icon('chart-bar'),

                MenuSection::make('Manajemen', [
                    MenuItem::resource(HonorKegiatan::class),
                    MenuItem::resource(IzinKeluar::class),
                    MenuItem::resource(KerangkaAcuan::class),
                    MenuItem::resource(Pemeliharaan::class),
                    MenuItem::resource(PerjalananDinas::class),
                    MenuItem::resource(RapatInternal::class),
                ]),
                MenuSection::make('Kontrak Mitra', [
                    MenuItem::resource(KontrakMitra::class),
                    MenuItem::resource(BastMitra::class),
                ])->collapsable()
                    ->icon('clipboard-document-check'),
                MenuSection::make('Naskah Dinas', [
                    MenuItem::resource(NaskahMasuk::class),
                    MenuItem::resource(NaskahKeluar::class),
                ])->collapsable()
                    ->icon('envelope'),
                MenuSection::make('Persediaan', [
                    MenuItem::resource(PembelianPersediaan::class),
                    MenuItem::resource(PersediaanMasuk::class),
                    MenuItem::resource(PermintaanPersediaan::class),
                    MenuItem::resource(PersediaanKeluar::class),
                ])->collapsable()
                    ->icon('archive-box'),

                MenuSection::make('Administrasi', [
                    MenuItem::resource(KodeBank::class),
                    MenuItem::resource(MasterWilayah::class),
                    MenuItem::resource(Template::class),
                    MenuItem::resource(UnitKerja::class),
                ])
                    ->collapsable()
                    ->icon('lock-open'),

                MenuSection::make('Anggaran', [
                    MenuItem::resource(DaftarSp2d::class),
                    MenuItem::resource(Dipa::class),
                ])
                    ->collapsable()
                    ->icon('currency-dollar'),

                MenuSection::make('Dokumentasi', [
                    MenuItem::resource(DokumentasiKegiatan::class),
                    MenuItem::resource(DokumentasiLink::class),
                ])
                    ->collapsable()
                    ->icon('database'),

                MenuSection::make('Kepegawaian', [
                    MenuItem::resource(User::class),
                    MenuItem::resource(RewardPegawai::class),
                ])
                    ->collapsable()
                    ->icon('user-group'),

                MenuSection::make('Referensi', [
                    MenuItem::resource(HargaSatuan::class),
                    MenuItem::resource(KepkaMitra::class),
                    MenuItem::resource(MasterBarangPemeliharaan::class),
                    MenuItem::resource(MasterPersediaan::class),
                    MenuItem::resource(SkTranslok::class),
                    MenuItem::resource(TataNaskah::class),
                    // MenuItem::resource(UserEksternal::class),
                ])
                    ->collapsable()
                    ->icon('book-open'),

                MenuSection::make('SAKIP', [
                    MenuItem::resource(AnalisisSakip::class),
                    MenuItem::resource(ResponRate::class),
                ])
                    ->collapsable()
                    ->icon('document-chart-bar'),

                MenuSection::make('Share', [
                    MenuItem::resource(ShareLink::class),
                ])
                    ->collapsable()
                    ->icon('share'),
            ];
        });
        Nova::withBreadcrumbs();
        Nova::showUnreadCountInNotificationCenter();

        // Modify Login Auth
        Fortify::authenticateUsing(function (Request $request) {
            $user = UserModel::where('email', $request->email)
                ->orWhereRaw('LEFT(email ,LOCATE("@", email) -1) = ?', [$request->email])
                ->first();

            if ($user &&
                Hash::check($request->password, $user->password)) {
                $roles = Pengelola::cache()->get('all')->where('user_id', $user->id)->whereNull('inactive')->pluck('role')->toArray();
                session(['role' => $roles]);
                session(['year' => $request->year]);

                return $user;
            }
        });
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
     * Register the configurations for Laravel Fortify.
     */
    protected function fortify(): void
    {
        Nova::fortify()
            ->features([
                Features::updatePasswords(),
                Features::twoFactorAuthentication(
                    [
                        'confirm' => true,
                        'confirmPassword' => true,
                        'window' => 0,
                    ]
                ),

            ])
            ->register();
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
            new NovaCalendar('kalender-kegiatan'),
            Updater::make()->canSee(fn () => Policy::make()
                ->allowedFor('admin')
                ->get()),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
        Nova::report(function ($exception) {
            if (app()->bound('sentry')) {
                app('sentry')->captureException($exception);
            }
        });
    }
}
