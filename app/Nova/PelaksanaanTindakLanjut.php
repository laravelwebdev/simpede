<?php

namespace App\Nova;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Query\Search\SearchableText;
use Laravelwebdev\Filepond\Filepond;

class PelaksanaanTindakLanjut extends Resource
{
    public static $with = ['tindakLanjut'];
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PelaksanaanTindakLanjut>
     */
    public static $model = \App\Models\PelaksanaanTindakLanjut::class;

    public static function label()
    {
        return 'Pelaksanaan Tindak Lanjut';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return 'Pelaksanaan Tindak Lanjut Bulan '.Helper::$bulan[$this->bulan];
    }

    public function subtitle()
    {
        return $this->kegiatan;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static function searchableColumns()
    {
        return [new SearchableText('kegiatan')];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Bulan Pelaksanaan', 'bulan')
                ->options(function () {
                    $triwulan = $this->tindakLanjut->triwulan;
                    switch ($triwulan) {
                        case 1:
                            return array_intersect_key(Helper::$bulan, array_flip([4, 5, 6]));
                        case 2:
                            return array_intersect_key(Helper::$bulan, array_flip([7, 8, 9]));
                        case 3:
                            return array_intersect_key(Helper::$bulan, array_flip([10, 11, 12]));
                        case 4:
                            return array_intersect_key(Helper::$bulan, array_flip([1, 2, 3]));
                        default:
                            return [];
                    }
                })
                ->displayUsingLabels()
                ->sortable()
                ->filterable()
                ->rules('required'),
            Text::make('Kegiatan', 'kegiatan')
                ->onlyOnIndex(),
            Textarea::make('Kegiatan yang dilaksanakan', 'kegiatan')
                ->sortable()
                ->rules('required'),
            Filepond::make('Bukti Dukung Pelaksanaan', 'bukti_dukung')
                ->disk('sakip')
                ->disableCredits()
                ->rules('required')
                ->columns(3)
                ->multiple()
                ->limit(10)
                ->path(session('year').'/'.static::uriKey())
                ->prunable(),
            $this->bukti_dukung ?
            URL::make('Bukti Dukung', fn () => Storage::disk('sakip')
                ->url($this->bukti_dukung))
                ->displayUsing(fn () => 'Lihat')->exceptOnForms()
                :
            Text::make('Bukti Dukung', fn () => null)->exceptOnForms(),
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
        return [];
    }
}
