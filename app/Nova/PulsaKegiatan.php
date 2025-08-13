<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\AnggaranKerangkaAcuan;
use App\Models\PulsaKegiatan as ModelsPulsaKegiatan;
use App\Nova\Actions\Download;
use App\Nova\Actions\ExportDaftarPulsa;
use App\Nova\Actions\SetStatus;
use App\Nova\Filters\StatusFilter;
use App\Nova\Metrics\MetricPartition;
use App\Nova\Metrics\MetricValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class PulsaKegiatan extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PulsaKegiatan>
     */
    public static $model = \App\Models\PulsaKegiatan::class;

    public static $with = ['mataAnggaran', 'jenisPulsa', 'unitKerja', 'daftarPulsaMitra', 'kerangkaAcuan'];

    public static function label()
    {
        return 'Pulsa Kegiatan';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'kegiatan';

    public function subtitle()
    {
        return Helper::terbilangBulan($this->bulan).' '.$this->tahun;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kegiatan', 'bulan', 'mataAnggaran.mak',
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->where('tahun', session('year'));
        if (Policy::make()->allowedFor('ppk,arsiparis,bendahara,kpa,ppspm,pbj')->get()) {
            return $query;
        } elseif (Policy::make()->allowedFor('koordinator,anggota')->get()) {
            return $query->where('unit_kerja_id', optional(Helper::getDataPegawaiByUserId($request->user()->id, now()))->unit_kerja_id);
        }

        return $query;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Hidden::make('Kerangka Acuan ID', 'kerangka_acuan_id'),
            Panel::make('Keterangan SPJ', [
                BelongsTo::make('Kerangka Acuan', 'kerangkaAcuan', \App\Nova\KerangkaAcuan::class)
                    ->sortable()
                    ->onlyOnDetail(),
                Text::make('Nama Kegiatan', 'kegiatan')
                    ->rules('required', 'max:255')
                    ->sortable()
                    ->help('Nama Kegiatan yang akan dibayarkan pulsanya. Contoh: Pelatihan Sakernas Februri 2025'),
                Date::make('Tanggal SPJ Tanda Terima', 'tanggal')
                    ->rules('required')
                    ->hideFromIndex()
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
                BelongsTo::make('Unit Kerja', 'unitKerja', UnitKerja::class)
                    ->showOnIndex(fn () => Policy::make()->allowedFor('ppk,ppspm,bendahara')->get())
                    ->exceptOnForms(),
            ]),
            Panel::make('Keterangan Pembayaran Pulsa', [
                Select::make('Bulan Pelaksanaan', 'bulan')
                    ->options(Helper::BULAN)
                    ->displayUsingLabels()
                    ->rules('required')
                    ->sortable()
                    ->searchable()
                    ->filterable(),
                Select::make('Jenis Kegiatan', 'jenis_pulsa_id')
                    ->dependsOn(['tanggal'], function (Select $field, NovaRequest $request, FormData $form) {
                        $field
                            ->options(Helper::setOptionJenisPulsa($form->tanggal));
                    })
                    ->rules('required')
                    ->searchable()
                    ->displayUsing(fn ($id) => optional(Helper::getJenisPulsaById($id))->jenis)
                    ->hideFromIndex(),
                Text::make('Link Konfirmasi dan Upload', 'link')
                    ->displayUsing(fn () => 'Salin')
                    ->exceptOnForms()
                    ->copyable(),
            ]),
            Panel::make('Anggaran', [
                BelongsTo::make('Mata Anggaran', 'mataAnggaran', MataAnggaran::class)
                    ->searchable()
                    ->withSubtitles()
                    ->hideFromIndex()
                    ->rules('required')
                    ->dependsOn('kerangka_acuan_id', function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                        $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($formData) {
                            $mataAnggaranIds = AnggaranKerangkaAcuan::where('kerangka_acuan_id', $formData->kerangka_acuan_id)
                                ->pluck('mata_anggaran_id');

                            return $query->whereIn('id', $mataAnggaranIds);
                        });
                    }),
            ]),
            Panel::make('Penanda Tangan', [
                Select::make('Pembuat Daftar', 'koordinator_user_id')
                    ->searchable()
                    ->hideFromIndex()
                    ->rules('required')
                    ->displayUsing(fn ($id) => optional(Helper::getPegawaiByUserId($id))->name)
                    ->dependsOn(['tanggal'], function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('koordinator', $formData->date('tanggal')))
                            ->default(Helper::setDefaultPengelola('koordinator', $formData->date('tanggal')));
                    }),
                Select::make('Pejabat Pembuat Komitmen', 'ppk_user_id')
                    ->searchable()
                    ->hideFromIndex()
                    ->rules('required')
                    ->displayUsing(fn ($id) => optional(Helper::getPegawaiByUserId($id))->name)
                    ->dependsOn(['tanggal'], function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('ppk', $formData->date('tanggal')))
                            ->default(Helper::setDefaultPengelola('ppk', $formData->date('tanggal')));
                    }),
            ]),
            Status::make('Status', 'status')
                ->loadingWhen(['open'])
                ->failedWhen([''])
                ->onlyOnIndex(),
            HasMany::make('Daftar Pulsa Mitra'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        $model = ModelsPulsaKegiatan::where('tahun', session('year'));
        if (Policy::make()->allowedFor('ppk,arsiparis,bendahara,kpa,ppspm')->get()) {
            $model = $model;
        } elseif (Policy::make()->allowedFor('koordinator,anggota')->get()) {
            $model = $model->where('unit_kerja_id', optional(Helper::getDataPegawaiByUserId($request->user()->id, now()))->unit_kerja_id);
        }

        return [
            MetricValue::make($model, 'total-pulsa')
                ->width('1/2')
                ->refreshWhenActionsRun(),
            MetricPartition::make($model, 'status', 'status-pulsa')
                ->refreshWhenActionsRun()
                ->width('1/2')
                ->failedWhen(['open'])
                ->successWhen(['selesai']),
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
            StatusFilter::make('pulsa_kegiatans'),
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
        $actions[] =
        Download::make('pulsa', 'Unduh Tanda Terima Pulsa')
            ->showInline()
            ->showOnDetail()
            ->exceptOnIndex()
            ->confirmButtonText('Unduh');
        $actions[] = SetStatus::make()
            ->confirmButtonText('Ubah Status')
            ->confirmText('Pastikan form dibuka jika hanya ada perbaikan isian. Yakin akan melanjutkan?')
            ->setName('Buka Form')
            ->setStatus('open')
            ->sole()
            ->showInline()
            ->exceptOnIndex()
            ->canSee(function ($request) {
                if ($request instanceof ActionRequest) {
                    return true;
                }

                return $this->resource instanceof Model && $this->resource->status !== 'open';
            });
        if (Policy::make()->allowedFor('ppk,pbj,ppspm,bendahara')->get()) {
            $actions[] =
            ExportDaftarPulsa::make()
                ->showInline()
                ->showOnDetail()
                ->exceptOnIndex()
                ->confirmButtonText('Unduh');
        }

        return $actions;
    }
}
