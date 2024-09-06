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
     * @param  collection  $model
     * @return string
     */
    public static function cetak($jenis, $models)
    {
        $index = 0;
        $mainXml ='';
        foreach ($models as $model) {
        if ($index === 0) {
           $mainTemplate = self::getTemplate($jenis, $model->id);
           $mainXml = self::getMainXml($mainTemplate);
           $data = call_user_func('App\Helpers\Cetak::'.$jenis, $model->id);
        } else {
            $innerTemplate = self::getTemplate($jenis, $model->id);
            $innerXml = self::getModifiedInnerXml($innerTemplate);
            $mainXml = preg_replace('/<\/w:body>/', '<w:p><w:r><w:br w:type="page" /><w:lastRenderedPageBreak/></w:r></w:p>' . $innerXml . '</w:body>', $mainXml);
        }
        $index++;
        }
        $mainTemplate->settempDocumentMainPart($mainXml);
        ($index === 1) ? $filename = $jenis.'_'.session('year').'_'.explode('/', $data['nomor'])[0].'.docx' : $filename = uniqid().'.docx';
        $mainTemplate->saveAs(Storage::path('public/'.$filename));

        return $filename;
    }

    /**
     * Ambil TemplateProsessor.
     *
     * @param  string  $jenis  kak|spj|sk|st|dpr|spd|bon
     * @param  string  $id
     * @return TemplateProcessor
     */
    public static function getTemplate($jenis, $id)
    {
        $templateProcessor = new TemplateProcessor(Helper::getTemplatePath($jenis));
        $data = call_user_func('App\Helpers\Cetak::'.$jenis, $id);
        if ($jenis === 'kak') {
            $templateProcessor->cloneRowAndSetValues('no', Helper::formatAnggaran($data['anggaran']));
            $templateProcessor->cloneRowAndSetValues('spek_no', Helper::formatSpek($data['spesifikasi']));
            unset($data['anggaran'], $data['spesifikasi']);
        }
        $templateProcessor->setValues($data);
        return  $templateProcessor;
    }

    /**
     * Ambil XML dari dokumen utama.
     *
     * @param  TemplateProcessor  $templateProcessor
     * @return string
     */
    public static function getMainXml($templateProcessor)
    {        
        return  $templateProcessor->gettempDocumentMainPart();
    }

    /**
     * Ambil XML dari dokumen yangakan digabung.
     *
     * @param  TemplateProcessor  $templateProcessor
     * @return string
     */
    public static function getModifiedInnerXml($templateProcessor)
    {        
        $innerXml = $templateProcessor->gettempDocumentMainPart();
        $innerXml = preg_replace('/^[\s\S]*<w:body>(.*)<\/w:body>.*/', '$1', $innerXml);
        $innerXml = preg_replace('/<w:sectPr>.*<\/w:sectPr>/', '', $innerXml);
        return $innerXml;
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
