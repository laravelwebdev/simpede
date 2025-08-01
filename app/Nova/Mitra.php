<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\AddHasManyModel;
use App\Nova\Lenses\RekapHonorMitra;
use App\Nova\Lenses\RekapPulsaMitra;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;

class Mitra extends Resource
{
    public static $with = ['daftarHonorMitra', 'daftarPulsaMitra'];

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
    public static $title = 'nama';

    public function subtitle()
    {
        return $this->nik;
    }

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
                ->hideWhenUpdating()
                ->copyable()
                // ->onlyOnForms()
                ->creationRules('required', 'min:16', 'max:16', Rule::unique('mitras', 'nik')->where('kepka_mitra_id', $request->viaResourceId)),
            Text::make('Nama', 'nama')
                ->sortable()
                ->showWhenPeeking()
                ->rules('required', 'max:255'),
            Email::make('Email', 'email')
                ->sortable()
                ->rules('required', 'email', 'max:80'),
            Date::make('Tanggal Lahir', 'tanggal_lahir')
                ->sortable()
                ->rules('required')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            Text::make('Alamat', 'alamat')
                ->hideFromIndex()
                ->rules('required', 'max:255'),
            Text::make('NPWP')
                ->rules('nullable', 'bail', 'max:40')
                ->showWhenPeeking(),
            Text::make('Telepon')
                ->rules('nullable', 'bail', 'max:30')
                ->onlyOnForms(),
            Select::make('Bank', 'kode_bank_id')
                ->options(Helper::setOptionsKodeBank())
                ->showWhenPeeking()
                ->displayUsingLabels()
                ->rules('required'),
            Text::make('Nomor Rekening', 'rekening')
                ->showWhenPeeking()
                ->rules('required', 'numeric', 'digits_between:1,40'),
            HasMany::make('Daftar Honor Mitra', 'daftarHonorMitra'),
            HasMany::make('Daftar Pulsa Mitra', 'daftarPulsaMitra'),
        ];
    }

    public function fieldsforIndex(NovaRequest $request)
    {
        return [
            Text::make('Nama', 'nama')
                ->sortable(),
            Email::make('Email', 'email')
                ->sortable(),
            Date::make('Tanggal Lahir', 'tanggal_lahir')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            Text::make('NPWP'),
            URL::make('Telepon', fn () => Helper::formatTelepon($this->telepon))
                ->displayUsing(fn () => $this->telepon),
            Select::make('Bank', 'kode_bank_id')
                ->options(Helper::setOptionsKodeBank())
                ->displayUsingLabels()
                ->rules('required'),
            Text::make('Rekening', 'rekening'),
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
        return [
            RekapHonorMitra::make(),
            RekapPulsaMitra::make(),
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        $actions = [];
        if (Policy::make()->allowedFor('admin')->get() && $request->viaResource === 'kepka-mitras') {
            $actions[] =
                AddHasManyModel::make('Mitra', 'KepkaMitra', $request->viaResourceId)
                    ->confirmButtonText('Tambah')
                    ->size('7xl')
                    ->onlyOnIndex()
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
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId : '/'.'resources'.'/'.'kepka-mitras'.'/';
    }
}
