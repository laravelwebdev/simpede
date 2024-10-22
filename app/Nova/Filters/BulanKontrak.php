<?php

namespace App\Nova\Filters;

use App\Helpers\Helper;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class BulanKontrak extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(NovaRequest $request, $query, $value)
    {
        return $query->where('bulan', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @return array
     */
    public function options(NovaRequest $request)
    {
        return array_flip(Helper::$bulan);
    }

    /**
 * The default value of the filter.
 *
 * @var string
 */
public function default()
{
    return Date('m');
}
}
