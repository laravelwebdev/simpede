<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\ImportDaftarSP2DMyIntress;
use App\Nova\Actions\ImportRealisasiAnggaran;
use App\Nova\Actions\ImportTargetKkp;
use App\Nova\Actions\ImportTargetSerapan;
use App\Nova\Actions\SinkronisasiDataAnggaran;
use App\Nova\Filters\FilterTahunDipa;
use App\Nova\Metrics\HelperSinkronisasiAnggaran;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Tabs\Tab;

class Dipa extends Resource
{
    public static function label()
    {
        return 'DIPA';
    }

    public static $with = ['mataAnggaran', 'jenisBelanja', 'targetKkp', 'uangPersediaan'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Dipa>
     */
    public static $model = \App\Models\Dipa::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nomor';

    public function subtitle()
    {
        return 'Tahun: '.$this->tahun;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nomor', 'tahun',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Tahun', 'tahun')
                ->sortable()
                ->searchable()
                ->rules('required')
                ->options(Helper::setOptionTahunDipa())
                ->creationRules('unique:dipas,tahun')
                ->updateRules('unique:dipas,tahun,{{resourceId}}'),
            Text::make('Nomor', 'nomor')
                ->sortable()
                ->rules('required', 'max:40'),
            Date::make('Tanggal DIPA', 'tanggal')
                ->sortable()
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->rules('required'),
            Number::make('Revisi Ke', 'revisi')
                ->exceptOnForms(),
            Date::make('Tanggal Revisi', 'tanggal_revisi')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->exceptOnForms(),
            Date::make('Tanggal Data realisasi', 'tanggal_realisasi')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->exceptOnForms(),
            Date::make('Tanggal Nihil', 'tanggal_nihil')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->rules('required', 'date', function ($attribute, $value, $fail) {
                    $bulan = date('m', strtotime($value));
                    $tahun = date('Y', strtotime($value));
                    $sessionYear = session('year');
                    if ($bulan != '12' || ($tahun != $sessionYear && $tahun != ($sessionYear + 1))) {
                        $fail('Tanggal Nihil harus di bulan Desember tahun '.$sessionYear.' atau '.($sessionYear + 1).'.');
                    }
                }),
            Tab::group('Anggaran dan Target Serapan', [
                HasMany::make('Mata Anggaran'),
                HasMany::make('Jenis Belanja'),
                HasMany::make('Target Penggunaan KKP', 'targetKkp', TargetKkp::class),
            ]),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        $cards = [];
        if (Policy::make()->allowedFor('admin')->get()) {
            $cards[] =
            HelperSinkronisasiAnggaran::make()
                ->width('full');
        }

        return $cards;
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            FilterTahunDipa::make('tahun'),
        ];
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
        if (Policy::make()->allowedFor('admin,ppk')->get()) {
            $actions[] =
                SinkronisasiDataAnggaran::make()
                    ->showInline()
                    ->showOnDetail()
                    ->exceptOnIndex();
        }
        if (Policy::make()->allowedFor('admin,kpa,ppk,ppspm')->get()) {
            $actions[] =
                ImportRealisasiAnggaran::make()
                    ->showInline()
                    ->showOnDetail()
                    ->exceptOnIndex();
        }
        if (Policy::make()->allowedFor('admin,kpa,ppk,ppspm')->get()) {
            $actions[] =
                ImportDaftarSP2DMyIntress::make()
                    ->showInline()
                    ->showOnDetail()
                    ->exceptOnIndex();
        }
        if (Policy::make()->allowedFor('admin,kpa,ppk,ppspm')->get()) {
            $actions[] =
                ImportTargetSerapan::make()
                    ->showInline()
                    ->showOnDetail()
                    ->exceptOnIndex();
        }
        if (Policy::make()->allowedFor('admin,kpa,ppk,ppspm')->get()) {
            $actions[] =
                ImportTargetKkp::make()
                    ->showInline()
                    ->showOnDetail()
                    ->exceptOnIndex();
        }

        return $actions;
    }
}
