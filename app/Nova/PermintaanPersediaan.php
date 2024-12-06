<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\Download;
use App\Nova\Filters\StatusFilter;
use App\Nova\Metrics\HelperPermintaanPersediaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class PermintaanPersediaan extends Resource
{
    public static $with = ['daftarBarangPersediaans', 'user', 'pbmn', 'naskahKeluar'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PermintaanPersediaan>
     */
    public static $model = \App\Models\PermintaanPersediaan::class;

    public static function label()
    {
        return 'Bon Permintaan';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'kegiatan';

    public function subtitle()
    {
        return 'Status: '.$this->status;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'user.name',
        'status',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Stack::make('Nomor/tanggal', 'tanggal_permintaan', [
                BelongsTo::make('Nomor', 'naskahKeluar', 'App\Nova\NaskahKeluar')
                    ->exceptOnForms(),
                Date::make('Tanggal', 'naskahKeluar.tanggal')
                    ->displayUsing(fn ($value) => Helper::terbilangTanggal($value)),
            ]),
            Date::make('Tanggal Permintaan', 'tanggal_permintaan')
                ->sortable()
                ->filterable()
                ->displayUsing(fn ($value) => Helper::terbilangTanggal($value))
                ->rules('required', 'before_or_equal:today')
                ->onlyOnForms()
                ->default(now()),
            Text::make('Untuk Kegiatan', 'kegiatan')
                ->rules('required'),
            Textarea::make('Catatan', 'keterangan')
                ->rules('required')
                ->alwaysShow(),
            BelongsTo::make('Pemohon', 'user', 'App\Nova\User')
                ->sortable()
                ->filterable()
                ->exceptOnForms(),
            Date::make('Tanggal Persetujuan', 'tanggal_persetujuan')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->sortable()
                ->filterable()
                ->hideWhenCreating()
                ->rules('nullable', 'bail', 'after_or_equal:tanggal_permintaan')
                ->canSee(fn () => Policy::make()
                    ->allowedFor('bmn')
                    ->get()),
            BelongsTo::make('Pengelola Persediaan', 'pbmn', 'App\Nova\User')
                ->exceptOnForms()
                ->sortable()
                ->canSee(fn () => Policy::make()
                    ->allowedFor('bmn')
                    ->get()),
            Select::make('Pengelola Persediaan', 'pbmn_user_id')
                ->searchable()
                ->onlyOnForms()
                ->hideWhenCreating()
                ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                ->dependsOn('tanggal_persetujuan', function (Select $field, NovaRequest $request, FormData $formData) {
                    $field->options(Helper::setOptionPengelola('bmn', Helper::createDateFromString($formData->tanggal_persetujuan)))
                        ->rules('required');
                })
                ->canSee(fn () => Policy::make()
                    ->allowedFor('bmn')
                    ->get()),
            Status::make('Status', 'status')
                ->loadingWhen(['dibuat'])
                ->failedWhen(['outdated']),
            Panel::make('Arsip', [
                File::make('Arsip BON', 'arsip')
                    ->disk('arsip')
                    ->rules('mimes:pdf')
                    ->acceptedTypes('.pdf')
                    ->hideWhenCreating()
                    ->path(session('year').'/'.static::uriKey())
                    ->storeAs(function (Request $request) {
                        $originalName = pathinfo($request->arsip->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $request->arsip->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->canSee(fn () => Policy::make()->allowedFor('bmn')->get())
                    ->prunable(),
                $this->arsip ?
                URL::make('Arsip BON', fn () => Storage::disk('arsip')
                    ->url($this->arsip))
                    ->displayUsing(fn () => 'Lihat')->onlyOnIndex()
                    :
                Text::make('Arsip BON', fn () => '—')->onlyOnIndex(),
            ]),
            MorphMany::make('Daftar Barang Persediaan', 'daftarBarangPersediaans', 'App\Nova\BarangPersediaan'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            HelperPermintaanPersediaan::make()
                ->width('full'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            StatusFilter::make('permintaan_persediaans'),
        ];
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
        if (Policy::make()->allowedFor('bmn')->get()) {
            $actions[] =
            Download::make('bon', 'Unduh Permintaan Persediaan')
                ->showInline()
                ->showOnDetail()
                ->exceptOnIndex()
                ->confirmButtonText('Unduh');
        }

        return $actions;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->whereYear('tanggal_permintaan', session('year'));
        if (! Policy::make()->allowedFor('bmn')->get()) {
            $query->where('user_id', $request->user()->id);
        }
    }
}
