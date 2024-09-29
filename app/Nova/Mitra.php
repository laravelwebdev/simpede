<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\AddHasManyModel;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Mitra extends Resource
{
    public static function label()
    {
        return 'Mitra';
    }

    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Mitra>
     */
    public static $model = \App\Models\Mitra::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nik';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nik', 'nama',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('NIK', 'nik')
                ->updateRules('required', 'min:16', 'max:16', Rule::unique('mitras', 'nik')->where('kepka_mitra_id', $request->viaResourceId)->ignore($this->id))
                ->sortable()
                ->creationRules('required', 'min:16', 'max:16', Rule::unique('mitras', 'nik')->where('kepka_mitra_id', $request->viaResourceId)),
            Text::make('Nama', 'nama')
                ->sortable()
                ->rules('required'),
            Email::make('Email', 'email')
                ->sortable()
                ->rules('required', 'email'),
            Date::make('Tanggal Lahir', 'tanggal_lahir')
                ->sortable()
                ->rules('required')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            Text::make('Alamat', 'alamat')
                ->sortable()
                ->rules('required'),
            Text::make('NPWP'),
            Text::make('Rekening', 'rekening')
                ->sortable()
                ->rules('required')->help('Contoh Penulisan Rekening: BRI 123456788089'),
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
        if (Policy::make()->allowedFor('admin')->get()) {
            $actions[] =
                AddHasManyModel::make('Mitra', 'KepkaMitra', $request->viaResourceId)
                    ->confirmButtonText('Tambah')
                    ->size('7xl')
                    ->standalone()
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
        return '/resources/kepka-mitras/'.$request->viaResourceId;
    }
}
