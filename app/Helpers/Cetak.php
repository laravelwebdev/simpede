<?php

namespace App\Helpers;

use App\Models\AnggaranKerangkaAcuan;
use App\Models\DaftarHonor;
use App\Models\HonorSurvei;
use App\Models\KamusAnggaran;
use App\Models\KerangkaAcuan;
use App\Models\NaskahKeluar;
use App\Models\SpesifikasiKerangkaAcuan;
use App\Models\UnitKerja;
use Illuminate\Support\Facades\Storage;

class Cetak
{
    /**
     * Cetak Dokumen.
     *
     * @param  string  $jenis  kak|spj|sk|st|dpr|spd|bon
     * @param  collection  $model
     * @param  string  $filename
     * @return string
     */
    public static function cetak($jenis, $models, $filename, $template_id)
    {
        $index = 0;
        $mainXml = '';
        foreach ($models as $model) {
            self::validate($jenis, $model->id);
            if ($index === 0) {
                $mainTemplate = self::getTemplate($jenis, $model->id, $template_id);
                $mainXml = self::getMainXml($mainTemplate);
            } else {
                $innerTemplate = self::getTemplate($jenis, $model->id, $template_id);
                $innerXml = self::getModifiedInnerXml($innerTemplate);
                $mainXml = preg_replace('/<\/w:body>/', '<w:p><w:r><w:br w:type="page" /><w:lastRenderedPageBreak/></w:r></w:p>'.$innerXml.'</w:body>', $mainXml);
            }
            $index++;
        }
        $mainTemplate->settempDocumentMainPart($mainXml);
        $filename = $filename.'.docx';
        $mainTemplate->saveAs(Storage::path('public/'.$filename));

        return $filename;
    }

