<?php

namespace App\Helpers;

use App\Helpers\Helper;
use App\Models\PengadaanKecil;
use App\Models\Perjalanan;
use App\Models\Permintaan;
use Armancodes\DownloadLink\DownloadLinkGenerator;
use Armancodes\DownloadLink\Models\DownloadLink;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class CetakHelper
{
    /**
     * Cetak Surat Permintaan.
     *
     * @param  string  $no  Nomor Permintaan
     * @return void
     */
    public static function cetakPermintaan($no)
    {
        $data = Permintaan::where('nomor', '=', $no)->first();
        $templateProcessor = new TemplateProcessor(Storage::path('template/Template_permintaan.docx'));
        $templateProcessor->setValues([
            'nomor' => $data->nomor,
            'tanggal' => Helper::terbilangTanggal($data->tanggal),
            'rincian' => $data->rincian,
            'unit' => $data->unit,
            'program' => $data->program,
            'kegiatan' => $data->kegiatan,
            'kro' => $data->kro,
            'ro' => $data->ro,
            'komponen' => $data->komponen,
            'sub' => $data->sub,
            'akun' => $data->akun,
            'detail' => DB::table('poks')->where('id', '=', $data->detail)->first('detail')->detail,
            'volume' => $data->volume,
            'jumlah' => Helper::formatRupiah((float) $data->jumlah),
            'realisasi' => Helper::formatRupiah((float) $data->realisasi),
            'sisa' => Helper::formatRupiah((float) $data->sisa),
            'perkiraan' => Helper::formatRupiah((float) $data->perkiraan),
            'sisanett' => Helper::formatRupiah((float) $data->sisanett),
            'item' => $data->item,
            'tambahan_kak' => $data->tambahan_kak,
            'nama' => $data->nama,
            'nip' => $data->nip,
            'jabatan' => $data->jabatan,
            'survei' => $data->survei,
            'waktu' => $data->waktu,
            'awal' => Helper::terbilangTanggal($data->awal),
            'akhir' => Helper::terbilangTanggal($data->akhir),
            'ppk' => $data->ppk,
            'nipppk' => $data->nipppk,
            'terbilang_pagu' => Helper::terbilang((int) $data->jumlah, 'uw', ' rupiah'),
            'terbilang_perkiraan' => Helper::terbilang((int) $data->perkiraan, 'uw', ' rupiah'),
        ]);
        $templateProcessor->cloneRowAndSetValues('spek_no', Helper::formatSpek($data->spesifikasi));
        $templateProcessor->saveAs(Storage::path('public/permintaan/PMT'.explode('/', $no)[0].'.docx'));
        if (is_null(DownloadLink::where('file_path', '=', 'permintaan/PMT'.explode('/', $no)[0].'.docx')->first())) {
            $link = (new DownloadLinkGenerator)->disk('public')->filePath('permintaan/PMT'.explode('/', $no)[0].'.docx')->generate();
            DB::table('permintaans')->where('nomor', '=', $no)->update(['link' => url('download/'.$link)]);
        }
    }

    /**
     * Cetak Pengadaan.
     *
     * @param  string  $no  Nomor Permintaan
     * @return void
     */
    public static function cetakPengadaan($no)
    {
        $data = PengadaanKecil::where('nomor', '=', $no)->first();
        $templateProcessor = new TemplateProcessor(Storage::path('template/Template_pengadaan.docx'));
        $templateProcessor->setValues([
            'rincian' => $data->rincian,
            'tgl_proses' => Helper::terbilangTanggal($data->tgl_proses),
            'nomor' => $data->nomor,
            'tanggal' => Helper::terbilangTanggal($data->tanggal),
            'jenis' => $data->jenis,
            'perkiraan' => Helper::formatRupiah((float) $data->perkiraan),
            'tgl_sp' => Helper::terbilangTanggal($data->tgl_sp),
            'penyedia' => DB::table('penyedias')->where('id', '=', $data->penyedia)->first('penyedia')->penyedia,
            'penandatangan' => $data->penandatangan,
            'alamat' => $data->alamat,
            'jumlah_bayar' => Helper::formatRupiah((float) $data->jumlah_bayar),
            'program' => $data->program,
            'kegiatan' => $data->kegiatan,
            'kro' => $data->kro,
            'ro' => $data->ro,
            'komponen' => $data->komponen,
            'sub' => $data->sub,
            'akun' => $data->akun,
            'detail' => DB::table('poks')->where('id', '=', $data->detail)->first('detail')->detail,
            'waktu' => $data->waktu,
            'awal' => Helper::terbilangTanggal($data->awal),
            'akhir' => Helper::terbilangTanggal($data->akhir),
            'ppk' => $data->ppk,
            'nipppk' => $data->nipppk,
            'pbj' => $data->pbj,
            'nippbj' => $data->nippbj,
            'bendahara' => $data->bendahara,
            'nipbendahara' => $data->nipbendahara,

            'no_permintaan' => Helper::nomorPengadaan($data->tgl_proses, $data->kode),
            'no_sp' => Helper::nomorPengadaan($data->tgl_sp, $data->kode, 'sp'),
            'terbilang_jumlah_bayar' => Helper::terbilang((float) $data->jumlah_bayar, 'uw', 'rupiah'),
            'no_bast' => Helper::nomorPengadaan($data->akhir, $data->kode, 'bast'),
            'no_kuitansi' => Helper::nomorPengadaan($data->akhir, $data->kode, 'kwt'),
            'hari_bast' => Helper::terbilangHari($data->akhir),
            'terbilang_tgl_bast' => Helper::terbilangTanggal($data->akhir, 'l'),
        ]);
        $templateProcessor->cloneRowAndSetValues('spek_no', Helper::formatSpek($data->spesifikasi));
        $templateProcessor->cloneRowAndSetValues('spek_no', Helper::formatSpek($data->spesifikasi));
        $templateProcessor->cloneRowAndSetValues('spek_no', Helper::formatSpek($data->spesifikasi));
        $templateProcessor->saveAs(Storage::path('public/pengadaan_kecil/PK'.explode('/', $no)[0].'.docx'));
        if (is_null(DownloadLink::where('file_path', '=', 'pengadaan_kecil/PK'.explode('/', $no)[0].'.docx')->first())) {
            $link = (new DownloadLinkGenerator)->disk('public')->filePath('pengadaan_kecil/PK'.explode('/', $no)[0].'.docx')->generate();
            DB::table('pengadaan_kecils')->where('nomor', '=', $no)->update(['link' => url('download/'.$link)]);
        }
    }

    /**
     * Cetak SPD.
     *
     * @param  string  $no  Nomor SPD
     * @return void
     */
    public static function cetakSpd($no)
    {
        $data = Perjalanan::where('nomor', '=', $no)->first();
        $templateProcessor = new TemplateProcessor(Storage::path('template/Template_spd.docx'));
        $templateProcessor->setValues([
            'nomor' => $data->nomor,
            'tanggal' => Helper::terbilangTanggal($data->tanggal),
            'no_st' => $data->no_st,
            'tujuan_spd' => $data->tujuan_spd,
            'nama' => DB::table('pegawais')->where('id', '=', $data->nama)->first('nama')->nama,
            'nip' => $data->nip,
            'golongan' => $data->golongan,
            'pangkat' => $data->pangkat,
            'jabatan' => $data->jabatan,
            'waktu' => $data->waktu,
            'berangkat' => Helper::terbilangTanggal($data->berangkat),
            'kembali' => Helper::terbilangTanggal($data->kembali),
            'asal' => $data->asal,
            'tujuan' => $data->tujuan,
            'tempat_tujuan' => $data->tempat_tujuan,
            'angkutan' => $data->angkutan,
            'mak' => $data->mak,
            'ppk' => $data->ppk,
            'nipppk' => $data->nipppk,
            'kepala' => $data->kepala,
            'nipkepala' => $data->nipkepala,
        ]);
        $templateProcessor->saveAs(Storage::path('public/perjalanan/SPD'.explode('/', $no)[0].'.docx'));
        if (is_null(DownloadLink::where('file_path', '=', 'perjalanan/SPD'.explode('/', $no)[0].'.docx')->first())) {
            $link = (new DownloadLinkGenerator)->disk('public')->filePath('perjalanan/SPD'.explode('/', $no)[0].'.docx')->generate();
            DB::table('perjalanans')->where('nomor', '=', $no)->update(['link' => url('download/'.$link)]);
        }
    }

    /**
     * Cetak DPR.
     *
     * @param  string  $no  Nomor SPD
     * @return void
     */
    public static function cetakDpr($no)
    {
        $data = Perjalanan::where('nomor', '=', $no)->first();
        $templateProcessor = new TemplateProcessor(Storage::path('template/Template_dpr.docx'));
        $templateProcessor->setValues([
            'nomor' => $data->nomor,
            'tanggal' => Helper::terbilangTanggal($data->tanggal),
            'tujuan_spd' => $data->tujuan_spd,
            'nama' => DB::table('pegawais')->where('id', '=', $data->nama)->first('nama')->nama,
            'nip' => $data->nip,
            'golongan' => $data->golongan,
            'pangkat' => $data->pangkat,
            'jabatan' => $data->jabatan,
            'waktu' => $data->waktu,
            'berangkat' => Helper::terbilangTanggal($data->berangkat),
            'kembali' => Helper::terbilangTanggal($data->kembali),
            'asal' => $data->asal,
            'tujuan' => $data->tujuan,
            'mak' => $data->mak,
            'ppk' => $data->ppk,
            'nipppk' => $data->nipppk,
            'bendahara' => $data->bendahara,
            'nipbendahara' => $data->nipbendahara,
            'biaya_total' => Helper::formatRupiah(Helper::biayaSpd($data->biaya)),
            'biaya_terbilang' => Helper::terbilang(Helper::biayaSpd($data->biaya), 'uw', 'rupiah'),
            'jumlah_dpr' => Helper::formatRupiah(Helper::biayaSpd($data->biaya, 'jlh_dpr')),
        ]);
        $templateProcessor->cloneRowAndSetValues('spek_rincian', Helper::biayaSpd($data->biaya, 'real'));
        $templateProcessor->cloneRowAndSetValues('spek_rincian', Helper::biayaSpd($data->biaya, 'dpr'));
        $templateProcessor->saveAs(Storage::path('public/perjalanan/DPR'.explode('/', $no)[0].'.docx'));
        if (is_null(DownloadLink::where('file_path', '=', 'perjalanan/DPR'.explode('/', $no)[0].'.docx')->first())) {
            $link = (new DownloadLinkGenerator)->disk('public')->filePath('perjalanan/DPR'.explode('/', $no)[0].'.docx')->generate();
            DB::table('perjalanans')->where('nomor', '=', $no)->update(['link_dpr' => url('download/'.$link)]);
        }
    }
}
