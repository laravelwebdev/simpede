<?php

namespace App\Policies;

use App\Helpers\Policy;

class DaftarSp2dPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Policy::make()
            ->notAllowedFor('admin')
            ->get();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        return Policy::make()
            ->notAllowedFor('admin')
            ->get();
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
        return Policy::make()
            ->allowedFor('ppspm,arsiparis')
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(): bool
    {
        return false;
    }

    public function attachKerangkaAcuan(): bool
    {
        return Policy::make()
            ->allowedFor('ppspm,arsiparis')
            ->get();
    }

    public function attachAnyKerangkaAcuan(): bool
    {
        return Policy::make()
            ->allowedFor('ppspm,arsiparis')
            ->get();
    }

    public function detachKerangkaAcuan(): bool
    {
        return Policy::make()
            ->allowedFor('ppspm,arsiparis')
            ->get();
    }
}
