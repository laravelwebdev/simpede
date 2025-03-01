<?php

namespace App\Nova\Filters;

use Illuminate\Support\Facades\DB;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class StatusFilter extends Filter
{
    protected $table;

    protected $column;

    protected $titleSuffix;

    public function __construct($tableName, $columnName = 'status', $titleSuffix = '')
    {
        $this->table = $tableName;
        $this->column = $columnName;
        $this->titleSuffix = $titleSuffix;
    }

    public function name()
    {
        return 'Status '.$this->titleSuffix;
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
        return $query->where($this->column, $value);
    }

    /**
     * Get the filter's available options.
     *
     * @return array
     */
    public function options(NovaRequest $request)
    {
        return DB::table($this->table)
            ->distinct()
            ->pluck($this->column, $this->column)
            ->mapWithKeys(function ($item, $key) {
                return [strtoupper($key) => $item];
            });
    }

    /**
     * Get the key for the filter.
     *
     * @return string
     */
    public function key()
    {
        return 'status_'.$this->table.'_'.$this->column;
    }
}
