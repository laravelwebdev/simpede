<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\HonorKegiatan;
use App\Models\User;
use App\Nova\Actions\AddHasManyModel;
use App\Nova\Actions\EditRekening;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class DaftarHonorPegawai extends Resource
{
    public static $perPageViaRelationship = 10;
    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarHonorPegawai>
     */
    public static $model = \App\Models\DaftarHonorPegawai::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nip', 'nama',
    ];

    public function fields(NovaRequest $request)
    {
        $user = Helper::getPegawaiByUserId($this->user_id);
        return [
            Select::make('Nama Pegawai','user_id')
                ->rules('required')
                ->searchable()
                ->options(Helper::setOptionPengelola('anggota',Helper::getPropertyFromCollection(HonorKegiatan::where('id',$request->viaResourceId)->first(),'tanggal_spj')))
                ->creationRules('unique:daftar_honor_pegawais,user_id')
                ->updateRules('unique:daftar_honor_pegawais,user_id,{{resourceId}}')
                ->onlyOnForms(),
            Text::make('Nama' , fn() => $user->name)
                ->exceptOnForms(),
            Text::make('Golongan', fn() => Helper::getDataPegawaiByUserId($user->id, Helper::getPropertyFromCollection(HonorKegiatan::where('id',$request->viaResourceId)->first(),'tanggal_spj'))->golongan)
                ->exceptOnForms(),
            Number::make('Jumlah', 'volume')
                ->step(1)
                ->help('Kosongkan jika pegawai tidak diberi honor'),
            Currency::make('Harga Satuan', 'harga_satuan')
                ->currency('IDR')
                ->locale('id')
                ->help('Kosongkan jika pegawai tidak diberi honor')
                ->step(1),
            Currency::make('Bruto', fn() => $this->volume * $this->harga_satuan)
                ->currency('IDR')
                ->locale('id')
                ->exceptOnForms(),
            Number::make('Persentase Pajak (%)', 'persen_pajak')
                ->help('Kosongkan jika pegawai tidak diberi honor')
                ->dependsOn('user_id', function (Number $field, NovaRequest $request, FormData $formData) {
                        $field->setvalue(Helper::$pajakgolongan[Helper::getPropertyFromCollection(Helper::getDataPegawaiByUserId($formData->user_id, Helper::getPropertyFromCollection(HonorKegiatan::where('id', $request->viaResourceId)->first(),'tanggal_spj')),'golongan')?? 'I/a']);
                })->onlyOnForms(),
            Currency::make('Pajak', fn() => round($this->volume * $this->harga_satuan * $this->persen_pajak / 100,0,PHP_ROUND_HALF_UP))
                ->currency('IDR')
                ->locale('id')
                ->exceptOnForms(),
            Currency::make('Netto', fn() => $this->volume * $this->harga_satuan - round($this->volume * $this->harga_satuan * $this->persen_pajak / 100,0,PHP_ROUND_HALF_UP))
                ->currency('IDR')
                ->locale('id')
                ->exceptOnForms(),
            Text::make('Rekening', fn() => $user->rekening)
                ->exceptOnForms(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        $actions = [];
        if (Policy::make()->allowedFor('koordinator,anggota')->get()) {
            $actions [] =
                EditRekening::make('pegawai')->onlyInline();
        }

        return $actions;
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Nova\Resource  $resource
     * @return \Laravel\Nova\URL|string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/resources/honor-kegiatans/'.$request->viaResourceId.'#Daftar%20Honor=daftar-honor-pegawai';
    }
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/resources/honor-kegiatans/'.$request->viaResourceId.'#Daftar%20Honor=daftar-honor-pegawai';
    }
}