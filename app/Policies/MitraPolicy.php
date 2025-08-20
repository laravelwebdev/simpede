<?php

namespace App\Policies;

use App\Helpers\Policy;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class MitraPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->andEqual(request()->is('resources/mitras'), false)
            ->get();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        if (str_contains(request()->url(), 'lens/')) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(): bool
    {
        return Nova::whenServing(function (NovaRequest $request) {
            if (str_contains(request()->url(), 'lens/rekap-honor-mitra')) {
                return false;
            }
            if (str_contains(request()->url(), 'lens/rekap-pulsa-mitra')) {
                return false;
            }

            return Policy::make()
                ->allowedFor('admin')
                ->get();
        });
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        return Nova::whenServing(function (NovaRequest $request) {
            if (str_contains(request()->url(), 'lens/rekap-honor-mitra')) {
                return false;
            }
            if (str_contains(request()->url(), 'lens/rekap-pulsa-mitra')) {
                return false;
            }

            return Policy::make()
                ->allowedFor('admin')
                ->get();
        });
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(): bool
    {
        return false;
    }

    public function runAction(): bool
    {
        return true;
    }
}
