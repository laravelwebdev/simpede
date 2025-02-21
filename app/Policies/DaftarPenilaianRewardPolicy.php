<?php

namespace App\Policies;

use App\Helpers\Policy;
use App\Models\DaftarPenilaianReward;
use App\Models\RewardPegawai;
use App\Models\User;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class DaftarPenilaianRewardPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Nova::whenServing(function (NovaRequest $request) {
            if ($request->viaResource == 'reward-pegawais' || str_contains(request()->url(), 'reward-pegawais')) {
                return Policy::make()
                    ->allowedFor('all')
                    ->get();
            }

            return false;
        });
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
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DaftarPenilaianReward $daftar): bool
    {
        $status = RewardPegawai::find($daftar->reward_pegawai_id)->status;

        return Policy::make()
            ->allowedFor('kasubbag')
            ->andNotEqual($status, 'ditetapkan')
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
}
