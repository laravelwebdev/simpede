<?php

namespace App\Helpers;

use App\Models\KerangkaAcuan;
use App\Models\NaskahKeluar;
use App\Models\UnitKerja;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class Cetak
{
    /**
     * Cetak Dokumen.
     *
     * @param  string  $jenis  kak|spj|sk|st|dpr|spd|bon
     * @param  string  $id
     * @return string
     */
    public static function cetak($jenis, $id)
    {
        $templateProcessor = new TemplateProcessor(Helper::getTemplatePath($jenis));
        $data = call_user_func('App\Helpers\Cetak::'.$jenis, $id);
        if ($jenis === 'kak') {
            $templateProcessor->cloneRowAndSetValues('no', Helper::formatAnggaran($data['anggaran']));
            $templateProcessor->cloneRowAndSetValues('spek_no', Helper::formatSpek($data['spesifikasi']));
            unset($data['anggaran'], $data['spesifikasi']);
        }
        $templateProcessor->setValues($data);
        $filename = $jenis.'_'.session('year').'_'.explode('/', $data['nomor'])[0].'.docx';
        $templateProcessor->saveAs(Storage::path('public/'.$jenis.'/'.$filename));

        return $filename;
    }

    /**
     * Cetak Surat Permintaan.
     *
     * @param  string  $no  Nomor Permintaan
     * @return void
     */
    public static function kak($id)
    {
        $data = KerangkaAcuan::find($id);

        return [
            'nomor' => NaskahKeluar::find($data->naskah_keluar_id)->nomor,
            'tanggal' => Helper::terbilangTanggal($data->tanggal),
            'rincian' => Helper::hapusTitikAkhirKalimat($data->rincian),
            'unit' => UnitKerja::cache()->get('all')->where('id', $data->unit_kerja_id)->first()->unit,
            'latar_belakang' => Helper::hapusTitikAkhirKalimat($data->latar),
            'maksud' => Helper::hapusTitikAkhirKalimat($data->maksud),
            'tujuan' => Helper::hapusTitikAkhirKalimat($data->tujuan),
            'target' => Helper::hapusTitikAkhirKalimat($data->sasaran),
            'tkdn' => $data->tkdn,
            'pemaketan' => $data->jenis,
            'anggaran' => $data->anggaran,
            'spesifikasi' => $data->spesifikasi,
            'metode' => $data->metode,
            'nama' => $data->nama,
            'nip' => $data->nip,
            'no_dipa' => Helper::getDipa($data->tahun)->nomor,
            'tanggal_dipa' => Helper::terbilangTanggal(Helper::getDipa($data->tahun)->tanggal),
            'tahun' => $data->tahun,
            'jabatan' => $data->jabatan,
            'waktu' => Helper::jangkaWaktuHariKalender($data->awal, $data->akhir),
            'awal' => Helper::terbilangTanggal($data->awal),
            'akhir' => Helper::terbilangTanggal($data->akhir),
            'ppk' => $data->ppk,
            'nipppk' => $data->nipppk,
        ];
    }
}
