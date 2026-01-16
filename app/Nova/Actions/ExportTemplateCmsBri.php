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

    protected $kegiatan;

    public function __construct($kegiatan)
    {
        $this->kegiatan = $kegiatan;
    }

    public function name()
    {
        return 'Export Template QLOLA MASS ';
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
        $collection = Helper::makeCollectionForMassFt($model->id, now(), $fields->rekening_bendahara, $fields->remark);
        $count = $collection->count();
        $sum = $collection->sum('Amount');
        $summary = collect(
            [
                [
                    'No' => 'Total Records',
                    'CustRefNo' => '',
                    'InstructionCode' => $count,
                    'ValueDate' => '',
                    'Debit Account' => '',
                    'Sender Name' => '',
                    'BenBankIdentifier' => '',
                    'Credit Account' => '',
                    'Beneficiary Name' => '',
                    'Beneficiary Address' => '',
                    'Amount' => '',
                    'Currency' => '',
                    'TrxRemark' => '',
                    'Notification' => '',
                    'Charge Type' => '',
                    'FxCode' => '',
                    'Rate Voucher Code' => '',
                    'Sender Address' => '',
                    'Ben Mobile Number' => '',
                    'Sender Country Code' => '',
                    'Beneficiary Country Code' => '',
                    'BenBankName' => '',
                    'BenBankAddress' => '',
                    'BenBankCountryCode' => '',
                    'InterBankIdentifier' => '',
                    'InterBankName' => '',
                    'InterBankAddress' => '',
                    'InterBankCountryCode' => '',
                    'Beneficiary Category' => '',
                    'Beneficiary Relation' => '',
                    'BI Transaction Code' => '',
                    'Simodis Info' => '',
                    'Enrichment Details 1' => '',
                    'Enrichment Details 2' => '',
                    'Enrichment Details 3' => '',
                    'Enrichment Details 4' => '',
                ],
                [
                    'No' => 'Total Amount',
                    'CustRefNo' => '',
                    'InstructionCode' => $sum,
                    'ValueDate' => '',
                    'Debit Account' => '',
                    'Sender Name' => '',
                    'BenBankIdentifier' => '',
                    'Credit Account' => '',
                    'Beneficiary Name' => '',
                    'Beneficiary Address' => '',
                    'Amount' => '',
                    'Currency' => '',
                    'TrxRemark' => '',
                    'Notification' => '',
                    'Charge Type' => '',
                    'FxCode' => '',
                    'Rate Voucher Code' => '',
                    'Sender Address' => '',
                    'Ben Mobile Number' => '',
                    'Sender Country Code' => '',
                    'Beneficiary Country Code' => '',
                    'BenBankName' => '',
                    'BenBankAddress' => '',
                    'BenBankCountryCode' => '',
                    'InterBankIdentifier' => '',
                    'InterBankName' => '',
                    'InterBankAddress' => '',
                    'InterBankCountryCode' => '',
                    'Beneficiary Category' => '',
                    'Beneficiary Relation' => '',
                    'BI Transaction Code' => '',
                    'Simodis Info' => '',
                    'Enrichment Details 1' => '',
                    'Enrichment Details 2' => '',
                    'Enrichment Details 3' => '',
                    'Enrichment Details 4' => '',
                ],
            ]
        );
        $collection = $collection->merge($summary);

        $filename = $fields->filename.'.xlsx';
        (new FastExcel($collection))->export(Storage::disk('temp')->path($filename));

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
                ->rules('required', 'regex:/^[a-zA-Z0-9_\-\s]+$/', 'max:50'),
            Text::make('Nama File', 'filename')
                ->rules('required', 'regex:/^[a-zA-Z0-9_\-\s]+$/')
                ->help('tanpa extensi file')
                ->default(fn () => uniqid()),
        ];
    }
}
