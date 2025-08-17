<?php

namespace App\Nova;

use App\Helpers\Policy;
use App\Nova\Actions\AddHasManyModel;
use App\Nova\Actions\MatchingAnggaran as ActionMatchingAnggaran;
use App\Nova\Lenses\MatchingAnggaran;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\ActionRequest;
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
     * Get the searchable columns for the resource.
     *
     * @return array
     */
    public static function searchableColumns()
    {
        return ['mak', 'uraian'];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('MAK', 'mak')
                ->rules('required', 'min:35', 'max:35')
                ->sortable()
                ->placeholder('XXX.XX.XX.XXXX.XXX.XXX.XXX.X.XXXXXX')
                ->showWhenPeeking(),
            Text::make('Detil Anggaran', 'uraian')
                ->rules('required', 'max:255'),

        ];
    }

    public function fieldsForAdd(NovaRequest $request)
    {
        return [
            Text::make('MAK', 'mak')
                ->rules('required', 'min:35', 'max:35')
                ->sortable()
                ->placeholder('XXX.XX.XX.XXXX.XXX.XXX.XXX.X.XXXXXX')
                ->showWhenPeeking(),
            Text::make('Detil Anggaran', 'uraian')
                ->rules('required', 'max:255'),
            Boolean::make('Manual', 'is_manual')
                ->default(true)
                ->immutable(),
            Boolean::make('Bukan POK Satker', 'is_pok')
                ->default(true),
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
            MatchingAnggaran::make(),
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
        if (Policy::make()->allowedFor('koordinator,anggota')->get() && $request->viaResource === 'dipas') {
            $actions[] =
            AddHasManyModel::make('MataAnggaran', 'Dipa', $request->viaResourceId)
                ->confirmButtonText('Tambah')
            // ->size('7xl')
                ->standalone()
                ->onlyOnIndex()
                ->addFields($this->fieldsForAdd($request));
        }
        $actions[] = ActionMatchingAnggaran::make($this->resource->dipa_id, $this->resource->mak)
            ->sole()
            ->confirmButtonText('Matching')
            ->confirmText('Cek kembali sekali lagi. Pastikan anggaran yang di matching sudah benar. Matching tidak dapat diulang.')
            ->canSee(function ($request) {
                if ($request instanceof ActionRequest) {
                    return true;
                }

                return $this->resource instanceof Model && $this->is_manual;
            });

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
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId : '/'.'resources'.'/'.'dipas'.'/';
    }

    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return $request->viaResource ? '/'.'resources'.'/'.$request->viaResource.'/'.$request->viaResourceId : '/'.'resources'.'/'.'dipas'.'/';
    }
}
