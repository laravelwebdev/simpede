<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\ImportKamusAnggaran;
use App\Nova\Actions\ImportMataAnggaran;
use App\Nova\Actions\ImportRealisasiAnggaran;
use App\Nova\Metrics\HelperImportAnggaran;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use ShuvroRoy\NovaTabs\Tabs;
use ShuvroRoy\NovaTabs\Traits\HasTabs;

class Dipa extends Resource
{
    use HasTabs;
    public static function label()
    {
        return 'DIPA';
    }

    public static $with = ['mataAnggaran', 'targetSerapanAnggaran'];

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
        return 'Tahun: ' . $this->tahun;
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
                ->rules('required')
                ->options(Helper::setOptionTahunDipa())
                ->creationRules('unique:dipas,tahun')
                ->updateRules('unique:dipas,tahun,{{resourceId}}'),
            Text::make('Nomor', 'nomor')
                ->sortable()
                ->rules('required'),
            Date::make('Tanggal', 'tanggal')
                ->sortable()
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->rules('required'),
            Tabs::make('Anggaran dan Target Serapan', [
                HasMany::make('Mata Anggaran'),
                HasMany::make('Target Serapan Anggaran'),
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
            HelperImportAnggaran::make()
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
        if (Policy::make()->allowedFor('admin')->get()) {
            $actions[] =
                ImportKamusAnggaran::make()
                    ->showInline()
                    ->showOnDetail()
                    ->exceptOnIndex();
            $actions[] =
                ImportMataAnggaran::make()
                    ->showInline()
                    ->showOnDetail()
                    ->exceptOnIndex();
            $actions[] =
                ImportRealisasiAnggaran::make()
                    ->showInline()
                    ->showOnDetail()
                    ->exceptOnIndex();
        }

        return $actions;
    }
}
