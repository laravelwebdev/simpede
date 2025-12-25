<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\DigitalPayment;
use App\Models\User;

class DigitalPaymentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Policy::make()
            ->allowedFor('anggota,koordinator,ppk,bendahara')
            ->get();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DigitalPayment $digitalPayment): bool
    {
        return Policy::make()
            ->allowedFor('anggota,koordinator,ppk,bendahara')
            ->withYear(Helper::getYearFromDate($digitalPayment->tanggal_transaksi))
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
    public function update(User $user, DigitalPayment $digitalPayment): bool
    {
        return Policy::make()
            ->allowedFor('anggota,koordinator,ppk,bendahara')
            ->withYear(Helper::getYearFromDate($digitalPayment->tanggal_transaksi))
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DigitalPayment $digitalPayment): bool
    {
        return Policy::make()
            ->allowedFor('anggota,koordinator,ppk,bendahara')
            ->withYear(Helper::getYearFromDate($digitalPayment->tanggal_transaksi))
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
