<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class KerangkaAcuan extends Model
{
    use HasFactory;

    protected $fillable = ['status'];

    protected $casts = [
        'tanggal' => 'date',
        'awal' => 'date',
        'akhir' => 'date',
    ];

    public function naskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class);
    }

    public function arsipDokumen(): HasMany
    {
        return $this->hasMany(ArsipDokumen::class);
    }

    public function anggaranKerangkaAcuan(): HasMany
    {
        return $this->hasMany(AnggaranKerangkaAcuan::class);
    }

    public function spesifikasiKerangkaAcuan(): HasMany
    {
        return $this->hasMany(SpesifikasiKerangkaAcuan::class);
    }

    protected static function booted(): void
    {
        static::creating(function (KerangkaAcuan $kak) {
            $kak->createNaskahKeluar();
        });

        static::updating(function (KerangkaAcuan $kak) {
            $kak->updateNaskahKeluar();
            if ($kak->isDirty('dipa_id')) {
                $kak->deleteOldAnggaran();
            }
            if ($kak->isDirty('tanggal')) {
                $honor = HonorKegiatan::where('kerangka_acuan_id', $kak->id)->first();
                $honor->generate_sk ? $honor->tanggal_sk = $kak->tanggal : null;
                $honor->generate_st ? $honor->tanggal_st = $kak->tanggal : null;
            }
        });

        static::deleting(function (KerangkaAcuan $kak) {
            $kak->deleteAssociatedRecords();
        });

        static::created(function (KerangkaAcuan $kak) {
            $kak->createInitialArsipDokumen();
            $kak->replicateAnggaranAndSpesifikasi();
        });
        static::saving(function (KerangkaAcuan $kak) {
            $kak->setDefaultValues();
            $kak->setKoordinatorUnitKerja();
            if ($kak->isDirty()) {
                $kak->status = 'dibuat';
            }
        });
    }

    private function createNaskahKeluar(): void
    {
        $naskahkeluar = new NaskahKeluar;
        $this->setNaskahKeluarAttributes($naskahkeluar);
        $naskahkeluar->save();
        $this->naskah_keluar_id = $naskahkeluar->id;
    }

    private function setNaskahKeluarAttributes(NaskahKeluar $naskahkeluar): void
    {
        $kode_naskah = KodeNaskah::cache()->get('all')
            ->where('kategori', 'Surat Dinas')
            ->where('tata_naskah_id', Helper::getLatestTataNaskahId($this->tanggal))->first();

        $jenis_naskah = JenisNaskah::cache()->get('all')
            ->where('jenis', 'Form Permintaan')
            ->where('kode_naskah_id', Helper::getPropertyFromCollection($kode_naskah, 'id'))->first();

        $kode_arsip = KodeArsip::cache()->get('all')
            ->where('kode', 'KU.320')
            ->where('tata_naskah_id', Helper::getLatestTataNaskahId($this->tanggal))->first();

        $naskahkeluar->tanggal = $this->tanggal;
        $naskahkeluar->jenis_naskah_id = Helper::getPropertyFromCollection($jenis_naskah, 'id');
        $naskahkeluar->kode_arsip_id = $kode_arsip->id;
        $naskahkeluar->kode_naskah_id = Helper::getPropertyFromCollection($jenis_naskah, 'kode_naskah_id');
        $naskahkeluar->derajat = 'B';
        $naskahkeluar->tujuan = 'Pejabat Pembuat Komitmen';
        $naskahkeluar->perihal = 'Form Permintaan '.$this->rincian;
        $naskahkeluar->generate = 'A';
    }

    private function updateNaskahKeluar(): void
    {
        $naskahkeluar = NaskahKeluar::find($this->naskah_keluar_id);
        if ($naskahkeluar) {
            $naskahkeluar->tanggal = $this->tanggal;
            $naskahkeluar->perihal = 'Form Permintaan '.$this->rincian;
            $naskahkeluar->save();
        }
    }

    private function deleteOldAnggaran(): void
    {
        $anggaranKerangkaAcuanIds = AnggaranKerangkaAcuan::where('kerangka_acuan_id', $this->id)->pluck('id');
        AnggaranKerangkaAcuan::destroy($anggaranKerangkaAcuanIds);
    }

    private function deleteAssociatedRecords(): void
    {
        NaskahKeluar::destroy($this->naskah_keluar_id);
        $this->deleteOldAnggaran();
        ArsipDokumen::destroy(ArsipDokumen::where('kerangka_acuan_id', $this->id)->pluck('id'));
        SpesifikasiKerangkaAcuan::destroy(SpesifikasiKerangkaAcuan::where('kerangka_acuan_id', $this->id)->pluck('id'));
    }

    private function createInitialArsipDokumen(): void
    {
        $slugs = [
            'Kerangka Acuan Kerja',
            'Form Permintaan',
            'SPM',
            'SP2D',
            'Surat Setoran Pajak',
            'SPJ',
            'Mutasi Rekening',
        ];

        foreach ($slugs as $slug) {
            $arsipDokumen = new ArsipDokumen;
            $arsipDokumen->slug = $slug;
            $arsipDokumen->kerangka_acuan_id = $this->id;
            $arsipDokumen->save();

        }
    }

    private function replicateAnggaranAndSpesifikasi(): void
    {
        Nova::whenServing(function (NovaRequest $request) {
            $fromResourceId = $request->input('fromResourceId');

            if ($fromResourceId) {
                $sourceKak = KerangkaAcuan::find($fromResourceId);
                if ($this->dipa_id == $sourceKak->dipa_id) {
                    $this->copyAnggaran($fromResourceId);
                    $this->copySpesifikasi($fromResourceId);
                }
            }
        });
    }

    private function copyAnggaran($fromResourceId): void
    {
        $anggarans = AnggaranKerangkaAcuan::where('kerangka_acuan_id', $fromResourceId)->get();
        foreach ($anggarans as $anggaran) {
            $copyAnggaran = $anggaran->replicate();
            $copyAnggaran->kerangka_acuan_id = $this->id;
            $copyAnggaran->save();
        }
    }

    private function copySpesifikasi($fromResourceId): void
    {
        $spesifikasis = SpesifikasiKerangkaAcuan::where('kerangka_acuan_id', $fromResourceId)->get();
        foreach ($spesifikasis as $spesifikasi) {
            $copySpesifikasi = $spesifikasi->replicate();
            $copySpesifikasi->kerangka_acuan_id = $this->id;
            $copySpesifikasi->save();
        }
    }

    private function setDefaultValues(): void
    {
        if ($this->jenis !== 'Penyedia') {
            $this->metode = '-';
            $this->tkdn = '-';
        }
    }

    private function setKoordinatorUnitKerja(): void
    {
        $dataKetua = Helper::getDataPegawaiByUserId($this->koordinator_user_id, $this->tanggal);
        $this->unit_kerja_id = Helper::getPropertyFromCollection($dataKetua, 'unit_kerja_id');
    }
}
