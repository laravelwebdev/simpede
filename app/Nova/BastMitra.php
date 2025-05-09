<?php

namespace App\Nova;

use App\Helpers\Policy;
use App\Models\BastMitra as ModelsBastMitra;
use App\Models\KontrakMitra;
use App\Nova\Actions\GenerateBastMitra;
use App\Nova\Filters\StatusFilter;
use App\Nova\Metrics\MetricPartition;
use App\Nova\Metrics\MetricValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
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
        return 'B A S T';
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
        return $this->kontrakMitra->jenis_honor;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kontrakMitra.nama_kontrak',
        'status',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {

        return [
            Panel::make('Keterangan BAST', [
                BelongsTo::make('Kontrak Mitra'),

                Status::make('Status', 'status')
                    ->loadingWhen(['dibuat'])
                    ->failedWhen(['outdated']),
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
