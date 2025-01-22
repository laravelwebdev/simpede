<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\BastMitra as ModelsBastMitra;
use App\Models\KodeArsip;
use App\Models\KontrakMitra;
use App\Models\NaskahDefault;
use App\Nova\Actions\GenerateBastMitra;
use App\Nova\Filters\StatusFilter;
use App\Nova\Metrics\MetricPartition;
use App\Nova\Metrics\MetricValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravelwebdev\Filepond\Filepond;

class BastMitra extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\BastMitra>
     */
    public static $model = \App\Models\BastMitra::class;

    public static $with = ['kontrakMitra', 'daftarKontrakMitra', 'ppk'];

    public static function label()
    {
        return 'BAST Mitra';
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $kontrakMitraIds = KontrakMitra::where('tahun', session('year'))->get()->pluck('id');

        return $query->whereIn('kontrak_mitra_id', $kontrakMitraIds);
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'kontrakMitra.nama_kontrak';

    public function subtitle()
    {
        return 'Tanggal BAST: '.Helper::terbilangTanggal($this->tanggal_bast);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kontrakMitra.nama_kontrak',
        'status',
        'tanggal_bast',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $akhir = $this->kontrakMitra ? $this->kontrakMitra->akhir_kontrak : 'today';

        return [
            Panel::make('Keterangan BAST', [
                BelongsTo::make('Kontrak Mitra')
                    ->onlyOnIndex(),
                Date::make('Tanggal BAST', 'tanggal_bast')
                    ->displayUsing(function ($tanggal) {
                        return Helper::terbilangTanggal($tanggal);
                    })
                    ->sortable()
                    ->readonly(! Policy::make()->allowedFor('ppk')->get())
                    ->filterable()
                    ->rules('required', 'before_or_equal:today', 'after_or_equal:'.$akhir),
                Select::make('Klasifikasi Arsip', 'kode_arsip_id')
                    ->searchable()
                    ->hideFromIndex()
                    ->readonly(! Policy::make()->allowedFor('ppk')->get())
                    ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(KodeArsip::cache()->get('all')->where('id', $kode)->first(), 'kode'))
                    ->dependsOn(['tanggal_bast'], function (Select $field, NovaRequest $request, FormData $formData) {
                        $default_naskah = NaskahDefault::cache()
                            ->get('all')
                            ->where('jenis', 'bast')
                            ->first();
                        $field->rules('required')
                            ->options(Helper::setOptionsKodeArsip($formData->tanggal_bast, Helper::getPropertyFromCollection($default_naskah, 'kode_arsip_id')));
                    }),
                Select::make('Pejabat Pembuat Komitmen', 'ppk_user_id')
                    ->rules('required')
                    ->searchable()
                    ->readonly(! Policy::make()->allowedFor('ppk')->get())
                    ->onlyOnForms()
                    ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                    ->dependsOn('tanggal_bast', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('ppk', Helper::createDateFromString($formData->tanggal_bast)))
                            ->default(Helper::setDefaultPengelola('ppk', Helper::createDateFromString($formData->tanggal_bast)));
                    }),
                BelongsTo::make('Pejabat Pembuat Komitmen', 'ppk', 'App\Nova\User')
                    ->sortable()
                    ->filterable()
                    ->exceptOnForms(),
                Status::make('Status', 'status')
                    ->loadingWhen(['dibuat'])
                    ->failedWhen(['outdated'])
                    ->onlyOnIndex(),
            ]),
            Panel::make('Arsip', [
                Filepond::make('File')
                    ->disk('arsip')
                    ->disableCredits()
                    ->onlyOnForms()
                    ->path(session('year').'/'.static::uriKey())
                    ->storeAs(function (Request $request) {
                        $originalName = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $request->file->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->mimesTypes(['application/pdf'])
                    ->canSee(fn () => Policy::make()->allowedFor('arsiparis')->get())
                    ->prunable(),
                $this->file ?
                URL::make('Arsip', fn () => Storage::disk('arsip')
                    ->url($this->file))
                    ->displayUsing(fn () => 'Lihat')->exceptOnForms()
                    :
                Text::make('Arsip', fn () => null)->exceptOnForms(),
            ]),

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
        $kontrakMitraIds = KontrakMitra::where('tahun', session('year'))->get()->pluck('id');

        $model = ModelsBastMitra::whereIn('kontrak_mitra_id', $kontrakMitraIds);

        return [
            MetricValue::make($model, 'total-bast')
                ->width('1/2')
                ->refreshWhenActionsRun(),
            MetricPartition::make($model, 'status', 'status-bast')
                ->refreshWhenActionsRun()
                ->width('1/2')
                ->failedWhen(['outdated'])
                ->successWhen(['digenerate']),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            StatusFilter::make('bast_mitras'),
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
        if (Policy::make()->allowedFor('ppk')->get()) {
            $actions[] =
            GenerateBastMitra::make()
                ->showInline()
                ->showOnDetail()
                ->confirmButtonText('Generate')
                ->exceptOnIndex();
        }

        return $actions;
    }
}
