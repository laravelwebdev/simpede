<?php

namespace App\Nova\Filters;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class BulanFilter extends Filter
{
    public $name = 'Bulan';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        // Filter diterapkan di query Lens, jadi di sini tidak perlu melakukan apa-apa
        return $query;
    }

    /**
     * Get the filter's available options.
     *
     * @return array
     */
    public function options(Request $request)
    {
        return array_flip(Helper::$bulan);

    }

    public function default()
    {
        return date('m');
    }
}
