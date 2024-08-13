<?php

namespace App\Policies;

use App\Models\IzinKeluar;
use App\Models\User;

class IzinKeluarPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return in_array(session('role'), ['kepala', 'anggota', 'koordinator']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, IzinKeluar $izinKeluar): bool
    {
        $allowedyear = ((session('year') == $izinKeluar->tahun));
        if (session('role') === 'kepala') {
            return $allowedyear;
        }
        if (session('role') === 'koordinator') {
            return $allowedyear && ($user->unit_kerja_id === $izinKeluar->user->unit_kerja_id);
        }
        if (session('role') === 'anggota') {
            return $allowedyear && ($user->id === $izinKeluar->user_id);
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array(session('role'), ['kepala', 'anggota', 'koordinator']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, IzinKeluar $izinKeluar): bool
    {
        $allowedyear = ((session('year') == $izinKeluar->tahun));

        return $allowedyear && ($user->id === $izinKeluar->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, IzinKeluar $izinKeluar): bool
    {
        $allowedyear = ((session('year') == $izinKeluar->tahun));

        return $allowedyear && ($user->id === $izinKeluar->user_id);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, IzinKeluar $izinKeluar): bool
    {
        $allowedyear = ((session('year') == $izinKeluar->tahun));

        return $allowedyear && ($user->id === $izinKeluar->user_id);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, IzinKeluar $izinKeluar): bool
    {
        $allowedyear = ((session('year') == $izinKeluar->tahun));

        return $allowedyear && ($user->id === $izinKeluar->user_id);
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, IzinKeluar $izinKeluar): bool
    {
        $allowedyear = ((session('year') == $izinKeluar->tahun));

        return $allowedyear && ($user->id === $izinKeluar->user_id);
    }
}
