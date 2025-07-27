<?php

namespace App\Models;

use Laravel\Nova\Nova;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PulsaKegiatan extends Model
{
    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function mataAnggaran(): BelongsTo
    {
        return $this->belongsTo(MataAnggaran::class);
    }

    public function jenisPulsa(): BelongsTo
    {
        return $this->belongsTo(JenisPulsa::class);
    }

    public function unitKerja(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class);
    }

    /**
     * Get the daftar pulsa mitra.
     */
    public function daftarPulsaMitra(): HasMany
    {
        return $this->hasMany(DaftarPulsaMitra::class);
    }

    private function replicateDaftarPulsaMitra(): void
    {
        Nova::whenServing(function (NovaRequest $request) {
            $fromResourceId = $request->input('fromResourceId');

            if ($fromResourceId) {
                $sourceKak = PulsaKegiatan::find($fromResourceId);
                $this->copyDaftar($fromResourceId);
            }
        });
    }

    private function copyDaftar($fromResourceId): void
    {
        $daftar = DaftarPulsaMitra::where('pulsa_kegiatan_id', $fromResourceId)->get();
        foreach ($daftar as $item) {
            $copyItem = $item->replicate();
            $copyItem->pulsa_kegiatan_id = $this->id;
            $copyItem->save();
        }
    }

    protected static function booted(): void
    {
        static::creating(function (PulsaKegiatan $pulsa) {
            $pulsa->tahun = session('year');
            $token = uniqid(Str::random(19));
            $pulsa->token = $token;
            $pulsa->link = url(config('nova.path')).'/pulsa/'.$token;
            $dataKetua = Helper::getDataPegawaiByUserId($pulsa->koordinator_user_id, $pulsa->tanggal);
            $pulsa->unit_kerja_id = optional($dataKetua)->unit_kerja_id;
        });
        static::deleting(function (PulsaKegiatan $pulsa) {
            $DaftarPulsaMitraIds = DaftarPulsaMitra::where('pulsa_kegiatan_id', $pulsa->id)->pluck('id');
            DaftarPulsaMitra::destroy($DaftarPulsaMitraIds);
        });
    }
}
