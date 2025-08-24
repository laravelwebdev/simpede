<?php

namespace App\Nova;

use App\Models\KerangkaAcuan;
use App\Nova\Actions\AddHasManyModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;

class AnggaranKerangkaAcuan extends Resource
{
    public static $with = ['mataAnggaran'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\AnggaranKerangkaAcuan>
     */
    public static $model = \App\Models\AnggaranKerangkaAcuan::class;

    public static $displayInNavigation = false;

    public static function label()
    {
        return 'Anggaran KAK';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return $this->relationLoaded('mataAnggaran')
            ? $this->mataAnggaran->mak
            : $this->mataAnggaran()->value('mak');
    }

    public function subtitle()
    {
        return $this->relationLoaded('mataAnggaran')
            ? $this->mataAnggaran->uraian
            : $this->mataAnggaran()->value('uraian');
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'mataAnggaran.mak',
        'mataAnggaran.uraian',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Hidden::make('ID KAK', 'kerangka_acuan_id')->default($request->viaResourceId),
            BelongsTo::make('Mata Anggaran')
                ->searchable()
                ->updateRules('required', Rule::unique('anggaran_kerangka_acuans', 'mata_anggaran_id')->where('kerangka_acuan_id', $request->viaResourceId)->ignore($this->id))
                ->creationRules('required', Rule::unique('anggaran_kerangka_acuans', 'mata_anggaran_id')->where('kerangka_acuan_id', $request->viaResourceId))
                ->withSubtitles()
                ->dependsOn('kerangka_acuan_id', function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                    $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($formData) {
                        return $query->where('dipa_id', KerangkaAcuan::find($formData->kerangka_acuan_id)->dipa_id);
                    });
                }),

            Numeric::make('Perkiraan Digunakan ', 'perkiraan')
                ->rules('required', 'gt:1'),

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
            AddHasManyModel::make('AnggaranKerangkaAcuan', 'KerangkaAcuan', $request->viaResourceId)
                ->confirmButtonText('Tambah')
                ->size('5xl')
                ->standalone()
                ->onlyOnIndex()
                ->addFields($this->fields($request)),
        ];
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId : '/'.'resources'.'/'.'kerangka-acuans'.'/';
    }
}