    /**
     * Ambil TemplateProsessor.
     *
     * @param  string  $jenis  kak|spj|sk|st|dpr|spd|bon
     * @param  $id
     * @return TemplateProcessor
     */
    public static function getTemplate(string $jenis, $id, $template_id)
    {
        $templateProcessor = new TemplateProcessor(Helper::getTemplatePathById($template_id)['path']);
        $data = call_user_func('App\Helpers\Cetak::'.$jenis, $id);
        if ($jenis === 'kak') {
            $templateProcessor->cloneRowAndSetValues('anggaran_no', Helper::formatAnggaran($data['anggaran']));
            $templateProcessor->cloneRowAndSetValues('spek_no', Helper::formatSpek($data['spesifikasi']));
            unset($data['anggaran'], $data['spesifikasi']);
            KerangkaAcuan::where('id', $id)->update(['status' => 'selesai']);
        }
        if ($jenis === 'spj') {
            $templateProcessor->cloneRowAndSetValues('spj_no', Helper::formatSpj(DaftarHonor::where('honor_survei_id', $id)->get(['nama As spj_nama', 'satuan AS spj_satuan', 'jumlah AS spj_jumlah', 'bruto AS spj_bruto', 'pajak AS spj_pajak', 'netto AS spj_netto', 'rekening AS spj_rekening'])));
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
     * Format nilai KAK.
     *
     * @param  string  $id
     * @return array
     */
    public static function kak($id)
    {
        $data = KerangkaAcuan::find($id);

        return [
            'nomor' => NaskahKeluar::find($data->naskah_keluar_id)->nomor,
            'tanggal' => Helper::terbilangTanggal($data->tanggal),
            'rincian' => Helper::hapusTitikAkhirKalimat($data->rincian),
            'unit' => UnitKerja::cache()->get('all')->where('id', $data->unit_kerja_id)->first()->unit ?? '',
            'latar_belakang' => Helper::hapusTitikAkhirKalimat($data->latar),
            'maksud' => Helper::hapusTitikAkhirKalimat($data->maksud),
            'tujuan' => Helper::hapusTitikAkhirKalimat($data->tujuan),
            'target' => Helper::hapusTitikAkhirKalimat($data->sasaran),
            'tkdn' => $data->tkdn,
            'pemaketan' => $data->jenis,
            'anggaran' => AnggaranKerangkaAcuan::where('kerangka_acuan_id', $id)->get()->toArray(),
            'spesifikasi' => SpesifikasiKerangkaAcuan::where('kerangka_acuan_id', $id)->get()->toArray(),
            'metode' => $data->metode,
            'nama' => Helper::getPegawaiByUserId($data->koordinator_user_id)->name,
            'nip' => Helper::getPegawaiByUserId($data->koordinator_user_id)->nip,
            'no_dipa' => Helper::getDipa($data->dipa_id)->nomor,
            'tanggal_dipa' => Helper::terbilangTanggal(Helper::getDipa($data->dipa_id)->tanggal),
            'tahun' => Helper::getDipa($data->dipa_id)->tahun,
            'jabatan' => Helper::getDataPegawaiByUserId($data->koordinator_user_id, $data->tanggal)->jabatan == 'Kepala Subbagian Umum' ? 'Kepala Subbagian Umum' : 'Penanggung Jawab Kegiatan',
            'waktu' => Helper::jangkaWaktuHariKalender($data->awal, $data->akhir),
            'awal' => Helper::terbilangTanggal($data->awal),
            'akhir' => Helper::terbilangTanggal($data->akhir),
            'ppk' => Helper::getPegawaiByUserId($data->ppk_user_id)->name,
            'nipppk' => Helper::getPegawaiByUserId($data->ppk_user_id)->nip,
        ];
    }

    /**
     * Format nilai SPJ.
     *
     * @param  string  $id
     * @return array
     */
    public static function spj($id)
    {
        $data = HonorSurvei::find($id);

        return [
            'nama' => $data->judul_spj,
            'tanggal_spj' => Helper::terbilangTanggal($data->tanggal_spj),
            'detail' => KamusAnggaran::cache()->get('all')->where('id',$data->kamus_anggaran_id)->first()->detail,
            'bulan' => $data->bulan == '13'? Helper::terbilangTanggal($data->awal).' - '.Helper::terbilangTanggal($data->akhir) :Helper::terbilangBulan($data->bulan),
            'mak' => $data->mak,
            'kegiatan' => Helper::getDetailAnggaran($data->mak, 'kegiatan'),
            'kro' => Helper::getDetailAnggaran($data->mak, 'kro'),
            'ro' => Helper::getDetailAnggaran($data->mak, 'ro'),
            'komponen' => Helper::getDetailAnggaran($data->mak, 'komponen'),
            'sub' => Helper::getDetailAnggaran($data->mak, 'sub'),
            'akun' => Helper::getDetailAnggaran($data->mak, 'akun'),
            'satuan' => $data->satuan,
            'total_bruto' => Helper::formatUang(DaftarHonor::where('honor_survei_id', $id)->sum('bruto')),
            'total_pajak' => Helper::formatUang(DaftarHonor::where('honor_survei_id', $id)->sum('pajak')),
            'total_netto' => Helper::formatUang(DaftarHonor::where('honor_survei_id', $id)->sum('netto')),
            'ketua' => Helper::getPegawaiByUserId($data->koordinator_user_id)->name,
            'nipketua' => Helper::getPegawaiByUserId($data->koordinator_user_id)->nip,
            'ppk' => Helper::getPegawaiByUserId($data->ppk_user_id)->name,
            'nipppk' => Helper::getPegawaiByUserId($data->ppk_user_id)->nip,
            'bendahara' => Helper::getPegawaiByUserId($data->bendahara_user_id)->name,
            'nipbendahara' => Helper::getPegawaiByUserId($data->bendahara_user_id)->nip,
            'terbilang_total' => Helper::terbilang(DaftarHonor::where('honor_survei_id', $id)->sum('bruto'), 'uw', ' rupiah'),
        ];
    }

    public static function validate($jenis, $model_id)
    {
        if ($jenis === 'kak') {
            throw_if(
                AnggaranKerangkaAcuan::where('kerangka_acuan_id', $model_id)->sum('perkiraan') == 0,
                'Belum terdapat akun anggaran yang digunakan pada KAK ini'
            );
            throw_if(
                AnggaranKerangkaAcuan::where('kerangka_acuan_id', $model_id)->sum('perkiraan') != SpesifikasiKerangkaAcuan::where('kerangka_acuan_id', $model_id)->sum('total_harga'),
                'Perkiraan jumlah penggunaan anggaran tidak sama dengan  total nilai barang/jasa'
            );
        }
        if ($jenis === 'spj') {
            throw_if(
                in_array(HonorSurvei::where('id', $model_id)->first()->status,['dibuat', 'diubah']),
                'Upps sepertinya belum ada mitra yang diimport pada spj ini'
            );
        }
    }
}
