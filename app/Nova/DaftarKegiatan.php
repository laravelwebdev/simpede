<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\DaftarKegiatan as ModelDaftarKegiatan;
use App\Nova\UnitKerja;
use App\Nova\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Http\Requests\NovaRequest;

class DaftarKegiatan extends Resource
{
    public static $with = ['daftarKegiatanable'];
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarKegiatan>
     */
    public static $model = \App\Models\DaftarKegiatan::class;

    public static function label()
    {
        return 'Tanggal Penting';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'kegiatan';

    public function subtitle()
    {
        return Helper::terbilangTanggal($this->awal).' - '.Helper::terbilangTanggal($this->akhir);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'jenis', 'kegiatan', 'awal', 'akhir',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Jenis')
                ->options(Helper::$jenis_kegiatan)
                ->sortable()
                ->filterable()
                ->rules('required'),
            Text::make('Kegiatan')
                ->sortable()
                ->rules('required'),
            Date::make('Awal')
                ->sortable()
                ->rules('required'),
            Date::make('Akhir')
                ->sortable()
                ->hide()
                ->dependsOn(['jenis', 'awal'], function (Date $field, NovaRequest $request, FormData $formData) {
                    if ($formData->jenis == 'Kegiatan') {
                        $field
                            ->show()
                            ->rules('required', 'after_or_equal:awal')
                            ->setValue($formData->awal);
                    }
                }),
            MorphTo::make('Penanggung Jawab', 'daftarKegiatanable')->types([
                User::class,
                UnitKerja::class,
            ])
            ->searchable()
            ->hide()
            ->withSubtitles()
            ->nullable()
            ->dependsOn(['jenis'], function (MorphTo $field, NovaRequest $request, FormData $formData) {
                if ($formData->jenis != 'Libur') {
                    $field
                        ->show()
                        ->rules('required')
                        ->relatableQueryUsing(function (NovaRequest $request, Builder $query) {
                            if ($request->resourceType === User::class) {
                                $query->whereNull('inactive');
                            }
                        });
                }
            })
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
        return [
            Action::using('Sinkronisasi Hari Libur', function (ActionFields $fields, Collection $models) {
                $response = Http::get('https://dayoffapi.vercel.app/api?year='.session('year'));
                if ($response->ok()) {
                    $data = $response->json();
                    foreach ($data as $item) {
                        $kegiatan = ModelDaftarKegiatan::firstOrNew([
                            'jenis' => 'Libur',
                            'awal' => $item['tanggal'],
                        ]);
                        $kegiatan->kegiatan = $item['keterangan'];
                        $kegiatan->akhir = $item['tanggal'];
                        $kegiatan->save();
                    }
                }
            })->standalone(),
        ];
    }
}
