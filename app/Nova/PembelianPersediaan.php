<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\Download;
use App\Nova\Actions\ImportBarangFromSpesifikasiKerangkaAcuan;
use App\Nova\Actions\SetStatus;
use App\Nova\Filters\StatusFilter;
use App\Nova\Metrics\HelperPembelianPersediaan;
use App\Nova\Metrics\MetricPartition;
use App\Nova\Metrics\MetricTrend;
use App\Nova\Metrics\MetricValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\URL as UrlField;
use Laravel\Nova\Fields\URL as URLFields;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Notifications\NovaNotification;
use Laravel\Nova\Nova;
use Laravel\Nova\Panel;
use Laravel\Nova\URL;
use Laravelwebdev\Filepond\Filepond;

class PembelianPersediaan extends Resource
{
    public static $with = ['bastNaskahKeluar',  'kerangkaAcuan.naskahKeluar', 'daftarBarangPersediaans'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PembelianPersediaan>
     */
    public static $model = \App\Models\PembelianPersediaan::class;

    public static function label()
    {
        return 'Pembelian';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'rincian';

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
        'rincian',
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
            Date::make('Tanggal KAK', 'tanggal_kak')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                ->hideFromIndex()
                ->immutable(),
            BelongsTo::make('Nomor KAK', 'kerangkaAcuan', KerangkaAcuan::class)
                ->onlyOnDetail(),
            Text::make('Rincian')
                ->rules('required', 'max:255'),
            Panel::make('Keterangan Serah Terima Barang', [
                Date::make('Tanggal Nota', 'tanggal_nota')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                    ->rules('nullable', 'bail', 'after_or_equal:tanggal_kak', 'before_or_equal:today')
                    ->readonly(fn () => Policy::make()
                        ->allowedFor('bmn')
                        ->get()),
                BelongsTo::make('Nomor BAST', 'bastNaskahKeluar', NaskahKeluar::class)
                    ->onlyOnDetail(),

                Date::make('Tanggal BAST', 'tanggal_bast')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                    ->rules('nullable', 'bail', 'after_or_equal:tanggal_nota', 'before_or_equal:today')
                    ->canSee(fn () => Policy::make()
                        ->allowedFor('bmn')
                        ->get())
                    ->readonly(fn () => Policy::make()
                        ->allowedFor('pbj')
                        ->get()),
                Select::make('Pejabat Pembuat Komitmen', 'ppk_user_id')
                    ->searchable()
                    ->displayUsing(fn ($id) => optional(Helper::getPegawaiByUserId($id))->name)
                    ->dependsOn('tanggal_bast', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('ppk', $formData->date('tanggal_bast')))
                            ->default(Helper::setDefaultPengelola('ppk', $formData->date('tanggal_bast')));
                    })
                    ->canSee(fn () => Policy::make()
                        ->allowedFor('bmn')
                        ->get())
                    ->readonly(fn () => Policy::make()
                        ->allowedFor('pbj')
                        ->get()),
                Select::make('Pengelola Persediaan', 'pbmn_user_id')
                    ->rules('required')
                    ->searchable()
                    ->displayUsing(fn ($id) => optional(Helper::getPegawaiByUserId($id))->name)
                    ->dependsOn('tanggal_bast', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('bmn', $formData->date('tanggal_bast')))
                            ->default(Helper::setDefaultPengelola('bmn', $formData->date('tanggal_bast')));
                    })
                    ->canSee(fn () => Policy::make()
                        ->allowedFor('bmn,arsiparis')
                        ->get()),
            ]),
            Panel::make('Keterangan Pembukuan', [
                Date::make('Tanggal Buku', 'tanggal_buku')
                    ->rules('required', 'after_or_equal:tanggal_bast')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                    ->canSee(fn () => Policy::make()
                        ->allowedFor('bmn,arsiparis')
                        ->get()),
            ]),
            Panel::make('Arsip', [
                Filepond::make('Arsip Penerimaan', 'arsip')
                    ->disk('arsip')
                    ->onlyOnForms()
                    ->disableCredits()
                    ->mimesTypes(['application/pdf'])
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
                UrlField::make('Arsip', fn () => Storage::disk('arsip')
                    ->url($this->arsip))
                    ->displayUsing(fn () => 'Lihat')->exceptOnForms()
                    :
                Text::make('Arsip', fn () => null)->exceptOnForms(),
            ]),
            MorphMany::make('Daftar Barang Persediaan', 'daftarBarangPersediaans', BarangPersediaan::class),
        ];
    }

    public function fieldsforIndex(NovaRequest $request)
    {
        return [
            Stack::make('Nomor/Tanggal KAK', 'tanggal_kak', [
                BelongsTo::make('Nomor KAK', 'kerangkaAcuan', KerangkaAcuan::class),
                Date::make('Tanggal KAK', 'tanggal_kak')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Stack::make('Nomor/Tanggal BAST', 'tanggal_bast', [
                BelongsTo::make('Nomor', 'bastNaskahKeluar', NaskahKeluar::class),
                Date::make('Tanggal BAST', 'tanggal_bast')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Date::make('Tanggal Buku', 'tanggal_buku')
                ->sortable()
                ->filterable()
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            Text::make('Rincian'),
            Status::make('Status', 'status')
                ->loadingWhen(['dibuat', 'diterima'])
                ->failedWhen(['outdated']),
            $this->arsip ?
            URLFields::make('Arsip Penerimaan', fn () => Storage::disk('arsip')
                ->url($this->arsip))
                ->displayUsing(fn () => 'Lihat')->onlyOnIndex()
                :
            Text::make('Arsip Penerimaan', fn () => null)->onlyOnIndex(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        $model = PembelianPersediaan::whereYear('tanggal_kak', session('year'));

        return [
            HelperPembelianPersediaan::make()
                ->width('full'),
            MetricValue::make($model, 'total-pembelian-persediaan')
                ->refreshWhenActionsRun(),
            MetricTrend::make($model, 'tanggal_nota', 'trend-pembelian-persediaan')
                ->refreshWhenActionsRun(),
            MetricPartition::make($model, 'status', 'status-pembelian-persediaan')
                ->refreshWhenActionsRun()
                ->failedWhen(['outdated'])
                ->successWhen(['dicetak']),
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
            StatusFilter::make('pembelian_persediaans'),
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
        if (Policy::make()->allowedFor('pbj')->get()) {
            $actions[] =
            ImportBarangFromSpesifikasiKerangkaAcuan::make()
                ->confirmButtonText('Import')
                ->confirmText('Menggunakan Fitur Import akan menghapus data yang sebelumnya telah ada. Anda Yakin?')
                ->showInline()
                ->exceptOnIndex();
            $actions[] =
            SetStatus::make()
                ->confirmButtonText('Ubah Status')
                ->confirmText('Pastikan daftar barang yang diterima sudah sesuai baik jumlah, jenis, dan harganya. Apakah Anda yakin ingin mengubah status menjadi diterima?')
                ->onlyOnDetail()
                ->setName('Terima Barang')
                ->setStatus('diterima')
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }

                    return $this->resource instanceof Model && $this->resource->tanggal_nota !== null;
                })
                ->then(function ($models) {
                    $model = $models->first();
                    $users = Helper::getUsersByPengelola('bmn', $model->tanggal_nota);
                    foreach ($users as $user) {
                        $user->notify(
                            NovaNotification::make()
                                ->message('Terdapat Barang Persediaan yang harus diberi kode barang')
                                ->action('Lihat', URL::remote(Nova::path().'/resources/'.\App\Nova\PembelianPersediaan::uriKey().'/'.$model->id))
                                ->icon('information-circle')
                                ->type('info')
                        );
                    }
                });
        }
        if (Policy::make()->allowedFor('bmn')->get()) {
            $actions[] =
            Download::make('bastp', 'Unduh Pernyataan Penerimaan')
                ->showInline()
                ->showOnDetail()
                ->exceptOnIndex()
                ->confirmText('Sebelum mengunduh, pastikan semua barang persediaan telah diberi kode')
                ->confirmButtonText('Unduh');
        }

        return $actions;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->whereYear('tanggal_kak', session('year'));
    }
}
