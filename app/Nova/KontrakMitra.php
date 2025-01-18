<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\KodeArsip;
use App\Models\NaskahDefault;
use App\Nova\Actions\GenerateKontrakMitra;
use App\Nova\Filters\StatusFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravelwebdev\Filepond\Filepond;

class KontrakMitra extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\KontrakMitra>
     */
    public static $model = \App\Models\KontrakMitra::class;

    public static $with = ['daftarKontrakMitra', 'jenisKontrak'];

    public static function label()
    {
        return 'Kontrak Mitra';
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('tahun', session('year'));
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nama_kontrak';

    public function subtitle()
    {
        return 'Tanggal SPK: '.Helper::terbilangTanggal($this->tanggal_spk);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'nama_kontrak', 'bulan', 'tanggal_spk', 'status',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Panel::make('Keterangan Kontrak', [
                Select::make('Jenis Kontrak/Honor', 'jenis_honor')
                    ->options(Helper::$jenis_honor)
                    ->displayUsingLabels()
                    ->sortable()
                    ->filterable()
                    ->searchable()
                    ->readonly(),
                Text::make('Nama Kontrak', 'nama_kontrak')
                    ->readonly(),
                Select::make('Bulan Kontrak', 'bulan')
                    ->options(Helper::$bulan)
                    ->readonly()
                    ->sortable()
                    ->searchable()
                    ->filterable()
                    ->exceptOnForms()
                    ->displayUsingLabels(),
                BelongsTo::make('Jenis Kegiatan', 'jenisKontrak', 'App\Nova\JenisKontrak')
                    ->filterable()
                    ->sortable()
                    ->exceptOnForms(),
                Date::make('Tanggal SPK', 'tanggal_spk')
                    ->rules('required', 'before_or_equal:awal_kontrak', 'before_or_equal:today')->displayUsing(function ($tanggal) {
                        return Helper::terbilangTanggal($tanggal);
                    })
                    ->readonly(! Policy::make()->allowedFor('ppk')->get())
                    ->filterable()
                    ->sortable(),
                Select::make('Klasifikasi Arsip', 'kode_arsip_id')
                    ->searchable()
                    ->hideFromIndex()
                    ->readonly(! Policy::make()->allowedFor('ppk')->get())
                    ->displayUsing(fn ($kode) => Helper::getPropertyFromCollection(KodeArsip::cache()->get('all')->where('id', $kode)->first(), 'kode'))
                    ->dependsOn(['tanggal_spk'], function (Select $field, NovaRequest $request, FormData $formData) {
                        $default_naskah = NaskahDefault::cache()
                            ->get('all')
                            ->where('jenis', 'kontrak')
                            ->first();
                        $field->rules('required')
                            ->options(Helper::setOptionsKodeArsip($formData->tanggal_spk, Helper::getPropertyFromCollection($default_naskah, 'kode_arsip_id')));
                    }),
                Date::make('Tanggal Mulai Pelaksanaan Kontrak', 'awal_kontrak')
                    ->rules('required', 'after_or_equal:tanggal_spk')->displayUsing(function ($tanggal) {
                        return Helper::terbilangTanggal($tanggal);
                    })
                    ->readonly(! Policy::make()->allowedFor('ppk')->get())
                    ->hideFromIndex(),
                Date::make('Tanggal Selesai Kontrak', 'akhir_kontrak')
                    ->rules('required', 'after_or_equal:awal')->displayUsing(function ($tanggal) {
                        return Helper::terbilangTanggal($tanggal);
                    })
                    ->readonly(! Policy::make()->allowedFor('ppk')->get())
                    ->hideFromIndex(),
                BelongsTo::make('Pejabat Pembuat Komitmen', 'ppk', 'App\Nova\User')
                    ->exceptOnForms()
                    ->sortable(),
                Select::make('Pejabat Pembuat Komitmen', 'ppk_user_id')
                    ->rules('required')
                    ->searchable()
                    ->readonly(! Policy::make()->allowedFor('ppk')->get())
                    ->onlyOnForms()
                    ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                    ->dependsOn('tanggal_spk', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('ppk', Helper::createDateFromString($formData->tanggal_spk)));
                    }),

                Status::make('Status', 'status')
                    ->loadingWhen(['dibuat', 'diubah'])
                    ->failedWhen(['outdated'])
                    ->onlyOnIndex(),
            ]),
            Panel::make('Arsip', [
                Filepond::make('File')
                    ->disk('arsip')
                    ->disableCredits()
                    ->onlyOnForms()
                    ->mimesTypes(['application/pdf'])
                    ->path(session('year').'/'.static::uriKey())
                    ->storeAs(function (Request $request) {
                        $originalName = pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $request->file->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->canSee(fn () => Policy::make()->allowedFor('arsiparis')->get())
                    ->prunable(),
                $this->file ?
                URL::make('Arsip', fn () => Storage::disk('arsip')
                    ->url($this->file))
                    ->displayUsing(fn () => 'Lihat')->exceptOnForms()
                    :
                Text::make('Arsip', fn () => '—')->exceptOnForms(),
            ]),
            HasMany::make('Daftar Kontrak Mitra'),
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
        return [
            StatusFilter::make('kontrak_mitras'),
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
        if (Policy::make()->allowedFor('ppk')->get()) {
            $actions[] =
            GenerateKontrakMitra::make()
                ->showInline()
                ->showOnDetail()
                ->confirmButtonText('Generate')
                ->exceptOnIndex();
        }

        return $actions;
    }
}
