<?php

namespace App\Nova\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Nova\Filters\BooleanFilter;
use Laravel\Nova\Http\Requests\NovaRequest;

class KelengkapanBerkas extends BooleanFilter
{
    /**
     * Apply the filter to the given query.
     */
    public function apply(NovaRequest $request, Builder $query, mixed $value): Builder
    {
        return $query->where(function (Builder $query) use ($value) {
            if (! empty($value['lengkap'])) {
                $query->orWhereNull('catatan')->whereNotNull('arsip_keuangan_id');
            }

            if (! empty($value['tidak_lengkap'])) {
                $query->orWhereNotNull('catatan')->whereNotNull('arsip_keuangan_id');
            }
        });
    }

    /**
     * Get the filter's available options.
     *
     * @return array<string, string>
     */
    public function options(NovaRequest $request): array
    {
        return [
            'Lengkap' => 'lengkap',
            'Belum Lengkap' => 'tidak_lengkap',
        ];
    }
}
