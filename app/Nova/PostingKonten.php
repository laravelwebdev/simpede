<?php

namespace App\Nova;

use App\Helpers\Helper;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Select;
use App\Nova\Metrics\MetricTrend;
use App\Nova\Metrics\MetricValue;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Actions\SetStatusPostingKonten;
use App\Models\PostingKonten as ModelsPostingKonten;
use App\Nova\Metrics\JumlahPostingPerPegawai;
use App\Nova\Metrics\MetricPartition;

class PostingKonten extends Resource
{
    public static $with = ['user'];

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PostingKonten>
     */
    public static $model = \App\Models\PostingKonten::class;

    public static function label()
    {
        return 'Jadwal Posting Konten';
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return Helper::terbilangTanggal($this->tanggal);
    }

    public function subtitle()
    {
        return $this->kegiatan;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'kegiatan', 'user_id', 'tanggal',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Kategori')
                ->options(Helper::KATEGORI_KONTEN)
                ->sortable()
                ->displayUsingLabels()
                ->filterable()
                ->rules('required'),
            Text::make('Kegiatan')
                ->sortable()
                ->rules('required', 'max:255'),
            Date::make('Tanggal Posting', 'tanggal')
                ->sortable()
                ->displayUsing(fn ($value) => Helper::terbilangTanggal($value))
                ->rules('required', 'date'),
            Select::make('Prioritas')
                ->options(Helper::PRIORITAS)
                ->sortable()
                ->displayUsingLabels()
                ->filterable()
                ->hideFromIndex()
                ->rules('required'),
            Badge::make('Prioritas', 'prioritas')
                ->map([
                    'Rendah' => 'success',
                    'Sedang' => 'warning',
                    'Tinggi' => 'danger',
                ])
                ->onlyOnIndex(),

            BelongsTo::make('Penanggung Jawab', 'user', User::class)
                ->sortable()
                ->searchable()
                ->filterable()
                ->exceptOnForms()
                ->rules('required'),
            Select::make('Penanggung Jawab', 'user_id')
                ->searchable()
                ->onlyOnForms()
                ->rules('required')
                ->dependsOn(['tanggal'], function (Select $field, NovaRequest $request, FormData $form) {
                    $field->options(Helper::setOptionPengelola('anggota', $form->date('tanggal')));
                }),
            Select::make('Status')
                ->options(Helper::STATUS_KONTEN)
                ->sortable()
                ->displayUsingLabels()
                ->filterable()
                ->onlyOnDetail(),
            Badge::make('Status', 'status')
                ->map([
                    'Belum Mulai' => 'danger',
                    'Dalam Proses' => 'warning',
                    'Selesai' => 'success',
                    'Dibatalkan' => 'danger',
                    'Terlambat' => 'danger',
                    'Terlewat' => 'danger',
                ])
                ->onlyOnIndex(),
            Textarea::make('Isi Reminder', 'reminder')
                ->alwaysShow()
                ->dependsOn(['kegiatan', 'user_id', 'tanggal'], function (Textarea $field, NovaRequest $request, FormData $form) {
                    $activity = $form->string('kegiatan');
                    $employeeName = optional(Helper::getPegawaiByUserId($form->integer('user_id')))->name ?? 'Petugas';
                    $formattedTayang = Helper::terbilangTanggal($form->date('tanggal'));

                    $field->default(
                        '*_Persiapan Upload '.$activity."_*\r\n\r\n".
                        'Petugas: *'.$employeeName."*,\r\n".
                        'Tanggal Tayang: '.$formattedTayang."\r\n\r\n".
                        'Mohon untuk disiapkan tepat waktu yaa..'
                    );
                })
                ->rules('required'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        $model = ModelsPostingKonten::whereYear('tanggal', session('year'));

        return [
            MetricValue::make($model, 'total-posting-konten')
                ->width('1/3')
                ->refreshWhenActionsRun(),
            MetricTrend::make($model, 'tanggal', 'trend-posting-konten')
                ->refreshWhenActionsRun()
                ->width('1/3'),
            MetricPartition::make($model, 'status', 'partition-posting-konten')
                ->width('1/3')
                ->refreshWhenActionsRun(),
            JumlahPostingPerPegawai::make()
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
        return [
            SetStatusPostingKonten::make()->showInline(),
        ];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereYear('tanggal', session('year'));
    }
}
