<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\KerangkaAcuan;
use App\Models\User;

class KerangkaAcuanPolicy
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
    public function view(User $user, KerangkaAcuan $kerangkaAcuan): bool
    {
        return Policy::make()
            ->allowedFor('ppk,arsiparis,bendahara,kpa,ppspm,bmn,koordinator,anggota')
            ->withYear(Helper::getYearFromDate($kerangkaAcuan->tanggal))
            ->andEqual(str_contains(request()->url(), 'lens'), false)
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota')
            ->andEqual(str_contains(request()->url(), 'lens'), false)
            ->andEqual(request()->viaResource, null)
            ->get();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, KerangkaAcuan $kerangkaAcuan): bool
    {
        if (Policy::make()->allowedFor('koordinator,anggota')->get()) {
            return Policy::make()
                ->allowedFor('koordinator,anggota')
                ->withYear(Helper::getYearFromDate($kerangkaAcuan->tanggal))
                ->andEqual(
                    $kerangkaAcuan->unit_kerja_id,
                    optional(Helper::getDataPegawaiByUserId($user->id, now()))->unit_kerja_id
                )
                ->andEqual(str_contains(request()->url(), 'lens'), false)
                ->andEqual(request()->viaResource, null)
                ->get();
        }

        return Policy::make()
            ->allowedFor('arsiparis,ppspm')
            ->withYear(Helper::getYearFromDate($kerangkaAcuan->tanggal))
            ->andEqual(str_contains(request()->url(), 'lens'), false)
            ->andEqual(request()->viaResource, null)
            ->get();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, KerangkaAcuan $kerangkaAcuan): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota')
            ->withYear(Helper::getYearFromDate($kerangkaAcuan->tanggal))
            ->andEqual(
                $kerangkaAcuan->unit_kerja_id,
                optional(Helper::getDataPegawaiByUserId($user->id, now()))->unit_kerja_id
            )
            ->andEqual(str_contains(request()->url(), 'lens'), false)
            ->andEqual(request()->viaResource, null)
            ->get();
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, KerangkaAcuan $kerangkaAcuan): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota')
            ->withYear(Helper::getYearFromDate($kerangkaAcuan->tanggal))
            ->andEqual(
                $kerangkaAcuan->unit_kerja_id,
                optional(Helper::getDataPegawaiByUserId($user->id, now()))->unit_kerja_id
            )
            ->andEqual(str_contains(request()->url(), 'lens'), false)
            ->andEqual(request()->viaResource, null)
            ->get();
    }

    public function runAction(User $user, KerangkaAcuan $kerangkaAcuan): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota,ppk')
            ->withYear(Helper::getYearFromDate($kerangkaAcuan->tanggal))
            ->get();
    }

    public function detachDaftarSp2d(): bool
    {
        return false;
    }
}
