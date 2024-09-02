<?php

namespace App\Helpers;

use App\Models\KerangkaAcuan;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;


class Cetak
{
    /**
     * Cetak Dokumen.
     *
     * @param  string  $jenis  kak|spj|sk|st|dpr|spd|bon
     * @param  string  $id
     * @return void
     */
    public static function cetak($jenis, $id)
    {
        $templateProcessor = new TemplateProcessor(Storage::path('template/Template_permintaan.docx'));
        $templateProcessor->setValues(call_user_func('App\Helpers\Cetak::'.$jenis, $id));
        if ($jenis === 'kak') $templateProcessor->cloneRowAndSetValues('spek_no', Helper::formatSpek($data->spesifikasi));
        $templateProcessor->saveAs(Storage::path('public/permintaan/KAK'.explode('/', $no)[0].'.docx'));

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
            'nomor' => $data->nomor,
            'tanggal' => Helper::terbilangTanggal($data->tanggal),
            'rincian' => $data->rincian,
            'unit' => $data->unit,
            'mak' => $data->mak,
            'latar_belakang' => $data->latar_belakang,
            'maksud' => $data->maksud,
            'tujuan' => $data->tujuan,
            'target' => $data->target,
            'tkdn' => $data->tkdn,
            'metode' => $data->metode,
            'volume' => $data->volume,
            'jumlah' => Helper::formatRupiah((float) $data->jumlah),
            'perkiraan' => Helper::formatRupiah((float) $data->perkiraan),
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
      ];
    }
    
}
