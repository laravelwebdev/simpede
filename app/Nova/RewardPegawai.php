<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\Download;
use App\Nova\Actions\ImportRekapPresensi;
use App\Nova\Actions\SetStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravelwebdev\Filepond\Filepond;
use Laravelwebdev\Greeter\Greeter;

class RewardPegawai extends Resource
{
    public static $with = ['user', 'skNaskahKeluar', 'sertifikatNaskahKeluar', 'daftarPenilaianReward'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\RewardPegawai>
     */
    public static $model = \App\Models\RewardPegawai::class;

    public static function label()
    {
        return 'Reward Pegawai';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return Helper::$bulan[$this->bulan].' '.$this->tahun;
    }

    public function subtitle()
    {
        return $this->user->name;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'user.name', 'bulan', 'tahun',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Bulan')
                ->options(Helper::$bulan)
                ->searchable()
                ->filterable()
                ->readonly(fn () => $this->status === 'ditetapkan')
                ->displayUsingLabels()
                ->updateRules('required', Rule::unique('reward_pegawais', 'bulan')->where('tahun', session('year'))->ignore($this->id))
                ->creationRules('required', Rule::unique('reward_pegawais', 'bulan')->where('tahun', session('year'))),
            BelongsTo::make('Employee of The Month', 'user', \App\Nova\User::class)
                ->exceptOnForms(),
            BelongsTo::make('Nomor SK', 'skNaskahKeluar', \App\Nova\NaskahKeluar::class)
                ->exceptOnForms(),
            Status::make('Status')
                ->loadingWhen(['dibuat', 'dinilai', 'diimport'])
                ->failedWhen(['outdated']),
            Panel::make('Arsip', [
                Filepond::make('Arsip Kertas Kerja', 'arsip_kertas_kerja')
                    ->disk('arsip')
                    ->disableCredits()
                    ->mimesTypes(['application/pdf'])
                    ->hideWhenCreating()
                    ->onlyOnForms()
                    ->updateRules('required')
                    ->path(session('year').'/'.static::uriKey())
                    ->dependsOn(
                        ['bulan'],
                        function (Filepond $field, NovaRequest $request, FormData $formData) {
                            $field->storeAs(function (Request $request) use ($formData) {
                                $originalName = 'Kertas_Kerja_'.Helper::$bulan[$formData->bulan];
                                $extension = $request->arsip_kertas_kerja->getClientOriginalExtension();

                                return $originalName.'_'.uniqid().'.'.$extension;
                            });
                        }
                    )
                    ->canSee(fn () => Policy::make()->allowedFor('arsiparis,kasubbag')->get())
                    ->prunable()
                    ->hideWhenCreating(),
                $this->arsip_kertas_kerja ?
                URL::make('Kertas Kerja', fn () => Storage::disk('arsip')
                    ->url($this->arsip_kertas_kerja))
                    ->displayUsing(fn () => 'Lihat')->exceptOnForms()
                    :
                Text::make('Kertas Kerja', fn () => null)->exceptOnForms(),
                Filepond::make('Arsip SK', 'arsip_sk')
                    ->disk('arsip')
                    ->disableCredits()
                    ->mimesTypes(['application/pdf'])
                    ->hideWhenCreating()
                    ->onlyOnForms()
                    ->updateRules('required')
                    ->path(session('year').'/'.static::uriKey())
                    ->dependsOn(
                        ['bulan'],
                        function (Filepond $field, NovaRequest $request, FormData $formData) {
                            $field->storeAs(function (Request $request) use ($formData) {
                                $originalName = 'SK_'.Helper::$bulan[$formData->bulan];
                                $extension = $request->arsip_sk->getClientOriginalExtension();

                                return $originalName.'_'.uniqid().'.'.$extension;
                            });
                        }
                    )
                    ->canSee(fn () => Policy::make()->allowedFor('arsiparis,kasubbag')->get())
                    ->prunable()
                    ->hideWhenCreating(),
                $this->arsip_sk ?
                URL::make('SK', fn () => Storage::disk('arsip')
                    ->url($this->arsip_sk))
                    ->displayUsing(fn () => 'Lihat')->exceptOnForms()
                    :
                Text::make('SK', fn () => null)->exceptOnForms(),
                Filepond::make('Arsip Sertifikat', 'arsip_sertifikat')
                    ->disk('arsip')
                    ->disableCredits()
                    ->mimesTypes(['application/pdf'])
                    ->hideWhenCreating()
                    ->onlyOnForms()
                    ->updateRules('required')
                    ->path(session('year').'/'.static::uriKey())
                    ->dependsOn(
                        ['bulan'],
                        function (Filepond $field, NovaRequest $request, FormData $formData) {
                            $field->storeAs(function (Request $request) use ($formData) {
                                $originalName = 'Sertifikat_'.Helper::$bulan[$formData->bulan];
                                $extension = $request->arsip_sertifikat->getClientOriginalExtension();

                                return $originalName.'_'.uniqid().'.'.$extension;
                            });
                        }
                    )
                    ->canSee(fn () => Policy::make()->allowedFor('arsiparis,kasubbag')->get())
                    ->prunable()
                    ->hideWhenCreating(),
                $this->arsip_sertifikat ?
                URL::make('Sertifikat', fn () => Storage::disk('arsip')
                    ->url($this->arsip_sertifikat))
                    ->displayUsing(fn () => 'Lihat')->exceptOnForms()
                    :
                Text::make('Sertifikat', fn () => null)->exceptOnForms(),
            ]),
            HasMany::make('Daftar Penilaian', 'daftarPenilaianReward', \App\Nova\DaftarPenilaianReward::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            Greeter::make()
                ->user('Bobot: 60%')
                ->message(text: 'Skor Kinerja')
                ->avatar(url: Storage::disk('images')->url('trophy.svg'))
                ->verified(text: 'Dihitung dari Nilai SKP Bulanan')
                ->width('1/3'),
            Greeter::make()
                ->user('Bobot: 20%')
                ->message(text: 'Skor Kedisiplinan')
                ->avatar(url: Storage::disk('images')->url('clock.svg'))
                ->verified(text: 'Dihitung dari ketepatan waktu melakukan presensi')
                ->width('1/3'),
            Greeter::make()
                ->user('Bobot: 20%')
                ->message(text: 'Skor Beban Kerja')
                ->avatar(url: Storage::disk('images')->url('beban.svg'))
                ->verified(text: 'Dihitung dari butir jumlah SKP bulanan')
                ->width('1/3'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        $actions = [];
        if (Policy::make()->allowedFor('kasubbag')->get()) {
            $actions[] =
            ImportRekapPresensi::make()
                ->confirmButtonText('Import')
                ->showInline()
                ->exceptOnIndex();
            $actions[] =
            SetStatus::make()
                ->confirmButtonText('Ubah Status')
                ->confirmText('Pastikan seluruh pegawai telah lengkap diinput penilaiannya')
                ->onlyOnDetail()
                ->setName('Finalkan Penilaian')
                ->setStatus('dinilai')
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }

                    return $this->resource instanceof Model && ($this->resource->status === 'diimport' || $this->resource->status === 'dinilai');
                });
        }
        if (Policy::make()->allowedFor('kepala')->get()) {
            $actions[] =
            SetStatus::make()
                ->confirmButtonText('Ubah Status')
                ->confirmText('Setelah ditetapkan, penilaian tidak bisa diubah lagi')
                ->onlyOnDetail()
                ->setName('Tetapkan Pemenang')
                ->setStatus('ditetapkan')
                ->withUser('user_id', $this->model()->id)
                ->withTanggal('tanggal_penetapan')
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }

                    return $this->resource instanceof Model && ($this->resource->status === 'dinilai' || $this->resource->status === 'ditetapkan');
                });
        }
        if (Policy::make()->allowedFor('kasubbag,kepala')->get()) {
            $actions[] =
            Download::make('kertas_kerja_reward', 'Unduh Kertas Kerja')
                ->showInline()
                ->showOnDetail()
                ->confirmButtonText('Unduh')
                ->exceptOnIndex()
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }

                    return $this->resource instanceof Model && $this->resource->status === 'ditetapkan';
                });
            $actions[] =
            Download::make('sk_reward', 'Unduh SK')
                ->showInline()
                ->showOnDetail()
                ->confirmButtonText('Unduh')
                ->exceptOnIndex()
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }

                    return $this->resource instanceof Model && $this->resource->status === 'ditetapkan';
                });
            $actions[] =
            Download::make('sertifikat_reward', 'Unduh Sertifikat')
                ->showInline()
                ->showOnDetail()
                ->confirmButtonText('Unduh')
                ->exceptOnIndex()
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }

                    return $this->resource instanceof Model && $this->resource->status === 'ditetapkan';
                });
        }

        return $actions;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('tahun', session('year'))->orderBy('bulan', 'desc');
    }
}
