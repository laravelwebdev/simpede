<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class HonorKegiatan extends Model
{
    use HasFactory;

    protected $fillable = ['status'];

    protected $casts = [
        'tanggal_spj' => 'date',
        'tanggal_sk' => 'date',
        'tanggal_st' => 'date',
        'tanggal_kak' => 'date',
        'awal' => 'date',
        'akhir' => 'date',
    ];

    /**
     * Get the kerangka acuan that owns the honor survei.
     */
    public function kerangkaAcuan(): BelongsTo
    {
        return $this->belongsTo(KerangkaAcuan::class);
    }

    public function skNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'sk_naskah_keluar_id');
    }

    public function stNaskahKeluar(): BelongsTo
    {
        return $this->belongsTo(NaskahKeluar::class, 'st_naskah_keluar_id');
    }

    /**
     * Get the daftar honor.
     */
    public function daftarHonorMitra(): HasMany
    {
        return $this->hasMany(DaftarHonorMitra::class);
    }

    public function daftarHonorPegawai(): HasMany
    {
        return $this->hasMany(DaftarHonorPegawai::class);
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saving(function (HonorKegiatan $honor) {
            if ($honor->isDirty()) {
                $honor->status = 'diubah';
            }
            if ($honor->jenis_honor !== 'Kontrak Mitra Bulanan') {
                $honor->bulan = null;
                $honor->jenis_kontrak = null;
            }
            if ($honor->isDirty('tahun')) {
                $DaftarHonorMitraIds = DaftarHonorMitra::where('honor_kegiatan_id', $honor->id)->pluck('id');
                DaftarHonorMitra::destroy($DaftarHonorMitraIds);
            }
            if (! $honor->generate_sk) {
                $honor->tanggal_sk = null;
                $honor->kpa_user_id = null;
                NaskahKeluar::destroy($honor->sk_naskah_keluar_id);
                $honor->sk_naskah_keluar_id = null;
            }
            if (! $honor->generate_st) {
                $honor->tanggal_st = null;
                $honor->uraian_tugas = null;
                $honor->kepala_user_id = null;
                $honor->kode_arsip_id = null;
                NaskahKeluar::destroy($honor->st_naskah_keluar_id);
                $honor->st_naskah_keluar_id = null;
            }
            if ($honor->jenis_honor !== null) {
                if ($honor->jenis_honor === 'Kontrak Mitra Bulanan') {
                    $kontrak = KontrakMitra::firstOrNew(
                        [
                            'jenis_kontrak' => $honor->jenis_kontrak,
                            'bulan' => $honor->bulan,
                            'tahun' => $honor->tahun,
                        ]
                    );
                    $kontrak->nama_kontrak = 'Kontrak '.Helper::getPropertyFromCollection(Helper::getJenisKontrakById($honor->jenis_kontrak), 'jenis').' Bulan '.Helper::$bulan[$honor->bulan];
                    $kontrak->status = 'dibuat';
                    $kontrak->jenis_honor = $honor->jenis_honor;
                    $kontrak->awal_kontrak = Carbon::createFromDate(session('year'), $honor->bulan)->startOfMonth();
                    $kontrak->akhir_kontrak = Carbon::createFromDate(session('year'), $honor->bulan)->endOfMonth();
                    $kontrak->save();
                }
                if ($honor->jenis_honor === 'Kontrak Mitra AdHoc') {
                    $kontrak = KontrakMitra::firstOrNew(
                        [
                            'honor_kegiatan_id' => $honor->id,
                        ]
                    );
                    $kontrak->nama_kontrak = 'Kontrak '.$honor->kegiatan;
                    $kontrak->tahun = $honor->tahun;
                    $kontrak->status = 'dibuat';
                    $kontrak->jenis_honor = $honor->jenis_honor;
                    $kontrak->awal_kontrak = $honor->awal;
                    $kontrak->akhir_kontrak = $honor->akhir;
                    $kontrak->save();
                }
                if ($honor->generate_sk) {
                    if ($honor->sk_naskah_keluar_id === null) {
                        $default_naskah = NaskahDefault::cache()->get('all')
                            ->where('jenis', 'sk')
                            ->first();
                        $naskahkeluar = new NaskahKeluar;
                        $naskahkeluar->tanggal = $honor->tanggal_sk;
                        $naskahkeluar->jenis_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'jenis_naskah_id');
                        $naskahkeluar->kode_arsip_id = Helper::getPropertyFromCollection($default_naskah, 'kode_arsip_id');
                        $naskahkeluar->derajat_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'derajat_naskah_id');
                        $naskahkeluar->tujuan = $honor->objek_sk;
                        $naskahkeluar->perihal = 'SK '.$honor->objek_sk;
                        $naskahkeluar->generate = 'A';
                        $naskahkeluar->save();
                        $honor->sk_naskah_keluar_id = $naskahkeluar->id;
                    } else {
                        if ($honor->isDirty('tanggal_sk')) {
                            $naskahkeluar = NaskahKeluar::where('id', $honor->sk_naskah_keluar_id)->first();
                            $naskahkeluar->tanggal = $honor->tanggal_sk;
                            $naskahkeluar->save();
                        }
                    }
                }

                if ($honor->generate_st) {
                    if ($honor->st_naskah_keluar_id === null) {
                        $default_naskah = NaskahDefault::cache()->get('all')
                            ->where('jenis', 'st')
                            ->first();
                        $naskahkeluar = new NaskahKeluar;
                        $naskahkeluar->tanggal = $honor->tanggal_st;
                        $naskahkeluar->jenis_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'jenis_naskah_id');
                        $naskahkeluar->kode_arsip_id = $honor->kode_arsip_id;
                        $naskahkeluar->derajat_naskah_id = Helper::getPropertyFromCollection($default_naskah, 'derajat_naskah_id');
                        $naskahkeluar->tujuan = $honor->objek_sk;
                        $naskahkeluar->perihal = 'Surat Tugas '.$honor->objek_sk;
                        $naskahkeluar->generate = 'A';
                        $naskahkeluar->save();
                        $honor->st_naskah_keluar_id = $naskahkeluar->id;
                    } else {
                        if ($honor->isDirty('tanggal_st')) {
                            $naskahkeluar = NaskahKeluar::where('id', $honor->st_naskah_keluar_id)->first();
                            $naskahkeluar->tanggal = $honor->tanggal_st;
                            $naskahkeluar->save();
                        }
                    }
                }
            }
        });
        static::deleting(function (HonorKegiatan $honor) {
            NaskahKeluar::destroy([$honor->sk_naskah_keluar_id, $honor->st_naskah_keluar_id]);
            $DaftarHonorMitraIds = DaftarHonorMitra::where('honor_kegiatan_id', $honor->id)->pluck('id');
            DaftarHonorMitra::destroy($DaftarHonorMitraIds);
        });
        static::creating(function (HonorKegiatan $honor) {
            $honor->status = 'dibuat';
        });
    }
}
