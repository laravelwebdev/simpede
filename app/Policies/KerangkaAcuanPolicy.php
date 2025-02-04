<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\KerangkaAcuan;
use App\Models\User;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class KerangkaAcuanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
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
            ->get();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // return Nova::whenServing(function (NovaRequest $request) {
        //     if ($request->viaResource == 'daftar-sp2ds' || str_contains(request()->url(), 'daftar-sp2ds')) {
        //         return false;
        //     }

            return Policy::make()
                ->allowedFor('koordinator,anggota')
                ->get();
        // });
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
                ->andEqual($kerangkaAcuan->unit_kerja_id, Helper::getDataPegawaiByUserId($user->id, now())->unit_kerja_id)
                ->get();
        }

        return Policy::make()
            ->allowedFor('arsiparis,ppspm')
            ->withYear(Helper::getYearFromDate($kerangkaAcuan->tanggal))
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
            ->andEqual($kerangkaAcuan->unit_kerja_id, Helper::getDataPegawaiByUserId($user->id, now())->unit_kerja_id)
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
            ->andEqual($kerangkaAcuan->unit_kerja_id, Helper::getDataPegawaiByUserId($user->id, now())->unit_kerja_id)
            ->get();
    }

    public function runAction(User $user, KerangkaAcuan $kerangkaAcuan): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota,ppk')
            ->withYear(Helper::getYearFromDate($kerangkaAcuan->tanggal))
            ->get();
    }

    public function attachDaftarSp2d()
    {
        return false;
    }

    public function attachAnyDaftarSp2d()
    {
        return false;
    }

    public function detachDaftarSp2d()
    {
        return false;
    }
}
