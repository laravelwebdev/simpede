<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\JenisKontrak;
use App\Nova\Actions\GenerateKontrakMitra;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class KontrakMitra extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\KontrakMitra>
     */
    public static $model = \App\Models\KontrakMitra::class;

    public static $with = ['daftarKontrakMitra'];

    public static function label()
    {
        return 'Kontrak Mitra';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nama_kontrak';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nama_kontrak', 'bulan', 'jenis_kontrak', 'jenis_honor',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Jenis Kontrak/Honor', 'jenis_honor')
                ->readonly(),
            Text::make('Nama Kontrak', 'nama_kontrak')
                ->readonly(),
            Text::make('Bulan Kontrak', 'bulan')
                ->readonly()
                ->exceptOnForms()
                ->displayUsing(fn ($bulan) => $bulan ? Helper::$bulan[$bulan] : null),
            Text::make('Jenis Kegiatan', 'jenis_kontrak')
                ->readonly()
                ->exceptOnForms()
                ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(JenisKontrak::cache()->get('all')->where('id', $kode)->first(), 'jenis')),
            Date::make('Tanggal SPK', 'tanggal_spk')
                ->rules('required', 'before_or_equal:today')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                }),
            Date::make('Tanggal Mulai Pelaksanaan Kontrak', 'awal_kontrak')
                ->rules('required', 'after_or_equal:tanggal_spk')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                })->hideFromIndex(),
            Date::make('Tanggal Selesai Kontrak', 'akhir_kontrak')
                ->rules('required', 'after_or_equal:awal')->displayUsing(function ($tanggal) {
                    return Helper::terbilangTanggal($tanggal);
                })->hideFromIndex(),
            Select::make('Pejabat Pembuat Komitmen', 'ppk_user_id')
                ->rules('required')
                ->searchable()
                ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                ->dependsOn('tanggal_spk', function (Select $field, NovaRequest $request, FormData $formData) {
                    $field->options(Helper::setOptionPengelola('ppk', Helper::createDateFromString($formData->tanggal_spk)));
                }),
            Status::make('Status', 'status')
                ->loadingWhen(['dibuat'])
                ->failedWhen(['outdated'])
                ->onlyOnIndex(),
            HasMany::make('Daftar Kontrak Mitra'),
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
        if (Policy::make()->allowedFor('all')->get()) {
            $actions[] =
            GenerateKontrakMitra::make()
                ->showInline()
                ->showOnDetail()
                ->confirmButtonText('Generate')
                ->exceptOnIndex();
        }

        return $actions;
    }
}
