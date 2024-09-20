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
        static::saved(function (KerangkaAcuan $kak) {
            if (Helper::sumJenisAkunHonor(AnggaranKerangkaAcuan::where('kerangka_acuan_id', $kak->id)->get()) == 1) {
                if ($honor = HonorSurvei::where('kerangka_acuan_id', $kak->id)->first()) {
                    $honor->judul_spj = 'Daftar Honor Petugas '.strtr($kak->kegiatan, ['Pemeriksaan' => 'Pemeriksa', 'Pencacahan' => 'Pencacah', 'Pengawasan' => 'Pengawas']);
                    $honor->awal = $kak->awal;
                    $honor->akhir = $kak->akhir;
                    $honor->tanggal_kak = $kak->tanggal;
                    $honor->tanggal_spj = $kak->akhir;
                    $honor->mak = Helper::getSingleAkunHonor(AnggaranKerangkaAcuan::where('kerangka_acuan_id', $kak->id)->get());
                    $honor->kegiatan = $kak->kegiatan;
                    if ($kak->wasChanged('tanggal')) {
                        $honor->generate_sk == 'Ya' ? $honor->tanggal_sk = $kak->tanggal : null;
                        $honor->generate_st == 'Ya' ? $honor->tanggal_st = $kak->tanggal : null;
                    }
                    $honor->save();
                } else {
                    $honor = new HonorSurvei;
                    $honor->kerangka_acuan_id = $kak->id;
                    $honor->judul_spj = 'Daftar Honor Petugas '.strtr($kak->kegiatan, ['Pemeriksaan' => 'Pemeriksa', 'Pencacahan' => 'Pencacah', 'Pengawasan' => 'Pengawas']);
                    $honor->awal = $kak->awal;
                    $honor->akhir = $kak->akhir;
                    $honor->mak = Helper::getSingleAkunHonor(AnggaranKerangkaAcuan::where('kerangka_acuan_id', $kak->id)->get());
                    $honor->kegiatan = $kak->kegiatan;
                    $honor->uraian_tugas = 'Melakukan '.$kak->kegiatan;
                    $honor->objek_sk = 'Petugas '.strtr($kak->kegiatan, ['Pemeriksaan' => 'Pemeriksa', 'Pencacahan' => 'Pencacah', 'Pengawasan' => 'Pengawas']);
                    $honor->generate_sk = 'Ya';
                    $honor->generate_st = 'Ya';
                    $honor->tanggal_kak = $kak->tanggal;
                    $honor->tanggal_spj = $kak->akhir;
                    $honor->tanggal_st = $kak->tanggal;
                    $honor->tanggal_sk = $kak->tanggal;
                    $honor->unit_kerja_id = $kak->unit_kerja_id;
                    $honor->ketua = $kak->nama;
                    $honor->nipketua = $kak->nip;
                    $honor->save();
                }
            }
            // if (Helper::isAkunHonorChanged($kak->getOriginal('anggaran'), $kak->anggaran)) {
            //     HonorSurvei::destroy($kak->id);
            // }
        });
    }
}
