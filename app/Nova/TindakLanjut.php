<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\TindakLanjut as ModelsTindakLanjut;
use App\Nova\Metrics\MetricKeberadaan;
use App\Nova\Metrics\MetricPartition;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Query\Search\SearchableText;
use Laravel\Nova\Tabs\Tab;
use Laravelwebdev\Repeatable\Repeatable;

class TindakLanjut extends Resource
{
    public static $with = ['unitKerja', 'perjanjianKinerja', 'pelaksanaanTindakLanjut'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\TindakLanjut>
     */
    public static $model = \App\Models\TindakLanjut::class;

    public static function label()
    {
        return 'Tindak Lanjut';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return 'Tindak Lanjut Triwulan  '.$this->triwulan;
    }

    public function subtitle()
    {
        return $this->tahun;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static function searchableColumns()
    {
        return [new SearchableText('tindak_lanjut')];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            BelongsTo::make('Unit Kerja')
                ->sortable()
                ->exceptOnForms(),
            Select::make('Triwulan')
                ->options([
                    1 => 'Triwulan 1',
                    2 => 'Triwulan 2',
                    3 => 'Triwulan 3',
                    4 => 'Triwulan 4',
                ])
                ->displayUsingLabels()
                ->filterable()
                ->exceptOnForms(),
            Text::make('Tindak Lanjut')
                ->onlyOnIndex(),
            Textarea::make('Tindak Lanjut')
                ->alwaysShow()
                ->rules('required'),
            Date::make('Deadline')
                ->displayUsing(fn ($value) => Helper::terbilangTanggal($value))
                ->exceptOnForms(),
            Select::make('Pelaksanaan', 'pelaksanaan_tindak_lanjut_count')
                ->options([
                    0 => 'Belum Ada',
                ])
                ->filterable(function ($request, $query, $value, $attribute) {
                    $query->has('pelaksanaanTindakLanjut', '<=', $value);
                })
                ->exceptOnForms(),
            Repeatable::make('Penanggung Jawab', 'penanggung_jawab', [
                Select::make('Penanggung Jawab', 'penanggung_jawab_id')
                    ->options(Helper::setOptionPengelola('anggota', now()))
                    ->searchable()
                    ->displayUsingLabels()
                    ->rules('required'),
            ])->rules('required'),
            Tab::group(fields: [
                HasMany::make('Pelaksanaan Tindak Lanjut', 'pelaksanaanTindakLanjut', PelaksanaanTindakLanjut::class),
                BelongsToMany::make('Perjanjian Kinerja', 'perjanjianKinerja', PerjanjianKinerja::class),
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
        $model = ModelsTindakLanjut::where('tahun', session('year'));

        return [
            MetricPartition::make($model, 'unit_kerja_id', 'unit-kerja-tl', 'Unit Kerja')
                ->setLabel(Helper::setOptionUnitKerja())
                ->refreshWhenActionsRun(),
            MetricKeberadaan::make('Indikator', $model->withcount('perjanjianKinerja'), 'perjanjian_kinerja_count', 'indikator-terdampak-tl')
                ->nullStrict(false)
                ->refreshWhenActionsRun(),
            MetricKeberadaan::make('Pelaksanaan', $model->withcount('pelaksanaanTindakLanjut'), 'pelaksanaan_tindak_lanjut_count', 'pelaksanaan-tl')
                ->nullStrict(false)
                ->refreshWhenActionsRun(),
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
        return [];
    }

    protected static function afterValidation(NovaRequest $request, $validator)
    {
        if (Helper::cekGanda(json_decode($request->penanggung_jawab), 'penanggung_jawab_id')) {
            $validator->errors()->add('penanggung_jawab', 'Terdapat duplikasi penanggung jawab');
        }
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('tahun', session('year'))->withCount(['perjanjianKinerja', 'pelaksanaanTindakLanjut']);
    }
}
