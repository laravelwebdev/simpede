<?php

namespace App\Nova;

use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Nova\Actions\ImportBarangFromSpesifikasiKerangkaAcuan;
use App\Nova\Actions\SetStatus;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\MorphMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class PembelianPersediaan extends Resource
{
    public static $with = ['bastNaskahKeluar', 'kerangkaAcuan.naskahKeluar', 'daftarBarangPersediaans'];

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
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'rincian',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Hidden::make('Tanggal KAK', 'tanggal_kak'),
            Panel::make('Keterangan', [
                Text::make('Rincian')
                    ->rules('required'),
            ]),
            Panel::make('Keterangan Serah Terima Barang', [
                Date::make('Tanggal BAST', 'tanggal_bast')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal))
                    ->rules('nullable', 'bail', 'after_or_equal:tanggal_kak'),
                Select::make('Pejabat Pembuat Komitmen', 'ppk_user_id')
                    ->rules('required')
                    ->searchable()
                    ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                    ->dependsOn('tanggal_bast', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('ppk', Helper::createDateFromString($formData->tanggal_bast)));
                    }),
                Select::make('Pengelola Persediaan', 'pbmn_user_id')
                    ->rules('required')
                    ->searchable()
                    ->displayUsing(fn ($id) => Helper::getPropertyFromCollection(Helper::getPegawaiByUserId($id), 'name'))
                    ->dependsOn('tanggal_bast', function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->options(Helper::setOptionPengelola('bmn', Helper::createDateFromString($formData->tanggal_bast)));
                    }),
            ]),
            Panel::make('Keterangan Pembukuan', [
                Date::make('Tanggal Buku', 'tanggal_buku')
                    ->rules('nullable', 'bail', 'after_or_equal:tanggal_bast')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ]),
            MorphMany::make('Daftar Barang Persediaan', 'daftarBarangPersediaans', 'App\Nova\BarangPersediaan'),
        ];
    }

    public function fieldsforIndex(NovaRequest $request)
    {
        return [
            Stack::make('Nomor/Tanggal KAK', 'tanggal_kak', [
                BelongsTo::make('Nomor KAK', 'kerangkaAcuan', 'App\Nova\KerangkaAcuan'),
                Date::make('Tanggal BAST', 'tanggal_kak')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Stack::make('Nomor/Tanggal BAST', 'tanggal_bast', [
                BelongsTo::make('Nomor', 'bastNaskahKeluar', 'App\Nova\naskahKeluar'),
                Date::make('Tanggal BAST', 'tanggal_bast')
                    ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            ])->sortable(),
            Date::make('Tanggal Buku', 'tanggal_buku')
                ->displayUsing(fn ($tanggal) => Helper::terbilangTanggal($tanggal)),
            Text::make('Rincian'),
            Status::make('Status', 'status')
                ->loadingWhen(['dibuat', 'diterima'])
                ->failedWhen(['outdated']),

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
        if (Policy::make()->allowedFor('pbj')->get()) {
            $actions[] =
            ImportBarangFromSpesifikasiKerangkaAcuan::make()
                ->confirmButtonText('Import')
                ->confirmText('Menggunakan Fitur Import akan menghapus data yang sebelumnya telah ada. Anda Yakin?')
                ->showInline()
                // ->size('7xl')
                ->exceptOnIndex();
            $actions[] =
            SetStatus::make()
                ->confirmButtonText('Ubah Status')
                ->confirmText('Pastikan daftar barang yang diterima sudah sesuai baik jumlah, jenis, dan harganya. Apakah Anda yakin ingin mengubah status menjadi diterima?')
                ->onlyOnDetail()
                ->setName('Terima Barang')
                ->setStatus('diterima');
        }
        if (Policy::make()->allowedFor('bmn')->get()) {
            $actions[] =
            SetStatus::make()
                ->confirmButtonText('Ubah Status')
                ->confirmText('Pastikan semua barang sudah diberi kode. Apakah Anda yakin ingin mengubah status menjadi selesai?')
                ->onlyOnDetail()
                ->setName('Terima Barang')
                ->setStatus('selesai')
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }

                    return $this->resource instanceof Model && $this->resource->tanggal_bast !== null && $this->resource->tanggal_buku !== null;
                });
        }

        return $actions;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->whereYear('tanggal_kak', session('year'));
    }
}
