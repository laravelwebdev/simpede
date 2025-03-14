<?php

namespace App\Policies;

use App\Helpers\Policy;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class DaftarPesertaPerjalananPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Nova::whenServing(function (NovaRequest $request) {
            if ($request->viaResource == 'perjalanan-dinas' || str_contains(request()->url(), 'perjalanan-dinas')) {
                return Policy::make()
                    ->allowedFor('anggota,koordinator,ppk')
                    ->get();
            }

            return false;
        });
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        return Policy::make()
            ->allowedFor('anggota,koordinator,ppk')
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return Nova::whenServing(function (NovaRequest $request) {
            if ($request->viaResource == 'perjalanan-dinas' || str_contains(request()->url(), 'perjalanan-dinas')) {
                return Policy::make()
                    ->allowedFor('anggota,koordinator,ppk')
                    ->get();
            }

            return false;
        });
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(): bool
    {
        return Nova::whenServing(function (NovaRequest $request) {
            if ($request->viaResource == 'perjalanan-dinas' || str_contains(request()->url(), 'perjalanan-dinas')) {
                return Policy::make()
                    ->allowedFor('anggota,koordinator,ppk')
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
        return Policy::make()
            ->allowedFor('anggota,koordinator,ppk')
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(): bool
    {
        return Policy::make()
            ->allowedFor('anggota,koordinator,ppk')
            ->get();
    }

    public function runAction(): bool
    {
        return Policy::make()
            ->allowedFor('anggota,koordinator,ppk')
            ->get();
    }
}
