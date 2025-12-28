<?php

namespace App\Nova\Filters;

use App\Helpers\Helper;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class FilterTahunDipa extends Filter
{
    public $name = 'Tahun';

    private $yearColumn = 'tahun';

    public function __construct($yearColumn = 'tahun')
    {
        $this->yearColumn = $yearColumn;
    }

    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     */
    public function apply(NovaRequest $request, Builder $query, mixed $value): Builder
    {
        return $query->where($this->yearColumn, $value);
    }

    /**
     * Get the filter's available options.
     *
     * @return array<string, string>
     */
    public function options(NovaRequest $request): array
    {
        return array_flip(Helper::setOptionTahunDipa());
    }

    public function default()
    {
        return session('year');
    }
}
