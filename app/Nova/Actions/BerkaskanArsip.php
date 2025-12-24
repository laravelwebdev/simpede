<?php

namespace App\Nova\Actions;

use App\Helpers\Helper;
use App\Models\KakSp2d;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravelwebdev\Numeric\Numeric;

class BerkaskanArsip extends Action
{
    use InteractsWithQueue;
    use Queueable;

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();
        $kerangkaAcuan = $model->kerangkaAcuan;
        $daftarSpd2d = $model->daftarSp2d;
        $mak = $kerangkaAcuan
            ->anggaranKerangkaAcuan
            ->map(fn ($item) => $item->mataAnggaran?->mak)
            ->filter() 
            ->unique()
            ->implode(', ');
        $arsip = $model->arsipKeuangan()->make();
        $arsip->kode_klasifikasi = $fields->kode_klasifikasi;
        $arsip->kode_unit_cipta = $fields->kode_unit_cipta;
        $arsip->tingkat_perkembangan = $fields->tingkat_perkembangan;
        $arsip->media_simpan = $fields->media_simpan;
        $arsip->kondisi = $fields->kondisi;
        $arsip->jumlah = $fields->jumlah;
        $arsip->kode_ruang = $fields->kode_ruang;
        $arsip->nomor_lemari = $fields->nomor_lemari;
        $arsip->uraian = 'SPM No: '.$daftarSpd2d->nomor_spp.' tanggal '.Helper::terbilangTanggal($daftarSpd2d->tanggal_spm).
        ' dengan SP2D No: '.$daftarSpd2d->nomor_sp2d.' tanggal '.Helper::terbilangTanggal($daftarSpd2d->tanggal_sp2d).' dengan rincian '.$kerangkaAcuan->rincian.' dengan MAK: '.$mak;
        $arsip->save();
        KakSp2d::where('id', $model->id)->update(['arsip_keuangan_id' => $arsip->id]);

        return Action::message('Arsip berhasil diberkaskan.');

    }

    /**
     * Get the fields available on the action.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Text::make('Kode Klasifikasi', 'kode_klasifikasi')
                ->rules('required', 'max:255')
                ->hideFromIndex()
                ->default('KU.320')
                ->sortable(),
            Text::make('Kode Unit Cipta', 'kode_unit_cipta')
                ->rules('required', 'max:255')
                ->hideFromIndex()
                ->default('6307200')
                ->sortable(),
            Text::make('Tingkat Perkembangan', 'tingkat_perkembangan')
                ->rules('required', 'max:255')
                ->hideFromIndex()
                ->default('Asli')
                ->sortable(),
            Text::make('Media Simpan', 'media_simpan')
                ->rules('required', 'max:255')
                ->hideFromIndex()
                ->default('Kertas')
                ->sortable(),
            Text::make('Kondisi', 'kondisi')
                ->rules('required', 'max:255')
                ->hideFromIndex()
                ->default('Baik')
                ->sortable(),
            Numeric::make('Jumlah Berkas', 'jumlah')
                ->rules('required', 'integer', 'min:1')
                ->default(1)
                ->hideFromIndex()
                ->sortable(),
            Text::make('Kode Ruang', 'kode_ruang')
                ->rules('required', 'max:255')
                ->hideFromIndex()
                ->default('GD.KEU')
                ->sortable(),
            Text::make('Nomor Ruang/Lemari/Box', 'nomor_lemari')
                ->rules('required', 'max:255')
                ->hideFromIndex()
                ->placeholder('01.1.1')
                ->sortable(),
        ];
    }
}
