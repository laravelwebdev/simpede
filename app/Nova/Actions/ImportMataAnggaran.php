<?php

namespace App\Nova\Actions;

use App\Imports\MataAnggaransImport;
use App\Models\KamusAnggaran;
use App\Models\MataAnggaran;
use App\Models\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\Excel\Facades\Excel;

class ImportMataAnggaran extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        MataAnggaran::cache()->disable();
        KamusAnggaran::cache()->disable();
        MataAnggaran::where('tahun', session('year'))->delete();
        KamusAnggaran::where('tahun', session('year'))->delete();
        Excel::import(new MataAnggaransImport($fields->satker, $fields->wilayah), $fields->file);
        MataAnggaran::cache()->enable();
        MataAnggaran::cache()->update('all');
        KamusAnggaran::cache()->enable();
        KamusAnggaran::cache()->update('all');

        return Action::message('Mata Anggaran sukses diimport!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            File::make('File')
                ->rules('required', 'mimes:xlsx')
                ->acceptedTypes('.xlsx')->help('Data Lama Akan dihapus dan ditimpa data baru'),
            Text::make('Kode Satker', 'satker')
                ->default('428578')
                ->rules('required')
                ->help('Kode Satker, misal: 428578'),
            Text::make('Kode Wilayah', 'wilayah')
                ->default('15.00')
                ->rules('required')
                ->help('Kode Wilayah Satker, misal: 15.00'),
            Heading::make('File import diambil dari excel satudja, kemudian hapus seluruh baris baseline dan simpan sebagai file .xlsx'),
        ];
    }
}
