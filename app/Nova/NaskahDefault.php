<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\DerajatNaskah;
use App\Models\JenisNaskah;
use App\Models\KodeArsip;
use App\Models\KodeNaskah;
use App\Nova\Actions\AddHasManyModel;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class NaskahDefault extends Resource
{
    public static $with = ['jenisNaskah', 'derajatNaskah'];

    /**
     * Get the label for the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Default Naskah Tertentu';
    }

    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\NaskahDefault>
     */
    public static $model = \App\Models\NaskahDefault::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'jenis';

    public static function searchable()
    {
        return false;
    }

    public static $globallySearchable = false;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $kodeNaskahIds = KodeNaskah::cache()
            ->get('all')
            ->where('tata_naskah_id', $request->viaResourceId)
            ->pluck('id')
            ->toArray();

        return [
            Select::make('Jenis Template', 'jenis')
                ->sortable()
                ->searchable()
                ->rules('required')
                ->displayUsingLabels()
                ->options(Helper::$template),
            Select::make('Jenis Naskah', 'jenis_naskah_id')
                ->sortable()
                ->searchable()
                ->rules('required')
                ->onlyOnForms()
                ->displayUsingLabels()
                ->options(Helper::setOptions(JenisNaskah::cache()->get('all')->whereIn('kode_naskah_id', $kodeNaskahIds), 'id', 'jenis')),
            Select::make('Derajat Naskah', 'derajat_naskah_id')
                ->sortable()
                ->searchable()
                ->onlyOnForms()
                ->displayUsingLabels()
                ->options(Helper::setOptions(DerajatNaskah::cache()->get('all')->where('tata_naskah_id', $request->viaResourceId), 'id', 'derajat')),
            MultiSelect::make('Kode Arsip', 'kode_arsip_id')
                ->sortable()
                ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(KodeArsip::cache()->get('all')->where('id', $kode)->first(), 'kode'))
                ->options(Helper::setOptions(KodeArsip::cache()->get('all')->where('tata_naskah_id', $request->viaResourceId), 'id', 'detail', '', 'kode', ''))
                ->hideFromIndex(),

        ];
    }

    public function fieldsforIndex(NovaRequest $request)
    {
        return [
            Select::make('Jenis Template', 'jenis')
                ->sortable()
                ->rules('required')
                ->searchable()
                ->displayUsingLabels()
                ->options(Helper::$template),
            BelongsTo::make('Jenis Naskah')
                ->sortable()
                ->exceptOnForms(),
            BelongsTo::make('Derajat Naskah')
                ->sortable()
                ->exceptOnForms(),
            MultiSelect::make('Kode Arsip', 'kode_arsip_id')
                ->sortable()
                ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(KodeArsip::cache()->get('all')->where('id', $kode)->first(), 'kode'))
                ->options(Helper::setOptions(KodeArsip::cache()->get('all')->where('tata_naskah_id', $request->viaResourceId), 'id', 'detail', '', 'kode', ''))
                ->hideFromIndex(),

        ];
    }

    public function fieldsforDetail(NovaRequest $request)
    {
        return [
            Select::make('Jenis Template', 'jenis')
                ->sortable()
                ->searchable()
                ->rules('required')
                ->displayUsingLabels()
                ->options(Helper::$template),
            BelongsTo::make('Jenis Naskah')
                ->sortable()
                ->exceptOnForms(),
            BelongsTo::make('Derajat Naskah')
                ->sortable()
                ->exceptOnForms(),
            MultiSelect::make('Kode Arsip', 'kode_arsip_id')
                ->sortable()
                ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(KodeArsip::cache()->get('all')->where('id', $kode)->first(), 'kode'))
                ->options(Helper::setOptions(KodeArsip::cache()->get('all')->where('tata_naskah_id', $request->viaResourceId), 'id', 'detail', '', 'kode', ''))
                ->hideFromIndex(),

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
        if (Policy::make()->allowedFor('admin')->get() && $request->viaResource === 'tata-naskahs') {
            $actions[] =
            AddHasManyModel::make('NaskahDefault', 'TataNaskah', $request->viaResourceId)
                ->confirmButtonText('Tambah')
                ->size('7xl')
                ->standalone()
                ->onlyOnIndex()
                ->addFields($this->fields($request));
        }

        return $actions;
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId.'#Detail%20Naskah=naskah-default' : '/'.'resources'.'/'.'tata-naskahs'.'/';
    }
}
