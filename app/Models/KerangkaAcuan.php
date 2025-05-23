<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class KerangkaAcuan extends Model
{
    protected $fillable = ['status', 'daftar_sp2d_id'];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'awal' => 'date',
            'akhir' => 'date',
        ];
    }

    public function naskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class);
    }

    public function unitKerja(): BelongsTo
    {
        return $this->belongsTo(UnitKerja::class);
    }

    public function daftarSp2d(): BelongsToMany
    {
        return $this->belongsToMany(DaftarSp2d::class, 'kak_sp2d');
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
            $kak->status = 'dibuat';
            $kak->createNaskahKeluar();
        });

        static::updating(function (KerangkaAcuan $kak) {
            $kak->status = $kak->status === 'dibuat' ? 'diubah' : 'outdated';
            $kak->updateNaskahKeluar();
            if ($kak->isDirty('dipa_id')) {
                $kak->deleteOldAnggaran();
            }
            if ($kak->isDirty(['tanggal', 'awal', 'akhir', 'kegiatan', 'dipa_id', 'rincian'])) {
                $dipa = Dipa::cache()->get('all')->where('id', $kak->dipa_id)->first();
                $honor = HonorKegiatan::where('kerangka_acuan_id', $kak->id)->first();
                if ($honor) {
                    $honor->generate_sk ? $honor->tanggal_sk = $kak->tanggal : null;
                    $honor->generate_st ? $honor->tanggal_st = $kak->tanggal : null;
                    $honor->judul_spj = 'Daftar Honor Petugas '.strtr($kak->kegiatan, ['Pemeriksaan' => 'Pemeriksa', 'Pencacahan' => 'Pencacah', 'Pengawasan' => 'Pengawas']);
                    $honor->kegiatan = $kak->kegiatan;
                    $honor->uraian_tugas = 'Melakukan '.$kak->kegiatan;
                    $honor->objek_sk = 'Petugas '.strtr($kak->kegiatan, ['Pemeriksaan' => 'Pemeriksa', 'Pencacahan' => 'Pencacah', 'Pengawasan' => 'Pengawas']);
                    $honor->tanggal_kak = $kak->tanggal;
                    $honor->tahun = optional($dipa)->tahun;
                    $honor->awal = $kak->awal;
                    $honor->akhir = $kak->akhir;
                    $honor->status = 'outdated';
                    $honor->save();
                }
                $pembelian = PembelianPersediaan::where('kerangka_acuan_id', $kak->id)->first();
                if ($pembelian) {
                    $pembelian->tanggal_kak = $kak->tanggal;
                    $pembelian->rincian = $kak->rincian;
                    $pembelian->status = 'outdated';
                    $pembelian->save();
                }
                $pemeliharaan = Pemeliharaan::where('kerangka_acuan_id', $kak->id)->first();
                if ($pemeliharaan) {
                    $pemeliharaan->tanggal_kak = $kak->tanggal;
                    $pemeliharaan->rincian = $kak->rincian;
                    $pemeliharaan->save();
                }
            }
        });

        static::deleting(function (KerangkaAcuan $kak) {
            $kak->deleteAssociatedRecords();
            $ids = PerjalananDinas::where('kerangka_acuan_id', $kak->id)->pluck('id');
            PerjalananDinas::destroy($ids);
        });

        static::created(function (KerangkaAcuan $kak) {
            $kak->createInitialArsipDokumen();
            $kak->replicateAnggaranAndSpesifikasi();
        });
        static::saving(function (KerangkaAcuan $kak) {
            $kak->setDefaultValues();
            $kak->setKoordinatorUnitKerja();
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
        $default_naskah = NaskahDefault::cache()->get('all')
            ->where('jenis', 'kak')
            ->first();
        $naskahkeluar->tanggal = $this->tanggal;
        $naskahkeluar->jenis_naskah_id = optional($default_naskah)->jenis_naskah_id;
        $naskahkeluar->kode_arsip_id = optional($default_naskah)->kode_arsip_id[0];
        $naskahkeluar->derajat_naskah_id = optional($default_naskah)->derajat_naskah_id;
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
            'Bukti Setor Pajak',
            'SPJ',
            'Mutasi Rekening',
            'Identifikasi RUP',
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
        $this->unit_kerja_id = optional($dataKetua)->unit_kerja_id;
    }

    public static function getKerangkaAcuans($coa, $search)
    {
        $kakIds = DB::table('anggaran_kerangka_acuans')
            ->select('kerangka_acuan_id')
            ->where('mata_anggaran_id', $coa)
            ->pluck('kerangka_acuan_id')
            ->toArray();

        return DB::table('kerangka_acuans')
            ->select(['id', 'rincian'])
            ->when($search, function ($query, $search) {
                return $query->where('rincian', 'like', '%'.$search.'%');
            })
            ->whereIn('id', $kakIds);
    }
}
