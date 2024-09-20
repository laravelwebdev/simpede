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

    protected $casts = [
        'tanggal' => 'date',
        'awal' => 'date',
        'akhir' => 'date',
    ];

    /**
     * Get the naskah_keluar that owns thekerangka acuan.
     */
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

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (KerangkaAcuan $kak) {
            $kode_naskah = KodeNaskah::cache()
                ->get('all')
                ->where('kategori', 'Surat Dinas')
                ->where('tata_naskah_id', Helper::getLatestTataNaskahId($kak->tanggal))
                ->first();
            $jenis_naskah = JenisNaskah::cache()
                ->get('all')
                ->where('jenis', 'Form Permintaan')
                ->where('kode_naskah_id', $kode_naskah->id)
                ->first();
            $kode_arsip = KodeArsip::cache()
                ->get('all')
                ->where('kode', 'KU.320')
                ->where('tata_naskah_id', Helper::getLatestTataNaskahId($kak->tanggal))
                ->first();
            $naskahkeluar = new NaskahKeluar;
            $naskahkeluar->tanggal = $kak->tanggal;
            $naskahkeluar->jenis_naskah_id = $jenis_naskah->id;
            $naskahkeluar->kode_arsip_id = $kode_arsip->id;
            $naskahkeluar->kode_naskah_id = $jenis_naskah->kode_naskah_id;
            $naskahkeluar->derajat = 'B';
            $naskahkeluar->tujuan = 'Pejabat Pembuat Komitmen';
            $naskahkeluar->perihal = 'Form Permintaan '.$kak->rincian;
            $naskahkeluar->generate = 'A';
            $naskahkeluar->save();
            $kak->naskah_keluar_id = $naskahkeluar->id;
        });
        static::updating(function (KerangkaAcuan $kak) {
            $naskahkeluar = NaskahKeluar::where('id', $kak->naskah_keluar_id)->first();
            $naskahkeluar->tanggal = $kak->tanggal;
            $naskahkeluar->perihal = 'Form Permintaan '.$kak->rincian;
            $naskahkeluar->save();
        });
        static::deleting(function (KerangkaAcuan $kak) {
            NaskahKeluar::destroy($kak->naskah_keluar_id);
            HonorSurvei::destroy($kak->id);
            $anggaranKerangkaAcuanIds = AnggaranKerangkaAcuan::where('kerangka_acuan_id', $kak->id)->pluck('id');
            AnggaranKerangkaAcuan::destroy($anggaranKerangkaAcuanIds);
            $arsipDokumenIds = ArsipDokumen::where('kerangka_acuan_id', $kak->id)->pluck('id');
            ArsipDokumen::destroy($arsipDokumenIds);
            $spesifikasiKerangkaAcuanIds = SpesifikasiKerangkaAcuan::where('kerangka_acuan_id', $kak->id)->pluck('id');
            SpesifikasiKerangkaAcuan::destroy($spesifikasiKerangkaAcuanIds);
        });
        static::created(function (KerangkaAcuan $kak) {
            ArsipDokumen::create(['slug' => 'Kerangka Acuan Kerja', 'kerangka_acuan_id' => $kak->id]);
            ArsipDokumen::create(['slug' => 'Form Permintaan', 'kerangka_acuan_id' => $kak->id]);
            ArsipDokumen::create(['slug' => 'SPM', 'kerangka_acuan_id' => $kak->id]);
            ArsipDokumen::create(['slug' => 'SP2D', 'kerangka_acuan_id' => $kak->id]);
            ArsipDokumen::create(['slug' => 'Surat Setoran Pajak', 'kerangka_acuan_id' => $kak->id]);
            ArsipDokumen::create(['slug' => 'SPJ', 'kerangka_acuan_id' => $kak->id]);
            ArsipDokumen::create(['slug' => 'Mutasi Rekening', 'kerangka_acuan_id' => $kak->id]);
            Nova::whenServing(function (NovaRequest $request) use ($kak) {
                $anggarans = AnggaranKerangkaAcuan::where('kerangka_acuan_id', $request->input('fromResourceId'))->get();
                foreach ($anggarans as $anggaran) {
                    $copyAnggaran = $anggaran->replicate();
                    $copyAnggaran->kerangka_acuan_id = $kak->id;
                    $copyAnggaran->save();
                }
                $spesifikasis = SpesifikasiKerangkaAcuan::where('kerangka_acuan_id', $request->input('fromResourceId'))->get();
                foreach ($spesifikasis as $spesifikasi) {
                    $copySpesifikasi = $spesifikasi->replicate();
                    $copySpesifikasi->kerangka_acuan_id = $kak->id;
                    $copySpesifikasi->save();
                }
            });
        });
        static::saving(function (KerangkaAcuan $kak) {
            if ($kak->jenis !== 'Penyedia') {
                $kak->metode = '-';
                $kak->tkdn = '-';
            }
            $dataKetua = Helper::getDataPegawaiByUserId($kak->koordinator_user_id, $kak->tanggal);
            $kak->unit_kerja_id = $dataKetua->unit_kerja_id;
        });
      
    }
}
