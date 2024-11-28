<?php

namespace App\Nova;

use App\Helpers\Policy;
use App\Nova\Actions\AddHasManyModel;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class MataAnggaran extends Resource
{
    public static $with = ['realisasiAnggaran'];

    public static function label()
    {
        return 'Mata Anggaran Kegiatan';
    }

    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\MataAnggaran>
     */
    public static $model = \App\Models\MataAnggaran::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'uraian';

    public function subtitle()
    {
        return $this->mak;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'mak', 'uraian',
    ];
//TODO: BUAT SERACHABLE TEXT

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('MAK', 'mak')
                ->updateRules('required', 'min:35', 'max:35', Rule::unique('mata_anggarans', 'mak')->where('dipa_id', $request->viaResourceId)->ignore($this->id))
                ->sortable()
                ->creationRules('required', 'min:35', 'max:35', Rule::unique('mata_anggarans', 'mak')->where('dipa_id', $request->viaResourceId))
                ->placeholder('XXX.XX.XX.XXXX.XXX.XXX.XXX.X.XXXXXX')
                ->showWhenPeeking(),
            Text::make('Detil Anggaran', 'uraian')
                ->rules('required'),

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
        if (Policy::make()->allowedFor('koordinator,anggota')->get()) {
            $actions[] =
            AddHasManyModel::make('MataAnggaran', 'Dipa', $request->viaResourceId)
                ->confirmButtonText('Tambah')
            // ->size('7xl')
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
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId.'#Anggaran%20dan%20Target%20Serapan=mata-anggaran' : '/'.'resources'.'/'.'dipas'.'/';
    }

    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId.'#Anggaran%20dan%20Target%20Serapan=mata-anggaran' : '/'.'resources'.'/'.'dipas'.'/';
    }
}
