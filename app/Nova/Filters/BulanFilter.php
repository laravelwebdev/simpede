<?php

namespace App\Nova\Filters;

use App\Helpers\Helper;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class BulanFilter extends Filter
{
    protected bool $embedded;

    protected $column;

    protected bool $isdate;

    protected $default;

    public function __construct($embedded = true, $column = 'bulan', $isdate = false, $default = 'cm')
    {
        $this->column = $column;
        $this->isdate = $isdate;
        $this->embedded = $embedded;
        $this->default = $default;
    }

    public $name = 'Bulan';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(NovaRequest $request, $query, $value)
    {
        if ($this->embedded) {
            return $query;
        }

        return $this->isdate
            ? $query->whereMonth($this->column, $value)
            : $query->where($this->column, $value);
    }

    /**
     * Get the filter's available options.
     *
     * @return array
     */
    public function options(NovaRequest $request)
    {
        return array_flip(Helper::BULAN);
    }

    public function default()
    {
        return $this->default == 'cm' ? (int) date('m') : $this->default;
    }
}
