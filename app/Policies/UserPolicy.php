<?php

namespace App\Policies;

use App\Helpers\Policy;
use App\Models\User;

class UserPolicy
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
    public function view(): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return Policy::make()
            ->allowedFor('admin')
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user1, User $user2): bool
    {
        return Policy::make()
            ->allowedFor('admin')
            ->orEqual($user1->id, $user2->id)
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
     * Determine whether the user can replicate model.
     */
    public function replicate(): bool
    {
        return false;
    }
}
