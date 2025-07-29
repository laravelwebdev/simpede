<?php

namespace App\Providers;

use App\Nova\Dipa;
use App\Nova\User;
use App\Nova\Mitra;
use App\Nova\KodeBank;
use App\Nova\Template;
use Laravel\Nova\Nova;
use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\BastMitra;
use App\Nova\ShareLink;
use App\Nova\UnitKerja;
use App\Nova\DaftarSp2d;
use App\Nova\IzinKeluar;
use App\Nova\KepkaMitra;
use App\Nova\LimitPulsa;
use App\Nova\SkTranslok;
use App\Nova\TataNaskah;
use App\Models\Pengelola;
use App\Nova\HargaSatuan;
use App\Nova\NaskahMasuk;
use App\Nova\KontrakMitra;
use App\Nova\NaskahKeluar;
use App\Nova\Pemeliharaan;
use App\Nova\TindakLanjut;
use App\Nova\AnalisisSakip;
use App\Nova\HonorKegiatan;
use App\Nova\KerangkaAcuan;
use App\Nova\MasterWilayah;
use App\Nova\PulsaKegiatan;
use App\Nova\RapatInternal;
use App\Nova\RewardPegawai;
use App\Nova\UserEksternal;
use Laravel\Nova\Menu\Menu;
use App\Models\MataAnggaran;
use App\Nova\DaftarKegiatan;
use App\Nova\DaftarReminder;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Nova\Dashboards\Main;
use App\Nova\DokumentasiLink;
use App\Nova\PerjalananDinas;
use App\Nova\PersediaanMasuk;
use Laravel\Fortify\Features;
use App\Nova\MasterPersediaan;
use App\Nova\PersediaanKeluar;
use App\Nova\RealisasiKinerja;
use App\Nova\PerjanjianKinerja;
use App\Nova\RealisasiAnggaran;
use Laravel\Nova\Menu\MenuItem;
use App\Models\User as UserModel;
use App\Nova\DokumentasiKegiatan;
use App\Nova\PembelianPersediaan;
use App\Nova\PermintaanPersediaan;
use Laravel\Nova\Menu\MenuSection;
use Laravelwebdev\Updater\Updater;
use App\Nova\Lenses\FormRencanaAksi;
use App\Nova\Lenses\RekapHonorMitra;
use App\Nova\Lenses\RekapPulsaMitra;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Nova\Dashboards\SystemHealth;
use App\Nova\Lenses\MatchingAnggaran;
use App\Nova\MasterBarangPemeliharaan;
use Illuminate\Support\Facades\Cookie;
use App\Nova\Lenses\PemeliharaanBarang;
use App\Nova\Lenses\RencanaPenarikanDana;
use App\Nova\Lenses\RekapBarangPersediaan;
use Laravelwebdev\NovaCalendar\NovaCalendar;
use Laravel\Nova\NovaApplicationServiceProvider;
use App\Nova\MataAnggaran as MataAnggaranResource;

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
        Sistem Integrasi Pekerjaan dan Dokumentasi secara Elektronik <span class="px-1">&middot;</span> v.'.Helper::version().'
        </p>
        <p class="mt-8 text-center text-xs text-80">  Copyright &copy;2021 - '.date('Y').' <a href="'.config('satker.website').'" class="text-primary dim no-underline">BPS '.config('satker.kabupaten').'</a> 
        </p>'
        );

        Nova::userMenu(function (Request $request, Menu $menu) {
            return $menu
                ->prepend(MenuItem::link('Profil Saya', '/resources/users/'.$request->user()->getKey()))
                ->prepend(MenuItem::externalLink('Panduan', 'https://docs.simpede.my.id/')->openInNewTab())
                ->prepend(MenuItem::dashboard(SystemHealth::class)->canSee(fn () => Policy::make()
                    ->allowedFor('admin')
                    ->get())
                );
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
                    Menuitem::lens(PerjanjianKinerja::class, FormRencanaAksi::class),
                    MenuItem::lens(RealisasiAnggaran::class, RencanaPenarikanDana::class),
                    MenuItem::link('Realisasi Anggaran', '/resources/realisasi-anggarans/lens/realisasi-anggaran'),
                    MenuItem::lens(MasterPersediaan::class, RekapBarangPersediaan::class),
                    MenuItem::lens(Mitra::class, RekapHonorMitra::class),
                    MenuItem::lens(Mitra::class, RekapPulsaMitra::class),
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
                    MenuItem::resource(PulsaKegiatan::class),
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
                    MenuItem::lens(MataAnggaranResource::class, MatchingAnggaran::class)
                        ->withBadgeIf(fn () => '!', 'danger', fn () => MataAnggaran::where('is_manual', true)->count('id') > 0),
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
                    MenuItem::resource(LimitPulsa::class),
                    MenuItem::resource(PerjanjianKinerja::class),
                    MenuItem::resource(SkTranslok::class),
                    MenuItem::resource(TataNaskah::class),
                    // MenuItem::resource(UserEksternal::class),
                ])
                    ->collapsable()
                    ->icon('book-open'),

                MenuSection::make('SAKIP', [
                    MenuItem::resource(RealisasiKinerja::class),
                    MenuItem::resource(AnalisisSakip::class),
                    MenuItem::resource(TindakLanjut::class),
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
                if ($request->remember) {
                    Cookie::queue('simpede_year', $request->year, 576000); // Cookie berlaku selama 400 hari
                }

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
            return Pengelola::where('user_id', $user->id)
                ->where('role', 'anggota')
                ->where(function ($query) {
                    $query->whereNull('inactive')
                        ->orWhere('inactive', '>=', now());
                })
                ->exists();
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
            Main::make(),
            SystemHealth::make()
                ->showRefreshButton()->canSee(fn () => Policy::make()
                ->allowedFor('admin')
                ->get()),
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
