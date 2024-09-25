<?php

namespace App\Helpers;

use App\Models\AnggaranKerangkaAcuan;
use App\Models\DaftarHonorMitra;
use App\Models\Dipa;
use App\Models\HonorKegiatan;
use App\Models\KamusAnggaran;
use App\Models\KerangkaAcuan;
use App\Models\NaskahKeluar;
use App\Models\SpesifikasiKerangkaAcuan;
use App\Models\UnitKerja;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\Element\TextRun;

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
            $templateProcessor->cloneRowAndSetValues('volume', $data['daftar_honor_mitra']);
            $detailAnggarans = ['kegiatan', 'kro', 'ro', 'komponen', 'sub', 'akun', 'detail'];
            foreach ($detailAnggarans as $detailAnggaran) {
                if (Str::of($data[$detailAnggaran])->contains('edit manual karena belum ada di POK')) {
                    $detail = new TextRun();
                    $detail->addText(Str::of($data[$detailAnggaran])->before('edit manual karena belum ada di POK'));
                    $detail->addText('edit manual karena belum ada di POK', ['color' => 'red']);
                    $templateProcessor->setComplexValue($detailAnggaran, $detail);
                    unset($data[$detailAnggaran]);
                }
            }

            unset($data['daftar_honor_mitra']);
            HonorKegiatan::where('id', $id)->update(['status' => 'selesai']);
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
        $dipa = Dipa::cache()->get('all')->where('id', $data->dipa_id)->first();
        $koordinator = Helper::getPegawaiByUserId($data->koordinator_user_id);
        $ppk = Helper::getPegawaiByUserId($data->ppk_user_id);
        return [
            'nomor' => NaskahKeluar::find($data->naskah_keluar_id)->nomor,
            'tanggal' => Helper::terbilangTanggal($data->tanggal),
            'rincian' => Helper::hapusTitikAkhirKalimat($data->rincian),
            'unit' => Helper::getPropertyFromCollection(UnitKerja::cache()->get('all')->where('id', $data->unit_kerja_id)->first(),'unit'),
            'latar_belakang' => Helper::hapusTitikAkhirKalimat($data->latar),
            'maksud' => Helper::hapusTitikAkhirKalimat($data->maksud),
            'tujuan' => Helper::hapusTitikAkhirKalimat($data->tujuan),
            'target' => Helper::hapusTitikAkhirKalimat($data->sasaran),
            'tkdn' => $data->tkdn,
            'pemaketan' => $data->jenis,
            'anggaran' => AnggaranKerangkaAcuan::where('kerangka_acuan_id', $id)->get()->toArray(),
            'spesifikasi' => SpesifikasiKerangkaAcuan::where('kerangka_acuan_id', $id)->get()->toArray(),
            'metode' => $data->metode,
            'nama' => Helper::getPropertyFromCollection($koordinator, 'name'),
            'nip' => Helper::getPropertyFromCollection($koordinator,'nip'),
            'no_dipa' => Helper::getPropertyFromCollection($dipa, 'nomor'),
            'tanggal_dipa' => Helper::terbilangTanggal(Helper::getPropertyFromCollection($dipa, 'tanggal')),
            'tahun' => Helper::getPropertyFromCollection($dipa, 'tahun'),
            'jabatan' => Helper::getPropertyFromCollection(Helper::getDataPegawaiByUserId($data->koordinator_user_id, $data->tanggal),'jabatan') == 'Kepala Subbagian Umum' ? 'Kepala Subbagian Umum' : 'Penanggung Jawab Kegiatan',
            'waktu' => Helper::jangkaWaktuHariKalender($data->awal, $data->akhir),
            'awal' => Helper::terbilangTanggal($data->awal),
            'akhir' => Helper::terbilangTanggal($data->akhir),
            'ppk' => Helper::getPropertyFromCollection($ppk, 'name'),
            'nipppk' => Helper::getPropertyFromCollection($ppk, 'nip'),
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
        $data = HonorKegiatan::find($id);
        $kamus = KamusAnggaran::cache()->get('all')->where('id', $data->kamus_anggaran_id)->first();
        $koordinator = Helper::getPegawaiByUserId($data->koordinator_user_id);
        $ppk = Helper::getPegawaiByUserId($data->ppk_user_id);
        $bendahara = Helper::getPegawaiByUserId($data->bendahara_user_id);
        return [
            'nama' => $data->judul_spj,
            'tanggal_spj' => Helper::terbilangTanggal($data->tanggal_spj),
            'detail' => $kamus == null ? 'edit manual karena belum ada di POK' : $kamus->detail,
            'bulan' => $data->bulan == '13' ? Helper::terbilangTanggal($data->awal).' - '.Helper::terbilangTanggal($data->akhir) : Helper::terbilangBulan($data->bulan),
            'mak' => $data->mak,
            'kegiatan' => Helper::getDetailAnggaran($data->mak, 'kegiatan'),
            'kro' => Helper::getDetailAnggaran($data->mak, 'kro'),
            'ro' => Helper::getDetailAnggaran($data->mak, 'ro'),
            'komponen' => Helper::getDetailAnggaran($data->mak, 'komponen'),
            'sub' => Helper::getDetailAnggaran($data->mak, 'sub'),
            'akun' => Helper::getDetailAnggaran($data->mak, 'akun'),
            'daftar_honor_mitra' => Helper::makeSpjMitraAndPegawai($id,$data->tanggal_spj ),
            'satuan' => $data->satuan,
            'total_bruto' => Helper::formatUang(Helper::makeBaseListMitraAndPegawai(1, "2024-09-01")->sum("bruto")),
            'total_pajak' => Helper::formatUang(Helper::makeBaseListMitraAndPegawai(1, "2024-09-01")->sum("pajak")),
            'total_netto' => Helper::formatUang(Helper::makeBaseListMitraAndPegawai(1, "2024-09-01")->sum("netto")),
            'total_volume' => Helper::formatUang(Helper::makeBaseListMitraAndPegawai(1, "2024-09-01")->sum("volume")),
            'ketua' => Helper::getPropertyFromCollection($koordinator, 'name'),
            'nipketua' => Helper::getPropertyFromCollection($koordinator, 'nip'),
            'ppk' => Helper::getPropertyFromCollection($ppk, 'name'),
            'nipppk' => Helper::getPropertyFromCollection($ppk, 'nip'),
            'bendahara' => Helper::getPropertyFromCollection($bendahara, 'name'),
            'nipbendahara' => Helper::getPropertyFromCollection($bendahara, 'nip'),
            'terbilang_total' => Helper::terbilang(Helper::makeBaseListMitraAndPegawai(1, "2024-09-01")->sum("bruto"), 'uw', ' rupiah'),
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
            HonorKegiatan::where('id', $model_id)->first()->status == 'dibuat',
                'Mohon lengkapi terlebih dulu sisian honor kegiatan yang akan dicetak melalui menu Ubah'
            );
        }
    }
}
