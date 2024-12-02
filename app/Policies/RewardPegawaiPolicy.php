<?php

namespace App\Policies;

use App\Helpers\Policy;
use App\Models\RewardPegawai;
use App\Models\User;

class RewardPegawaiPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return ! Policy::make()
            ->allowedFor('admin')
            ->get();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        return Policy::make()
            ->allowedFor('all')
            ->withYear(session('year'))
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return Policy::make()
            ->allowedFor('kasubbag')
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RewardPegawai $reward): bool
    {
        return Policy::make()
            ->allowedFor('kasubbag')
            ->withYear(session('year'))
            ->andNotEqual($reward->status, 'ditetapkan')
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RewardPegawai $reward): bool
    {
        return Policy::make()
            ->allowedFor('kasubbag')
            ->withYear(session('year'))
            ->andNotEqual($reward->status, 'ditetapkan')
            ->get();
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
        return Policy::make()
            ->allowedFor('kasubbag,kepala')
            ->get();
    }
}
