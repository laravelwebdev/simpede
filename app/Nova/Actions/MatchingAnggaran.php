<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\AnggaranKerangkaAcuan;
use App\Models\HonorKegiatan;
use App\Models\PerjalananDinas;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\DestructiveAction;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class MatchingAnggaran extends DestructiveAction
{
    use InteractsWithQueue;
    use Queueable;

    private $dipa_id;

    private $mak;

    public function __construct($dipa_id = null, $mak = null)
    {
        $this->dipa_id = $dipa_id;
        $this->mak = $mak;
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $mataAnggaran = $models->first();
        AnggaranKerangkaAcuan::where('mata_anggaran_id', $mataAnggaran->id)
            ->update(['mata_anggaran_id' => $fields->mata_anggaran]);
        HonorKegiatan::where('mata_anggaran_id', $mataAnggaran->id)
            ->update(['mata_anggaran_id' => $fields->mata_anggaran]);
        PerjalananDinas::where('mata_anggaran_id', $mataAnggaran->id)
            ->update(['mata_anggaran_id' => $fields->mata_anggaran]);
        $mataAnggaran->delete();

        return Action::message('Mata Anggaran berhasil di-matching');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Select::make('Mata Anggaran', 'mata_anggaran')
                ->rules('required')
                ->searchable()
                ->options(Helper::setOptionMataAnggaran($this->dipa_id, $this->mak)),

        ];
    }
}
