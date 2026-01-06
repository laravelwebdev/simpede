<?php

namespace App\Policies;

use App\Models\User;
use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\PostingKonten;

class PostingKontenPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->get();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PostingKonten $postingKonten): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear(Helper::getYearFromDate($postingKonten->tanggal))
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PostingKonten $postingKonten): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear(Helper::getYearFromDate($postingKonten->tanggal))
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PostingKonten $postingKonten): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear(Helper::getYearFromDate($postingKonten->tanggal))
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, PostingKonten $postingKonten): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear(Helper::getYearFromDate($postingKonten->tanggal))
            ->get();
    }
}
