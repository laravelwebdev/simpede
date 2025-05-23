<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Models\RapatInternal as ModelsRapatInternal;
use App\Nova\Actions\Download;
use App\Nova\Metrics\MetricKeberadaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravelwebdev\Filepond\Filepond;
use Laravelwebdev\Repeatable\Repeatable;
use Laravelwebdev\Time\Time;

class RapatInternal extends Resource
{
    public static $with = ['kasubbag', 'pimpinan', 'kepala', 'notulis', 'naskahKeluar'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\RapatInternal>
     */
    public static $model = \App\Models\RapatInternal::class;

    public static function label()
    {
        return 'Rapat Internal';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return Helper::terbilangTanggal($this->tanggal_rapat);
    }

    public function subtitle()
    {
        return $this->tema;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static function searchableColumns()
    {
        return ['naskahKeluar.nomor', 'tanggal', 'tema',  'agenda'];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Panel::make('Keterangan Rapat', [
                Date::make('Tanggal Rapat', 'tanggal_rapat')
                    ->sortable()
                    ->rules('required', function ($attribute, $value, $fail) {
                        if (Helper::getYearFromDateString($value) != session('year')) {
                            return $fail('Tanggal harus di tahun yang telah dipilih');
                        }
                    })
                    ->filterable()
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
                Text::make('Tema')
                    ->default('Rapat ')
                    ->help('Diawali dengan kata Rapat, contoh: Rapat Bulanan Pegawai Bulan Januari 2024')
                    ->rules('required', 'max:255'),
            ]),
            Panel::make('Undangan', [
                Date::make('Tanggal')
                    ->hideFromIndex()
                    ->rules('required', 'before_or_equal:today', 'before_or_equal:tanggal_rapat')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
                BelongsTo::make('Nomor', 'naskahKeluar', NaskahKeluar::class)
                    ->onlyOnDetail(),
                Text::make('Tujuan')
                    ->hideFromIndex()
                    ->default('Seluruh Pegawai BPS Kabupaten Hulu Sungai Tengah')
                    ->rules('required', 'max:80'),
                Text::make('Tempat')
                    ->hideFromIndex()
                    ->default('Aula BPS Kabupaten Hulu Sungai Tengah')
                    ->rules('required', 'max:80'),
                Time::make('Jam Mulai', 'mulai')
                    ->hideFromIndex()
                    ->rules('required'),
                Textarea::make('Agenda')
                    ->rules('required')
                    ->placeholder('1........')
                    ->alwaysShow(),
                Select::make('Kepala', 'kepala_user_id')
                    ->rules('required')
                    ->searchable()
                    ->hideFromIndex()
                    ->displayUsing(fn ($id) => optional(Helper::getPegawaiByUserId($id))->name)
                    ->dependsOn('tanggal', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('kepala', $formData->date('tanggal')))
                            ->default(Helper::setDefaultPengelola('kepala', $formData->date('tanggal')));
                    }),
            ]),
            Panel::make('Daftar Hadir', [
                Number::make('Jumlah Baris', 'baris')
                    ->hideFromIndex()
                    ->step(1)
                    ->default(30)
                    ->rules('required', 'integer', 'min:1'),
                Select::make('Kasubbag Umum', 'kasubbag_user_id')
                    ->rules('required')
                    ->searchable()
                    ->hideFromIndex()
                    ->displayUsing(fn ($id) => optional(Helper::getPegawaiByUserId($id))->name)
                    ->dependsOn('tanggal_rapat', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('kasubbag', $formData->date('tanggal_rapat')))
                            ->default(Helper::setDefaultPengelola('kasubbag', $formData->date('tanggal_rapat')));
                    }),
            ]),
            Panel::make('Notula', [
                Select::make('Pimpinan Rapat', 'pimpinan_user_id')
                    ->searchable()
                    ->hideFromIndex()
                    ->hideWhenCreating()
                    ->displayUsing(fn ($id) => optional(Helper::getPegawaiByUserId($id))->name)
                    ->dependsOn('tanggal_rapat', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('anggota', $formData->date('tanggal_rapat')));
                    }),
                Select::make('Notulis', 'notulis_user_id')
                    ->searchable()
                    ->hideFromIndex()
                    ->hideWhenCreating()
                    ->displayUsing(fn ($id) => optional(Helper::getPegawaiByUserId($id))->name)
                    ->dependsOn('tanggal_rapat', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('anggota', $formData->date('tanggal_rapat')));
                    }),
                Repeatable::make('Peserta Hadir', 'peserta', [
                    Select::make('Nama', 'peserta_user_id')
                        ->rules('required')
                        ->searchable()
                        ->displayUsing(fn ($id) => optional(Helper::getPegawaiByUserId($id))->name)
                        ->options(Helper::setOptionPengelola('anggota', now())),

                ])->hideWhenCreating(),
            ]),
            Panel::make('Arsip', [
                Filepond::make('Draft Notula', 'draft_notula')
                    ->disk('arsip')
                    ->disableCredits()
                    ->mimesTypes(['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                    ->hideWhenCreating()
                    ->onlyOnForms()
                    ->path(session('year').'/'.static::uriKey())
                    ->storeAs(function (Request $request) {
                        $originalName = pathinfo($request->draft_notula->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $request->draft_notula->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->prunable(),
                $this->draft_notula && in_array(Auth::user()->id, collect($this->peserta)->pluck('peserta_user_id')->toArray()) ?
                URL::make('Draft Notula', fn () => Storage::disk('arsip')
                    ->url($this->draft_notula))
                    ->displayUsing(fn () => 'Lihat')->onlyOndetail()
                    :
                Text::make('Draft Notula', fn () => null)->onlyOndetail(),
                Filepond::make('Undangan Signed', 'signed_undangan')
                    ->disk('arsip')
                    ->disableCredits()
                    ->mimesTypes(['application/pdf'])
                    ->hideWhenCreating()
                    ->onlyOnForms()
                    ->path(session('year').'/'.static::uriKey())
                    ->storeAs(function (Request $request) {
                        $originalName = pathinfo($request->signed_undangan->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $request->signed_undangan->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->prunable(),
                $this->signed_undangan ?
                URL::make('Undangan', fn () => Storage::disk('arsip')
                    ->url($this->signed_undangan))
                    ->displayUsing(fn () => 'Lihat')->exceptOnForms()
                    :
                Text::make('Undangan', fn () => null)->exceptOnForms(),
                Filepond::make('Daftar Hadir Signed', 'signed_daftar_hadir')
                    ->disk('arsip')
                    ->disableCredits()
                    ->mimesTypes(['application/pdf'])
                    ->hideWhenCreating()
                    ->onlyOnForms()
                    ->path(session('year').'/'.static::uriKey())
                    ->storeAs(function (Request $request) {
                        $originalName = pathinfo($request->signed_daftar_hadir->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $request->signed_daftar_hadir->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->prunable(),
                $this->signed_daftar_hadir ?
                URL::make('Daftar Hadir', fn () => Storage::disk('arsip')
                    ->url($this->signed_daftar_hadir))
                    ->displayUsing(fn () => 'Lihat')->exceptOnForms()
                    :
                Text::make('Daftar Hadir', fn () => null)->exceptOnForms(),
                Filepond::make('Notula Signed', 'signed_notula')
                    ->disk('arsip')
                    ->disableCredits()
                    ->mimesTypes(['application/pdf'])
                    ->hideWhenCreating()
                    ->onlyOnForms()
                    ->path(session('year').'/'.static::uriKey())
                    ->storeAs(function (Request $request) {
                        $originalName = pathinfo($request->signed_notula->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $request->signed_notula->getClientOriginalExtension();

                        return $originalName.'_'.uniqid().'.'.$extension;
                    })
                    ->prunable(),
                $this->signed_notula && in_array(Auth::user()->id, collect($this->peserta)->pluck('peserta_user_id')->toArray()) ?
                URL::make('Notula', fn () => Storage::disk('arsip')
                    ->url($this->signed_notula))
                    ->displayUsing(fn () => 'Lihat')->exceptOnForms()
                    :
                Text::make('Notula', fn () => null)->exceptOnForms(),
            ]),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        $model = ModelsRapatInternal::whereYear('tanggal_rapat', session('year'));

        return [
            MetricKeberadaan::make('Undangan', $model, 'signed_undangan', 'keberadaan-undangan')
                ->refreshWhenActionsRun(),
            MetricKeberadaan::make('Daftar Hadir', $model, 'signed_daftar_hadir', 'keberadaan-daftar-hadir')
                ->refreshWhenActionsRun(),
            MetricKeberadaan::make('Notula', $model, 'signed_notula', 'keberadaan-notula')
                ->refreshWhenActionsRun(),
        ];
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
        $actions = [
            Download::make('undangan', 'Unduh Undangan Rapat')
                ->showInline()
                ->showOnDetail()
                ->confirmButtonText('Unduh')
                ->exceptOnIndex(),
            Download::make('daftar_hadir', 'Unduh Template Daftar Hadir')
                ->showInline()
                ->showOnDetail()
                ->confirmButtonText('Unduh')
                ->exceptOnIndex(),
            Download::make('notula', 'Unduh Template Notula')
                ->showInline()
                ->showOnDetail()
                ->confirmButtonText('Unduh')
                ->exceptOnIndex()
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }

                    return $this->resource instanceof Model && ! empty($this->peserta);
                }),
        ];

        return $actions;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereYear('tanggal_rapat', session('year'));
    }

    protected static function afterValidation(NovaRequest $request, $validator)
    {
        if (Helper::cekGanda(json_decode($request->peserta), 'peserta_user_id')) {
            $validator->errors()->add('peserta', 'Terdapat duplikasi peserta');
        }
    }
}
