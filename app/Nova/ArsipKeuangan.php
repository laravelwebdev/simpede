<?php

namespace App\Nova;

use App\Helpers\Policy;
use App\Nova\Actions\Download;
use App\Nova\Actions\ExportTemplateSekar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasManyThrough;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;

class ArsipKeuangan extends Resource
{
    public static $with = ['daftarBerkas', 'arsipDokumens'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ArsipKeuangan>
     */
    public static $model = \App\Models\ArsipKeuangan::class;

    public static function label()
    {
        return 'Master Folder';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return '['.$this->kurun_awal.'] '.$this->kode_ruang.'.'.$this->nomor_lemari.'.'.$this->nomor;
    }

    public function subtitle()
    {
        return $this->kurun_awal;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nomor',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Folder', function () {
                return '['.$this->kurun_awal.'] '.$this->kode_ruang.'.'.$this->nomor_lemari.'.'.$this->nomor;
            })->onlyOnIndex(),
            Text::make('Kode Klasifikasi', 'kode_klasifikasi')
                ->rules('required', 'max:255')
                ->default('KU.320')
                ->hideFromIndex()
                ->sortable(),
            Text::make('Kode Unit Cipta', 'kode_unit_cipta')
                ->rules('required', 'max:255')
                ->hideFromIndex()
                ->default('6307200')
                ->sortable(),
            Text::make('Uraian')
                ->exceptOnForms()
                ->sortable(),
            Text::make('Tahun', 'kurun_awal')
                ->exceptOnForms()
                ->sortable(),
            Text::make('Kurun Akhir', 'kurun_akhir')
                ->onlyOnDetail()
                ->sortable(),
            Text::make('Tingkat Perkembangan', 'tingkat_perkembangan')
                ->rules('required', 'max:255')
                ->hideFromIndex()
                ->default('Asli')
                ->sortable(),
            Text::make('Media Simpan', 'media_simpan')
                ->rules('required', 'max:255')
                ->hideFromIndex()
                ->default('Kertas')
                ->sortable(),
            Text::make('Kondisi', 'kondisi')
                ->rules('required', 'max:255')
                ->hideFromIndex()
                ->default('Baik')
                ->sortable(),
            Numeric::make('Jumlah Berkas', 'jumlah')
                ->rules('required', 'integer', 'min:1')
                ->default(1)
                ->hideFromIndex()
                ->sortable(),
            Text::make('Kode Ruang', 'kode_ruang')
                ->rules('required', 'max:255')
                ->hideFromIndex()
                ->default('GD.KEU')
                ->sortable(),
            Text::make('Nomor Ruang/Lemari/Box', 'nomor_lemari')
                ->rules('required', 'max:255')
                ->hideFromIndex()
                ->placeholder('01.1.1')
                ->sortable(),
            Text::make('Nomor Folder', 'nomor')
                ->exceptOnForms()
                ->hideFromIndex()
                ->sortable(),

            HasManyThrough::make('Daftar Berkas', 'arsipDokumens', ArsipDokumen::class),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        $actions = [];
        if (Policy::make()->allowedFor('admin,arsiparis')->get()) {
            $actions[] =
                ExportTemplateSekar::make()->showInline();
        }
        $actions[] = Download::make('daftar_berkas', 'Unduh Daftar Berkas')
            ->sole()
            ->showInline()
            ->confirmButtonText('Unduh');

        return $actions;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('kurun_awal', session('year'));
    }
}
