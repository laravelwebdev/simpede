<?php

namespace App\Policies;

use App\Helpers\Policy;
use App\Models\DokumentasiLink;
use App\Models\User;

class DokumentasiLinkPolicy
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
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DokumentasiLink $link): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->andEqual($user->id, $link->user_id)
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DokumentasiLink $link): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->andEqual($user->id, $link->user_id)
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(): bool
    {
        return false;
    }
}
