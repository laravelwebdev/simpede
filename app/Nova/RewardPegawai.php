<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\ImportRekapPresensi;
use App\Nova\Actions\SetStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

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
                ->displayUsingLabels()
                ->updateRules('required', Rule::unique('reward_pegawais', 'bulan')->where('tahun', session('year'))->ignore($this->id))
                ->creationRules('required', Rule::unique('reward_pegawais', 'bulan')->where('tahun', session('year'))),
            BelongsTo::make('Employee of The Month', 'user', 'App\Nova\User')
                ->exceptOnForms(),
            BelongsTo::make('Nomor SK', 'skNaskahKeluar', 'App\Nova\NaskahKeluar')
                ->exceptOnForms(),
            Status::make('Status')
                ->loadingWhen(['dibuat', 'dinilai', 'diimport'])
                ->failedWhen(['outdated']),
            Panel::make('Arsip', [
                File::make('Arsip Kertas Kerja', 'arsip')
                    ->disk('arsip')
                    ->rules('mimes:pdf')
                    ->acceptedTypes('.pdf')
                    ->hideWhenCreating()
                    ->updateRules('required')
                    ->prunable(),
            ]),
            HasMany::make('Daftar Penilaian', 'daftarPenilaianReward', 'App\Nova\DaftarPenilaianReward'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
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
            $actions[] = ImportRekapPresensi::make()
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
                ->withTanggal('tanggal_penilaian');
        }

        if (Policy::make()->allowedFor('kepala')->get()) {
            $actions[] =
            SetStatus::make()
                ->confirmButtonText('Ubah Status')
                ->confirmText('Setelah ditetapkan, penilaian tidak bisa diubah lagi')
                ->onlyOnDetail()
                ->setName('Tetapkan Pemenang')
                ->setStatus('ditetapka')
                ->withTanggal('tanggal_penetapan')
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }

                    return $this->resource instanceof Model && $this->resource->status === 'dinilai';
                });
        }

        return $actions;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('tahun', session('year'))->orderBy('bulan', 'desc');
    }
}
