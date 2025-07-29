<?php

namespace App\Policies;

use App\Helpers\Policy;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class DaftarPulsaMitraPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        return false;
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
            if ($request->viaResource == 'pulsa-kegiatans') {
                return Policy::make()
                    ->allowedFor('koordinator,anggota')
                    ->get();
            }

            return false;
        });
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        return Nova::whenServing(function (NovaRequest $request) {
            if ($request->viaResource == 'pulsa-kegiatans') {
                return Policy::make()
                    ->allowedFor('koordinator,anggota')
                    ->get();
            }

            return false;
        });
    }

    /**
     * Determine whether the user can replicate model.
     */
    public function replicate(): bool
    {
        return false;
    }

    public function runAction(): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota')
            ->get();
    }
}
