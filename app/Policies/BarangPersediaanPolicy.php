<?php

namespace App\Policies;

use App\Helpers\Policy;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class BarangPersediaanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return Nova::whenServing(function (NovaRequest $request) {
            if ($request->viaResource == 'pembelian-persediaans' || str_contains(request()->url(), 'pembelian-persediaans')) {
                return Policy::make()
                    ->allowedFor('pbj,bmn,arsiparis')
                    ->get();
            }
            if ($request->viaResource == 'permintaan-persediaans' || str_contains(request()->url(), 'permintaan-persediaans')) {
                return Policy::make()
                    ->allowedFor('koordinator,anggota,bmn')
                    ->get();
            }

            if ($request->viaResource == 'persediaan-keluars' || str_contains(request()->url(), 'persediaan-keluars')) {
                return Policy::make()
                    ->allowedFor('bmn')
                    ->get();
            }
            if ($request->viaResource == 'persediaan-masuks' || str_contains(request()->url(), 'persediaan-masuks')) {
                return Policy::make()
                    ->allowedFor('bmn')
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
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return Nova::whenServing(function (NovaRequest $request) {
            if ($request->viaResource == 'pembelian-persediaans' || str_contains(request()->url(), 'pembelian-persediaans')) {
                return Policy::make()
                    ->allowedFor('pbj')
                    ->get();
            }
            if ($request->viaResource == 'permintaan-persediaans' || str_contains(request()->url(), 'permintaan-persediaans')) {
                return Policy::make()
                    ->allowedFor('koordinator,anggota,bmn')
                    ->get();
            }

            if ($request->viaResource == 'persediaan-keluars' || str_contains(request()->url(), 'persediaan-keluars')) {
                return Policy::make()
                    ->allowedFor('bmn')
                    ->get();
            }
            if ($request->viaResource == 'persediaan-masuks' || str_contains(request()->url(), 'persediaan-masuks')) {
                return Policy::make()
                    ->allowedFor('bmn')
                    ->get();
            }

            return false;
        });
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(): bool
    {
        return Nova::whenServing(function (NovaRequest $request) {
            if ($request->viaResource == 'pembelian-persediaans' || str_contains(request()->url(), 'pembelian-persediaans')) {
                return Policy::make()
                    ->allowedFor('pbj,bmn')
                    ->get();
            }
            if ($request->viaResource == 'permintaan-persediaans' || str_contains(request()->url(), 'permintaan-persediaans')) {
                return Policy::make()
                    ->allowedFor('koordinator,anggota,bmn')
                    ->get();
            }
            if ($request->viaResource == 'persediaan-keluars' || str_contains(request()->url(), 'persediaan-keluars')) {
                return Policy::make()
                    ->allowedFor('bmn')
                    ->get();
            }
            if ($request->viaResource == 'persediaan-masuks' || str_contains(request()->url(), 'persediaan-masuks')) {
                return Policy::make()
                    ->allowedFor('bmn')
                    ->get();
            }

            return false;
        });
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        return Nova::whenServing(function (NovaRequest $request) {
            if ($request->viaResource == 'pembelian-persediaans' || str_contains(request()->url(), 'pembelian-persediaans')) {
                return Policy::make()
                    ->allowedFor('pbj')
                    ->get();
            }
            if ($request->viaResource == 'permintaan-persediaans' || str_contains(request()->url(), 'permintaan-persediaans')) {
                return Policy::make()
                    ->allowedFor('koordinator,anggota,bmn')
                    ->get();
            }
            if ($request->viaResource == 'persediaan-keluars' || str_contains(request()->url(), 'persediaan-keluars')) {
                return Policy::make()
                    ->allowedFor('bmn')
                    ->get();
            }
            if ($request->viaResource == 'persediaan-masuks' || str_contains(request()->url(), 'persediaan-masuks')) {
                return Policy::make()
                    ->allowedFor('bmn')
                    ->get();
            }

            return false;
        });
    }

    /**
     * Determine whether the user can replicate model.
     */
    public function replicate(): bool
    {
        return false;
    }

    public function runAction(): bool
    {
        return Policy::make()
            ->allowedFor('koordinator,anggota,bmn,pbj')
            ->get();
    }
}
