<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Rap2hpoutre\FastExcel\FastExcel;

class ExportTemplateCmsBri extends Action
{
    use InteractsWithQueue, Queueable;

    protected $type;

    protected $kegiatan;

    public function __construct($kegiatan, $type = 'ft')
    {
        $this->type = $type;
        $this->kegiatan = $kegiatan;
    }

    public function name()
    {
        return 'Export Template CMS BRI MASS '.strtoupper($this->type);
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        $collection = null;
        if ($this->type === 'ft') {
            $collection = Helper::makeCollectionForMassFt($model->id, now(), $fields->rekening_bendahara, $fields->remark);
            $count = $collection->count();
            $sum = $collection->sum('Amount');
            $summary = collect(
                [
                    [
                        'No' => 'COUNT',
                        'Sender Account' => $count,
                        'Benef Account' => '',
                        'Benef Name' => '',
                        'eMail' => '',
                        'Amount' => '',
                        'Currency' => '',
                        'Charge Type' => '',
                        'Voucher Code' => '',
                        'BI Trx Code' => '',
                        'Remark' => '',
                        'Reference Number' => '',
                    ],
                    [
                        'No' => 'TOTAL',
                        'Sender Account' => $sum,
                        'Benef Account' => '',
                        'Benef Name' => '',
                        'eMail' => '',
                        'Amount' => '',
                        'Currency' => '',
                        'Charge Type' => '',
                        'Voucher Code' => '',
                        'BI Trx Code' => '',
                        'Remark' => '',
                        'Reference Number' => '',
                    ],
                    [
                        'No' => 'DATE',
                        'Sender Account' => '',
                        'Benef Account' => '',
                        'Benef Name' => '',
                        'eMail' => '',
                        'Amount' => '',
                        'Currency' => '',
                        'Charge Type' => '',
                        'Voucher Code' => '',
                        'BI Trx Code' => '',
                        'Remark' => '',
                        'Reference Number' => '',
                    ],
                    [
                        'No' => 'TIME',
                        'Sender Account' => '',
                        'Benef Account' => '',
                        'Benef Name' => '',
                        'eMail' => '',
                        'Amount' => '',
                        'Currency' => '',
                        'Charge Type' => '',
                        'Voucher Code' => '',
                        'BI Trx Code' => '',
                        'Remark' => '',
                        'Reference Number' => '',
                    ],
                ]
            );
            $collection = $collection->merge($summary);
        } else {
            $collection = Helper::makeCollectionForMassCn($model->id, now(), $fields->rekening_bendahara, $fields->remark);
            $count = $collection->count();
            $sum = $collection->sum('Amount');
            $summary = collect(
                [
                    [
                        'No' => 'COUNT',
                        'Sender Account' => $count,
                        'Benef Account' => '',
                        'Benef Name' => '',
                        'Benef Address' => '',
                        'Benef Bank' => '',
                        'Benef eMail' => '',
                        'Amount' => '',
                        'Charge Type' => '',
                        'Remark' => '',
                        'Reference Number' => '',
                    ],
                    [
                        'No' => 'TOTAL',
                        'Sender Account' => $sum,
                        'Benef Account' => '',
                        'Benef Name' => '',
                        'Benef Address' => '',
                        'Benef Bank' => '',
                        'Benef eMail' => '',
                        'Amount' => '',
                        'Charge Type' => '',
                        'Remark' => '',
                        'Reference Number' => '',
                    ],
                    [
                        'No' => 'DATE',
                        'Sender Account' => '',
                        'Benef Account' => '',
                        'Benef Name' => '',
                        'Benef Address' => '',
                        'Benef Bank' => '',
                        'Benef eMail' => '',
                        'Amount' => '',
                        'Charge Type' => '',
                        'Remark' => '',
                        'Reference Number' => '',
                    ],
                    [
                        'No' => 'TIME',
                        'Sender Account' => '',
                        'Benef Account' => '',
                        'Benef Name' => '',
                        'Benef Address' => '',
                        'Benef Bank' => '',
                        'Benef eMail' => '',
                        'Amount' => '',
                        'Charge Type' => '',
                        'Remark' => '',
                        'Reference Number' => '',
                    ],
                ]
            );
            $collection = $collection->merge($summary);
        }
        $filename = $fields->filename.'.csv';
        (new FastExcel($collection))->configureCsv(delimiter: '|', enclosure: chr(0))->export(Storage::path('public/'.$filename));

        return Action::redirect(route('dump-download', [
            'filename' => $filename,
        ]));
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Text::make('Rekening Bendahara', 'rekening_bendahara')
                ->default(config('satker.rekening'))
                ->rules('required'),
            Text::make('Remark', 'remark')
                ->rules('required')
                ->default('Honor '.$this->kegiatan),
            Text::make('Nama File', 'filename')
                ->rules('required', 'alpha_dash:ascii')
                ->help('tanpa extensi file')
                ->default(fn () => uniqid()),
        ];
    }
}
