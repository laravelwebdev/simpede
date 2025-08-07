<?php

namespace App\Nova\Filters;

use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class Keberadaan extends Filter
{
    protected $judul;

    protected $column;

    protected $is_null = false;

    public function __construct($judul, $column)
    {
        $this->judul = $judul;
        $this->column = $column;
    }

    public function is_null()
    {
        $this->is_null = true;

        return $this;
    }

    public function name()
    {
        return $this->judul;
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
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(NovaRequest $request, $query, $value)
    {
        return $this->is_null ? $query->where($this->column, $value, null) : $query->where($this->column, $value, 0);
    }

    /**
     * Get the filter's available options.
     *
     * @return array
     */
    public function options(NovaRequest $request)
    {
        return $this->is_null ? [
            'Ada' => '!=',
            'Tidak Ada' => '=',
        ] : [
            'Ada' => '>',
            'Tidak Ada' => '<=',
        ];
    }
}
