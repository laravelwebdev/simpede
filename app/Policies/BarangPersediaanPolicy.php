<?php

namespace App\Policies;

use App\Helpers\Policy;

class BarangPersediaanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota,bmn,pbj')
            ->get();
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
        return Policy::make()
            ->allowedFor('koordinator,anggota,bmn,pbj')
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota,bmn,pbj')
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota,bmn,pbj')
            ->get();
    }

    /**
     * Determine whether the user can replicate model.
     */
    public function replicate(): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota,bmn,pbj')
            ->get();
    }

    public function runAction(): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota,bmn,pbj')
            ->get();
    }
}
