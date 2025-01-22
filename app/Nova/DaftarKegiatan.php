<?php

namespace App\Nova;

use App\Helpers\Fonnte;
use App\Helpers\Helper;
use App\Helpers\Policy;
use App\Models\DaftarKegiatan as ModelsDaftarKegiatan;
use App\Nova\Metrics\MetricPartition;
use App\Nova\Metrics\MetricTrend;
use App\Nova\Metrics\MetricValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\DestructiveAction;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravelwebdev\Repeatable\Repeatable;

class DaftarKegiatan extends Resource
{
    public static $with = ['daftarKegiatanable', 'daftarReminder'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\DaftarKegiatan>
     */
    public static $model = \App\Models\DaftarKegiatan::class;

    public static function label()
    {
        return 'Tanggal Penting';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'kegiatan';

    public function subtitle()
    {
        return Helper::terbilangTanggal($this->awal).' - '.Helper::terbilangTanggal($this->akhir);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'jenis', 'kegiatan', 'awal', 'akhir', 'status',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Panel::make('Keterangan', [
                Select::make('Jenis')
                    ->options(Helper::$jenis_kegiatan)
                    ->sortable()
                    ->filterable()
                    ->rules('required'),
                Text::make('Kegiatan')
                    ->sortable()
                    ->help('Contoh: Posting Konten Peringatan Hari Ibu')
                    ->rules('required'),
                Date::make('Tanggal', 'awal')
                    ->sortable()
                    ->filterable()
                    ->displayUsing(fn ($value) => Helper::terbilangTanggal($value))
                    ->rules('required'),
                Date::make('s.d Tanggal', 'akhir')
                    ->sortable()
                    ->hide()
                    ->displayUsing(fn ($value) => Helper::terbilangTanggal($value))
                    ->dependsOn(['jenis', 'awal'], function (Date $field, NovaRequest $request, FormData $formData) {
                        if ($formData->jenis == 'Kegiatan') {
                            $field
                                ->show()
                                ->rules('required', 'after_or_equal:awal')
                                ->setValue($formData->awal);
                        }
                    }),
                MorphTo::make('Penanggung Jawab', 'daftarKegiatanable')->types([
                    User::class,
                    UnitKerja::class,
                ])
                    ->searchable()
                    ->hide()
                    ->withSubtitles()
                    ->dependsOn(['jenis'], function (MorphTo $field, NovaRequest $request, FormData $formData) {
                        if ($formData->jenis != 'Libur') {
                            $field
                                ->show()
                                ->rules('required')
                                ->relatableQueryUsing(function (NovaRequest $request, Builder $query) {
                                    if ($request->resourceType === User::class) {
                                        $query->whereNull('inactive');
                                    }
                                });
                        }
                    }),
            ]),
            Text::make('Status')->exceptOnForms(),
            Panel::make('Reminder', [
                Select::make('WA Group', 'wa_group_id')
                    ->options(Helper::setOptionsWaGroup())
                    ->hide()
                    ->searchable()
                    ->displayUsingLabels()
                    ->dependsOn(['jenis'], function (Select $field, NovaRequest $request, FormData $formData) {
                        if ($formData->jenis === 'Deadline') {
                            $field
                                ->show()
                                ->rules('required');
                        }
                    })
                    ->hideFromIndex()
                    ->help('Jika Pilihan Group belum tersedia, tambahkan nomor ini ke dalam Group WA Anda: <b>'.config('fonnte.number').'</b> Kemudian hubungi Admin'),
                Textarea::make('Template Pesan', 'pesan')
                    ->hide()
                    ->help('Jangan hapus bagian {judul}.<br/> Gunakan {kegiatan} untuk mengganti dengan nama kegiatan,<br/> {tanggal} untuk mengganti tanggal deadline,<br/> {pj} untuk mengganti dengan penanggung jawab')
                    ->dependsOn(['jenis'], function (Textarea $field, NovaRequest $request, FormData $formData) {
                        if ($formData->jenis === 'Deadline') {
                            $field
                                ->show()
                                ->rules('required');
                        }
                    })
                    ->alwaysShow()
                    ->rows(15)
                    ->default('*{judul}*

Deadline : {tanggal}
Perihal : {kegiatan}
Penanggung jawab: *{pj}*
Keterangan Lain: Bisa ditambahkan data -data tentang AKB, dll

Mohon agar *mengirimkan* hasil desain dan _caption_ ke grup *maksimal H-1 hari kerja*  tanggal tayang ({tanggal})

Terimakasih ✨✨'),
                Heading::make('<p align="center">Waktu Kirim '.config('fonnte.hour').'</p>')->asHtml()
                    ->hide()
                    ->dependsOn(['jenis'], function (Heading $field, NovaRequest $request, FormData $formData) {
                        if ($formData->jenis === 'Deadline') {
                            $field
                                ->show();
                        }
                    }),
                Repeatable::make('Waktu Reminder', 'waktu_reminder', [
                    Number::make('H-', 'hari')
                        ->min(0)->max(30)
                        ->step(1)
                        ->help('Pesan akan dikirimkan jam 09.00 WITA dan dikirim ulang jika gagal pada jam 15.00 WITA')
                        ->rules('required', 'integer', 'gte:0', 'lte:30'),
                    Select::make('Referensi Waktu')
                        ->options(Helper::$waktu_reminder)
                        ->displayUsingLabels()
                        ->rules('required'),
                ])
                    ->hide()
                    ->dependsOn(['jenis'], function (Repeatable $field, NovaRequest $request, FormData $formData) {
                        if ($formData->jenis === 'Deadline') {
                            $field
                                ->show()
                                ->rules('required');
                        }
                    }),
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
        $model = ModelsDaftarKegiatan::whereYear('awal', session('year'));

        return [
            MetricValue::make($model, 'total-daftar-kegiatan')
                ->refreshWhenActionsRun(),
            MetricTrend::make($model, 'awal', 'trend-daftar-kegiatan')
                ->refreshWhenActionsRun(),
            MetricPartition::make($model, 'jenis', 'status-daftar-kegiatan')
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
        $actions = [];

        $actions[] =
            Action::using('Sinkronisasi Hari Libur', function (ActionFields $fields, Collection $models) {
                Helper::syncHariLibur(session('year'));
            })->standalone();
        $actions[] =
        Action::using('Stop Reminder', function (ActionFields $fields, Collection $models) {
            $model = $models->first();
            $model->query()->where('id', $model->id)->update(['status' => 'sent']);
            $model->daftarReminder()->update(['status' => 'sent']);
        })
            ->showInline()
            ->showOnDetail()
            ->canSee(function ($request) {
                if ($request instanceof ActionRequest) {
                    return true;
                }

                return $this->resource instanceof Model && ($this->jenis === 'Deadline');
            })
            ->exceptOnIndex();
        if (Policy::make()->allowedFor('admin')->get()) {
            $actions[] =
            DestructiveAction::using('Sinkronisasi WA Group', function (ActionFields $fields, Collection $models) {
                Fonnte::make()->updateWhatsappGroupList();
                $data = Fonnte::make()->getWhatsappGroupList();
                if ($data['data']['status']) {
                    Cache::forget('wa_group');
                    Cache::rememberForever('wa_group', fn () => $data['data']['data']);
                }
            })
                ->confirmText('Terlalu sering menggunanakan fitur ini dapat menyebabkan nomor Whatsapp Anda dibanned oleh Whatsapp. Apakah Anda yakin?')
                ->standalone();
        }

        return $actions;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereYear('awal', session('year'));
    }

    public function replicate()
    {
        return tap(parent::replicate(), function ($resource) {
            $model = $resource->model();
            $model->status = null;
            $model->awal = null;
            $model->akhir = null;
        });
    }
}
