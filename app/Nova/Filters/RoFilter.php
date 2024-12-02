<?php

namespace App\Nova\Filters;

use App\Helpers\Helper;
use App\Models\Dipa;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class RoFilter extends Filter
{
    public function name()
    {
        return 'Rincian Output';
    }
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(NovaRequest $request, $query, $value)
    {
        return $query->whereLike('mak', '%'.$value.'%');
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function options(NovaRequest $request)
    {
        return array_flip(Helper::setOptionsRo(Helper::getPropertyFromCollection(Dipa::cache()->get('all')->where('tahun', session('year'))->first(), 'id')));
    }
}
