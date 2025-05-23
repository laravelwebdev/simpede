<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\KontrakMitra as ModelsKontrakMitra;
use App\Nova\Actions\GenerateKontrakMitra;
use App\Nova\Filters\StatusFilter;
use App\Nova\Metrics\MetricPartition;
use App\Nova\Metrics\MetricValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravelwebdev\Filepond\Filepond;

class KontrakMitra extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\KontrakMitra>
     */
    public static $model = \App\Models\KontrakMitra::class;

    public static $with = ['daftarKontrakMitra', 'jenisKontrak'];

    public static function label()
    {
        return 'Kontrak';
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('tahun', session('year'));
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nama_kontrak';

    public function subtitle()
    {
        return $this->jenis_honor;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nama_kontrak', 'bulan', 'status',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Panel::make('Keterangan Kontrak', [
                Select::make('Jenis Kontrak/Honor', 'jenis_honor')
                    ->options(Helper::JENIS_HONOR)
                    ->displayUsingLabels()
                    ->sortable()
                    ->filterable()
                    ->searchable()
                    ->readonly(),
                Text::make('Nama Kontrak', 'nama_kontrak')
                    ->readonly(),
                Select::make('Bulan Kontrak', 'bulan')
                    ->options(Helper::BULAN)
                    ->readonly()
                    ->sortable()
                    ->searchable()
                    ->filterable()
                    ->exceptOnForms()
                    ->displayUsingLabels(),
                BelongsTo::make('Jenis Kegiatan', 'jenisKontrak', JenisKontrak::class)
                    ->filterable()
                    ->sortable()
                    ->exceptOnForms(),
                Status::make('Status', 'status')
                    ->loadingWhen(['dibuat', 'diubah'])
                    ->failedWhen(['outdated'])
                    ->onlyOnIndex(),
            ]),
            Panel::make('Arsip', [
                Filepond::make('File')
                    ->disk('arsip')
                    ->disableCredits()
                    ->onlyOnForms()
                    ->mimesTypes(['application/pdf'])
                    ->path(session('year').'/'.static::uriKey())
                    ->storeAs(function (Request $request) {
                        $originalName = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $request->file->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
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
        $model = ModelsKontrakMitra::where('tahun', session('year'));

        return [
            MetricValue::make($model, 'total-kontrak')
                ->width('1/2')
                ->refreshWhenActionsRun(),
            MetricPartition::make($model, 'status', 'status-kontrak')
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
            StatusFilter::make('kontrak_mitras'),
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
            GenerateKontrakMitra::make()
                ->showInline()
                ->showOnDetail()
                ->confirmButtonText('Generate')
                ->exceptOnIndex();
        }

        return $actions;
    }
}
