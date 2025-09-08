<?php

namespace App\Helpers;

use App\Models\AnggaranKerangkaAcuan;
use App\Models\BarangPersediaan;
use App\Models\BastMitra;
use App\Models\DaftarKontrakMitra;
use App\Models\DaftarPemeliharaan;
use App\Models\DaftarPenilaianReward;
use App\Models\DaftarPesertaPerjalanan;
use App\Models\DaftarPulsaMitra;
use App\Models\Dipa;
use App\Models\HonorKegiatan;
use App\Models\KerangkaAcuan;
use App\Models\KontrakMitra;
use App\Models\MasterBarangPemeliharaan;
use App\Models\MasterPersediaan;
use App\Models\NaskahKeluar;
use App\Models\PembelianPersediaan;
use App\Models\PerjalananDinas;
use App\Models\PermintaanPersediaan;
use App\Models\PulsaKegiatan;
use App\Models\RapatInternal;
use App\Models\RewardPegawai;
use App\Models\SpesifikasiKerangkaAcuan;
use App\Models\UnitKerja;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Settings;

class Cetak
{
    /**
     * Print a document.
     *
     * @param  string  $jenis  The type of document (kak|spj|sk|st|dpr|spd|bon)
     * @param  collection  $model  The model collection
     * @param  string  $filename  The filename for the document
     * @param  int  $template_id  The template ID
     * @param  string|null  $tanggal  The date (optional)
     * @param  string|null  $pengelola  The manager (optional)
     * @return string The filename of the saved document
     *
     * @throws \Exception
     */
    public static function cetak($jenis, $models, $filename, $template_id, $tanggal = null, $pengelola = null)
    {
        static $globalIndex = 0;
        static $mainTemplate = null;
        static $mainXml = '';
        static $innerXmlList = [];

        foreach ($models as $model) {
            $template = self::getTemplate($jenis, $model->id, $template_id, $tanggal, $pengelola);

            if ($globalIndex === 0 && $mainTemplate === null) {
                $mainTemplate = $template;
                $mainXml = self::getMainXml($mainTemplate);
            } else {
                $innerXmlList[] = self::getModifiedInnerXml($template);
            }

            $globalIndex++;
        }

        // kalau ini adalah chunk terakhir (misalnya dipanggil dengan tanda khusus),
        // baru digabungkan
        if ($models->last() === $models->get($models->count() - 1)) {
            if (! empty($innerXmlList)) {
                $allInnerXml = implode('', $innerXmlList);
                $mainXml = preg_replace('/<\/w:body>/', $allInnerXml.'</w:body>', $mainXml, 1);
            }

            $mainTemplate->settempDocumentMainPart($mainXml);
            $filename .= '_'.uniqid().'.docx';
            $mainTemplate->saveAs(Storage::disk('temp')->path($filename));

            // reset static agar siap next call
            $globalIndex = 0;
            $mainTemplate = null;
            $mainXml = '';
            $innerXmlList = [];

            return $filename;
        }

        return null; // chunk sementara, belum ada file
    }

    /**
     * Get the TemplateProcessor.
     *
     * @param  string  $jenis  The type of document (kak|spj|sk|st|dpr|spd|bon)
     * @param  int  $id  The ID of the model
     * @param  int  $template_id  The template ID
     * @param  string|null  $tanggal  The date (optional)
     * @param  string|null  $pengelola  The manager (optional)
     * @return TemplateProcessor
     */
    public static function getTemplate(string $jenis, $id, $template_id, $tanggal, $pengelola)
    {
        Settings::setOutputEscapingEnabled(true);
        $templateProcessor = new TemplateProcessor(Helper::getTemplatePathById($template_id)['path']);
        if ($tanggal || $pengelola) {
            $data = call_user_func([self::class, $jenis], $id, $tanggal, $pengelola);
        } else {
            $data = call_user_func([self::class, $jenis], $id);
        }
        if ($jenis === 'kak') {
            $templateProcessor->cloneRowAndSetValues('anggaran_no', Helper::formatAnggaran($data['anggaran']));
            $templateProcessor->cloneRowAndSetValues('spek_no', Helper::formatSpek($data['spesifikasi']));
            unset($data['anggaran'], $data['spesifikasi']);
            KerangkaAcuan::where('id', $id)->update(['status' => 'dicetak']);
        }
        if ($jenis === 'st') {
            $templateProcessor->cloneRowAndSetValues('st_no', $data['daftar_petugas']);
            $templateProcessor->cloneRowAndSetValues('kepada', $data['daftar_petugas']);
            unset($data['daftar_petugas']);
        }
        if ($jenis === 'bastp') {
            $templateProcessor->cloneRowAndSetValues('no', Helper::formatBarangPersediaan($data['daftar_barang']));
            unset($data['daftar_barang']);
            $pembelian = PembelianPersediaan::where('id', $id);
            $pembelian->update(['status' => 'dicetak']);
            BarangPersediaan::where('barang_persediaanable_id', $id)->where('barang_persediaanable_type', \App\Models\PembelianPersediaan::class)->update(['tanggal_transaksi' => $pembelian->first()->tanggal_buku]);
        }
        if ($jenis === 'bon') {
            $templateProcessor->cloneRowAndSetValues('no', Helper::formatBarangPersediaan($data['daftar_barang']));
            unset($data['daftar_barang']);
            $permintaan = PermintaanPersediaan::where('id', $id);
            $permintaan->update(['status' => 'dicetak']);
            BarangPersediaan::where('barang_persediaanable_id', $id)->where('barang_persediaanable_type', \App\Models\PermintaanPersediaan::class)->update(['tanggal_transaksi' => $permintaan->first()->tanggal_persetujuan]);
        }
        if ($jenis === 'sk') {
            $templateProcessor->cloneRowAndSetValues('sk_no', $data['daftar_petugas']);
            unset($data['daftar_petugas']);
        }
        if ($jenis === 'kontrak') {
            $templateProcessor->cloneRowAndSetValues('spek_no', $data['daftar_honor']);
            unset($data['daftar_honor']);
            DaftarKontrakMitra::where('id', $id)->where('status_kontrak', '!=', 'outdated')->update(['status_kontrak' => 'dicetak']);
        }
        if ($jenis === 'bast') {
            $templateProcessor->cloneRowAndSetValues('spek_no', $data['daftar_honor']);
            unset($data['daftar_honor']);
            DaftarKontrakMitra::where('id', $id)->where('status_bast', '!=', 'outdated')->update(['status_bast' => 'dicetak']);
        }

        if ($jenis === 'kuitansi') {
            $templateProcessor->cloneRowAndSetValues('item', $data['item_biaya']);
            unset($data['item_biaya']);
        }
        if ($jenis === 'daftar_hadir') {
            $templateProcessor->cloneRowAndSetValues('no', $data['baris']);
            unset($data['baris']);
        }

        if ($jenis === 'notula') {
            $templateProcessor->cloneRowAndSetValues('nama1', $data['peserta']);
            unset($data['peserta']);
        }

        if ($jenis === 'karken_pemeliharaan') {
            $templateProcessor->cloneRowAndSetValues('no', Helper::formatDaftarPemeliharaan($data['daftar_pemeliharaan']));
            unset($data['daftar_pemeliharaan']);
        }

        if ($jenis === 'kertas_kerja_reward') {
            $templateProcessor->cloneRowAndSetValues('no', Helper::formatDaftarPenilaian($data['daftar_penilaian']));
            unset($data['daftar_penilaian']);
        }

        if ($jenis === 'karken_persediaan') {
            $templateProcessor->cloneRowAndSetValues('no', Helper::formatDaftarPersediaan($id, $data['daftar_persediaan']));
            unset($data['daftar_persediaan']);
        }

        if ($jenis === 'spj') {
            $templateProcessor->cloneRowAndSetValues('spj_no', $data['daftar_honor_mitra']);
            $detailAnggarans = ['kegiatan', 'kro', 'ro', 'komponen', 'sub', 'akun', 'detail'];
            foreach ($detailAnggarans as $detailAnggaran) {
                if (Str::of($data[$detailAnggaran])->contains('edit manual karena belum ada di POK')) {
                    $detail = new TextRun;
                    $detail->addText(Str::of($data[$detailAnggaran])->before('edit manual karena belum ada di POK'));
                    $detail->addText('edit manual karena belum ada di POK', ['color' => 'red']);
                    $templateProcessor->setComplexValue($detailAnggaran, $detail);
                    unset($data[$detailAnggaran]);
                }
            }

            unset($data['daftar_honor_mitra']);
            HonorKegiatan::where('id', $id)->update(['status' => 'dicetak']);
        }
        if ($jenis === 'pulsa') {
            $templateProcessor->cloneRowAndSetValues('spj_no', $data['daftar_pulsa_mitra']);
            $detailAnggarans = ['kegiatan', 'kro', 'ro', 'komponen', 'sub', 'akun', 'detail'];
            foreach ($detailAnggarans as $detailAnggaran) {
                if (Str::of($data[$detailAnggaran])->contains('edit manual karena belum ada di POK')) {
                    $detail = new TextRun;
                    $detail->addText(Str::of($data[$detailAnggaran])->before('edit manual karena belum ada di POK'));
                    $detail->addText('edit manual karena belum ada di POK', ['color' => 'red']);
                    $templateProcessor->setComplexValue($detailAnggaran, $detail);
                    unset($data[$detailAnggaran]);
                }
            }
            $dummies = $data['daftar_pulsa_mitra'];
            unset($data['daftar_pulsa_mitra']);
            PulsaKegiatan::where('id', $id)->update(['status' => 'selesai']);
        }
        $templateProcessor->setValues($data);
        if ($jenis === 'pulsa') {
            foreach ($dummies as $dummy) {
                $templateProcessor->setImageValue(
                    $dummy['nik'],
                    [
                        'path' => Storage::disk('pulsa')->path($dummy['bukti']),
                        'width' => '',
                        'height' => '6.5cm',
                        'ratio' => true,
                    ]
                );
            }
            unset($dummies);
        }

        return $templateProcessor;
    }

    /**
     * Get the XML from the main document.
     *
     * @param  TemplateProcessor  $templateProcessor
     * @return string
     */
    public static function getMainXml($templateProcessor)
    {
        return $templateProcessor->gettempDocumentMainPart();
    }

    /**
     * Get the XML from the document to be merged.
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
     * Format the KAK values.
     *
     * @param  string  $id  The ID of the KAK
     * @return array
     */
    public static function kak($id)
    {
        $data = KerangkaAcuan::find($id);
        $dipa = Dipa::cache()->get('all')->where('id', $data->dipa_id)->first();
        $koordinator = Helper::getPegawaiByUserId($data->koordinator_user_id);
        $ppk = Helper::getPegawaiByUserId($data->ppk_user_id);

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'nomor' => optional(NaskahKeluar::find($data->naskah_keluar_id))->nomor,
            'tanggal' => Helper::terbilangTanggal($data->tanggal),
            'rincian' => Helper::hapusTitikAkhirKalimat($data->rincian),
            'unit' => optional(UnitKerja::cache()->get('all')->where('id', $data->unit_kerja_id)->first())->unit,
            'latar_belakang' => Helper::hapusTitikAkhirKalimat($data->latar),
            'maksud' => Helper::hapusTitikAkhirKalimat($data->maksud),
            'tujuan' => Helper::hapusTitikAkhirKalimat($data->tujuan),
            'target' => Helper::hapusTitikAkhirKalimat($data->sasaran),
            'tkdn' => $data->tkdn,
            'pemaketan' => $data->jenis,
            'anggaran' => AnggaranKerangkaAcuan::where('kerangka_acuan_id', $id)->get()->toArray(),
            'spesifikasi' => SpesifikasiKerangkaAcuan::where('kerangka_acuan_id', $id)->get()->toArray(),
            'metode' => $data->metode,
            'nama' => optional($koordinator)->name,
            'nip' => optional($koordinator)->nip,
            'no_dipa' => optional($dipa)->nomor,
            'tanggal_dipa' => Helper::terbilangTanggal(optional($dipa)->tanggal),
            'tahun' => optional($dipa)->tahun,
            'jabatan' => optional(Helper::getDataPegawaiByUserId($data->koordinator_user_id, $data->tanggal))->jabatan == 'Kepala Subbagian Umum' ? 'Kepala Subbagian Umum' : 'Penanggung Jawab Kegiatan',
            'waktu' => Helper::jangkaWaktuHariKalender($data->awal, $data->akhir),
            'awal' => Helper::terbilangTanggal($data->awal),
            'akhir' => Helper::terbilangTanggal($data->akhir),
            'ppk' => optional($ppk)->name,
            'nipppk' => optional($ppk)->nip,
        ];
    }

    /**
     * Format the values for the vehicle statement.
     *
     * @param  string  $id  The ID of the vehicle statement
     * @return array
     */
    public static function pernyataan_kendaraan($id)
    {
        $data = DaftarPesertaPerjalanan::find($id);
        $user = Helper::getPegawaiByUserId($data->user_id);
        $data_user = Helper::getDataPegawaiByUserId($data->user_id, $data->tanggal_kuitansi);
        $perjalanan = $data->perjalananDinas;

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'nama' => optional($user)->name,
            'nama_ttd' => Helper::namaTanpaGelar(optional($user)->name),
            'nip' => optional($user)->nip,
            'pangkat' => optional($data_user)->pangkat,
            'golongan' => optional($data_user)->golongan,
            'jabatan' => optional($data_user)->jabatan,
            'berangkat' => Helper::terbilangTanggal(optional($perjalanan)->tanggal_berangkat),
            'kembali' => Helper::terbilangTanggal(optional($perjalanan)->tanggal_kembali),
            'uraian' => optional($perjalanan)->uraian,
        ];
    }

    /**
     * Format the values for the SPPD.
     *
     * @param  string  $id  The ID of the SPPD
     * @return array
     */
    public static function sppd($id)
    {
        $data = DaftarPesertaPerjalanan::find($id);
        $user = Helper::getPegawaiByUserId($data->user_id);
        $data_user = Helper::getDataPegawaiByUserId($data->user_id, $data->tanggal_kuitansi);
        $perjalanan = $data->perjalananDinas;
        $kepala = Helper::getPegawaiByUserId($perjalanan->kepala_user_id);
        $ppk = Helper::getPegawaiByUserId($perjalanan->ppk_user_id);

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'no_st' => optional(NaskahKeluar::find($perjalanan->st_naskah_keluar_id))->nomor,
            'uraian_spd' => optional($perjalanan)->uraian,
            'nama' => optional($user)->name,
            'nip' => optional($user)->nip,
            'berangkat' => Helper::terbilangTanggal(optional($perjalanan)->tanggal_berangkat),
            'kembali' => Helper::terbilangTanggal(optional($perjalanan)->tanggal_kembali),
            'tanggal_st' => Helper::terbilangTanggal(optional($perjalanan)->tanggal_st),
            'kepala' => optional($kepala)->name,
            'kepala_ttd' => Helper::namaTanpaGelar(optional($kepala)->name),
            'nipkepala' => optional($kepala)->nip,
            'no_spd' => optional(NaskahKeluar::find($perjalanan->spd_naskah_keluar_id))->nomor,
            'ppk' => optional($ppk)->name,
            'pangkat' => optional($data_user)->pangkat,
            'golongan' => optional($data_user)->golongan,
            'jabatan' => optional($data_user)->jabatan,
            'angkutan' => $data->angkutan,
            'asal' => optional(Helper::getMasterWilayahById($data->asal_master_wilayah_id))->wilayah,
            'tujuan' => optional(Helper::getMasterWilayahById($perjalanan->tujuan_master_wilayah_id))->wilayah,
            'waktu' => Helper::jangkaWaktu(optional($perjalanan)->tanggal_berangkat, optional($perjalanan)->tanggal_kembali),
            'mak' => optional(Helper::getMataAnggaranById($perjalanan->mata_anggaran_id))->mak,
            'tanggal_spd' => Helper::terbilangTanggal(optional($perjalanan)->tanggal_spd),
            'nipppk' => optional($ppk)->nip,
        ];
    }

    /**
     * Format the values for the maintenance card.
     *
     * @param  string  $id  The ID of the maintenance card
     * @param  string  $tanggal  The date
     * @param  string  $pengelola  The manager
     * @return array
     */
    public static function karken_pemeliharaan($id, $tanggal, $pengelola)
    {
        $data = MasterBarangPemeliharaan::find($id);
        $user = Helper::getPegawaiByUserId($pengelola);
        $tanggal = Helper::createDateFromString($tanggal);

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'tanggal_cetak' => Helper::terbilangTanggal($tanggal),
            'bmn' => Helper::namaTanpaGelar(optional($user)->name),
            'barang' => $data->nama_barang,
            'kode_barang' => $data->kode_barang,
            'nup' => $data->nup,
            'tahun' => session('year'),
            'daftar_pemeliharaan' => DaftarPemeliharaan::whereYear('tanggal', session('year'))->whereDate('tanggal', '<=', $tanggal)->where('master_barang_pemeliharaan_id', $id)->get(),
        ];
    }

    /**
     * Format the values for the inventory card.
     *
     * @param  string  $id  The ID of the inventory card
     * @param  string  $tanggal  The date
     * @param  string  $pengelola  The manager
     * @return array
     */
    public static function karken_persediaan($id, $tanggal, $pengelola)
    {
        $data = MasterPersediaan::find($id);
        $user = Helper::getPegawaiByUserId($pengelola);
        $tanggal = Helper::createDateFromString($tanggal);

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'tanggal' => Helper::terbilangTanggal($tanggal),
            'bmn' => Helper::namaTanpaGelar(optional($user)->name),
            'barang' => $data->barang,
            'kode' => $data->kode,
            'satuan' => $data->satuan,
            'tahun' => session('year'),
            'daftar_persediaan' => BarangPersediaan::whereYear('tanggal_transaksi', session('year'))
                ->whereDate('tanggal_transaksi', '<=', $tanggal)
                ->where('master_persediaan_id', $id)
                ->with([
                    'barangPersediaanable' => function ($morphTo) {
                        $morphTo->morphWith([
                            \App\Models\PembelianPersediaan::class => ['bastNaskahKeluar'],
                            \App\Models\PermintaanPersediaan::class => ['naskahKeluar', 'user'],
                            \App\Models\PersediaanMasuk::class => ['naskahMasuk'],
                            \App\Models\PersediaanKeluar::class => ['naskahKeluar'],
                        ]);
                    },
                ])
                ->orderBy('tanggal_transaksi', 'asc')
                ->orderBy('id', 'asc')
                ->get(),
        ];
    }

    /**
     * Format the values for the receipt.
     *
     * @param  string  $id  The ID of the receipt
     * @return array
     */
    public static function kuitansi($id)
    {
        $data = DaftarPesertaPerjalanan::find($id);
        $user = Helper::getPegawaiByUserId($data->user_id);
        $ppk = Helper::getPegawaiByUserId($data->ppk_user_id);
        $bendahara = Helper::getPegawaiByUserId($data->bendahara_user_id);
        $data_user = Helper::getDataPegawaiByUserId($data->user_id, $data->tanggal_kuitansi);
        $perjalanan = PerjalananDinas::find($data->perjalanan_dinas_id);
        $item_biaya = Helper::formatBiayaSpd($data->spesifikasi);
        $itemdengannilai = Helper::addTotalBiayaSpd($data->spesifikasi);

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'nomor' => optional($perjalanan->spdNaskahKeluar)->nomor,
            'tanggal' => Helper::terbilangTanggal($perjalanan->tanggal_spd),
            'nama' => optional($user)->name,
            'nip' => optional($user)->nip,
            'ppk' => optional($ppk)->name,
            'nipppk' => optional($ppk)->nip,
            'bendahara' => optional($bendahara)->name,
            'nipbendahara' => optional($bendahara)->nip,
            'pangkat' => optional($data_user)->pangkat,
            'golongan' => optional($data_user)->golongan,
            'berangkat' => Helper::terbilangTanggal($perjalanan->tanggal_berangkat),
            'kembali' => Helper::terbilangTanggal($perjalanan->tanggal_kembali),
            'uraian' => optional($perjalanan)->uraian,
            'asal' => optional(Helper::getMasterWilayahById($data->asal_master_wilayah_id))->wilayah,
            'tujuan' => optional(Helper::getMasterWilayahById($perjalanan->tujuan_master_wilayah_id))->wilayah,
            'waktu' => Helper::jangkaWaktu($perjalanan->tanggal_berangkat, $perjalanan->tanggal_kembali),
            'biaya_total' => Helper::formatRupiah(Helper::sumSpek($itemdengannilai, 'nilai')),
            'tahun' => Helper::getYearFromDate($perjalanan->tanggal_spd),
            'mak' => optional(Helper::getMataAnggaranById($perjalanan->mata_anggaran_id))->mak,
            'item_biaya' => $item_biaya,
            'biaya_terbilang' => Helper::terbilang(Helper::sumSpek($itemdengannilai, 'nilai'), 'uw', ' rupiah'),
        ];
    }

    /**
     * Format the SPJ values.
     *
     * @param  string  $id  The ID of the SPJ
     * @return array
     */
    public static function spj($id)
    {
        $data = HonorKegiatan::find($id);
        $mataanggaran = Helper::getMataAnggaranById($data->mata_anggaran_id);
        $mak = optional($mataanggaran)->mak;
        $koordinator = Helper::getPegawaiByUserId($data->koordinator_user_id);
        $ppk = Helper::getPegawaiByUserId($data->ppk_user_id);
        $bendahara = Helper::getPegawaiByUserId($data->bendahara_user_id);

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'nama' => $data->judul_spj,
            'tanggal_spj' => Helper::terbilangTanggal($data->tanggal_spj),
            'detail' => optional($mataanggaran)->uraian,
            'bulan' => $data->jenis_honor !== 'Kontrak Mitra Bulanan' ? Helper::terbilangTanggal($data->awal).' - '.Helper::terbilangTanggal($data->akhir) : Helper::terbilangBulan($data->bulan),
            'mak' => $mak,
            'kegiatan' => Helper::getDetailAnggaran($mak, 'kegiatan'),
            'kro' => Helper::getDetailAnggaran($mak, 'kro'),
            'ro' => Helper::getDetailAnggaran($mak, 'ro'),
            'komponen' => Helper::getDetailAnggaran($mak, 'komponen'),
            'sub' => Helper::getDetailAnggaran($mak, 'sub'),
            'akun' => Helper::getDetailAnggaran($mak, 'akun'),
            'daftar_honor_mitra' => Helper::makeSpjMitraAndPegawai($id, $data->tanggal_spj),
            'satuan' => $data->satuan,
            'total_bruto' => Helper::formatUang(Helper::makeBaseListMitraAndPegawai($id, $data->tanggal_spj)->sum('bruto')),
            'total_pajak' => Helper::formatUang(Helper::makeBaseListMitraAndPegawai($id, $data->tanggal_spj)->sum('pajak')),
            'total_netto' => Helper::formatUang(Helper::makeBaseListMitraAndPegawai($id, $data->tanggal_spj)->sum('netto')),
            'total_volume' => Helper::formatUang(Helper::makeBaseListMitraAndPegawai($id, $data->tanggal_spj)->sum('volume')),
            'ketua' => optional($koordinator)->name,
            'nipketua' => optional($koordinator)->nip,
            'ppk' => optional($ppk)->name,
            'nipppk' => optional($ppk)->nip,
            'bendahara' => optional($bendahara)->name,
            'nipbendahara' => optional($bendahara)->nip,
            'terbilang_total' => Helper::terbilang(Helper::makeBaseListMitraAndPegawai($id, $data->tanggal_spj)->sum('bruto'), 'uw', ' rupiah'),
        ];
    }

    public static function pulsa($id)
    {
        $data = PulsaKegiatan::find($id);
        $mataanggaran = Helper::getMataAnggaranById($data->mata_anggaran_id);
        $mak = optional($mataanggaran)->mak;
        $koordinator = Helper::getPegawaiByUserId($data->koordinator_user_id);
        $ppk = Helper::getPegawaiByUserId($data->ppk_user_id);
        $harga = DaftarPulsaMitra::where('pulsa_kegiatan_id', $id)->sum('harga');

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'tanggal_spj' => Helper::terbilangTanggal($data->tanggal),
            'ibukota' => config('satker.ibukota'),
            'nama_kegiatan' => $data->kegiatan,
            'detail' => optional($mataanggaran)->uraian,
            'bulan' => Helper::terbilangBulan($data->bulan),
            'mak' => $mak,
            'kegiatan' => Helper::getDetailAnggaran($mak, 'kegiatan'),
            'kro' => Helper::getDetailAnggaran($mak, 'kro'),
            'ro' => Helper::getDetailAnggaran($mak, 'ro'),
            'komponen' => Helper::getDetailAnggaran($mak, 'komponen'),
            'sub' => Helper::getDetailAnggaran($mak, 'sub'),
            'akun' => Helper::getDetailAnggaran($mak, 'akun'),
            'daftar_pulsa_mitra' => Helper::makeSpjPulsaMitra($id),
            'ketua' => optional($koordinator)->name,
            'nipketua' => optional($koordinator)->nip,
            'ppk' => optional($ppk)->name,
            'nipppk' => optional($ppk)->nip,
            'total_harga' => Helper::formatUang($harga),
            'terbilang_total' => Helper::terbilang($harga, 'uw', ' rupiah'),
        ];
    }

    /**
     * Format the values for the assignment letter.
     *
     * @param  string  $id  The ID of the assignment letter
     * @return array
     */
    public static function st($id)
    {
        $data = HonorKegiatan::find($id);
        $kepala = Helper::getPegawaiByUserId($data->kepala_user_id);

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'nomor' => NaskahKeluar::find($data->st_naskah_keluar_id)->nomor,
            'kegiatan' => $data->kegiatan,
            'uraian_tugas' => $data->uraian_tugas,
            'awal' => Helper::terbilangTanggal($data->awal),
            'akhir' => Helper::terbilangTanggal($data->akhir),
            'tanggal' => Helper::terbilangTanggal($data->tanggal_st),
            'kepala' => Helper::namaTanpaGelar(optional($kepala)->name),
            'daftar_petugas' => Helper::makeStMitraAndPegawai($id, $data->tanggal_st),
        ];
    }

    /**
     * Format the values for the reward certificate.
     *
     * @param  string  $id  The ID of the reward certificate
     * @return array
     */
    public static function sertifikat_reward($id)
    {
        $data = RewardPegawai::find($id);
        $kepala = Helper::getPegawaiByUserId($data->kepala_user_id);
        $user = Helper::getPegawaiByUserId($data->user_id);

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'nomor' => NaskahKeluar::find($data->sertifikat_naskah_keluar_id)->nomor,
            'nama' => $user->name,
            'tahun' => $data->tahun,
            'bulan' => Helper::BULAN[$data->bulan],
            'tanggal' => Helper::terbilangTanggal($data->tanggal_penetapan),
            'kepala' => optional($kepala)->name,
        ];
    }

    /**
     * Format the values for the reward decree.
     *
     * @param  string  $id  The ID of the reward decree
     * @return array
     */
    public static function sk_reward($id)
    {
        $data = RewardPegawai::find($id);
        $kepala = Helper::getPegawaiByUserId($data->kepala_user_id);
        $user = Helper::getPegawaiByUserId($data->user_id);

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'nomor' => optional(NaskahKeluar::find($data->sk_naskah_keluar_id))->nomor,
            'nama' => $user->name,
            'nip' => $user->nip,
            'tahun' => $data->tahun,
            'golongan' => optional(Helper::getDataPegawaiByUserId($data->user_id, $data->tanggal_penetapan))->golongan,
            'bulan' => Helper::BULAN[$data->bulan],
            'ubulan' => strtoupper(Helper::BULAN[$data->bulan]),
            'tanggal' => Helper::terbilangTanggal($data->tanggal_penetapan),
            'kepala' => optional($kepala)->name,

        ];
    }

    /**
     * Format the values for the reward worksheet.
     *
     * @param  string  $id  The ID of the reward worksheet
     * @return array
     */
    public static function kertas_kerja_reward($id)
    {
        $data = RewardPegawai::find($id);
        $kepala = Helper::getPegawaiByUserId($data->kepala_user_id);
        $user = Helper::getPegawaiByUserId($data->user_id);

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'tahun' => $data->tahun,
            'nama_pemenang' => $user->name,
            'skor' => DaftarPenilaianReward::where('reward_pegawai_id', $id)->max('nilai_total'),
            'ubulan' => strtoupper(Helper::BULAN[$data->bulan]),
            'tanggal' => Helper::terbilangTanggal($data->tanggal_penetapan),
            'kepala' => Helper::namaTanpaGelar(optional($kepala)->name),
            'nipkepala' => optional($kepala)->nip,
            'daftar_penilaian' => DaftarPenilaianReward::where('reward_pegawai_id', $id)->where('user_id', '!=', $data->kepala_user_id)->get(),

        ];
    }

    /**
     * Format the values for the decree.
     *
     * @param  string  $id  The ID of the decree
     * @return array
     */
    public static function sk($id)
    {
        $data = HonorKegiatan::find($id);
        $kpa = Helper::getPegawaiByUserId($data->kpa_user_id);

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'nomor' => optional(NaskahKeluar::find($data->sk_naskah_keluar_id))->nomor,
            'kegiatan' => $data->kegiatan,
            'objek_sk' => $data->objek_sk,
            'tahun' => $data->tahun,
            'upper_objek_sk' => Str::upper($data->objek_sk),
            'tanggal' => Helper::terbilangTanggal($data->tanggal_sk),
            'kpa' => optional($kpa)->name,
            'daftar_petugas' => Helper::makeSkMitraAndPegawai($id, $data->tanggal_sk),
        ];
    }

    /**
     * Format the values for the contract.
     *
     * @param  string  $id  The ID of the contract
     * @return array
     */
    public static function kontrak($id)
    {
        $data = DaftarKontrakMitra::where('id', '=', $id)->first();
        $kontrak = KontrakMitra::find($data->kontrak_mitra_id);
        $ppk = Helper::getPegawaiByUserId($data->spk_ppk_user_id);
        $mitra = Helper::getMitraById($data->mitra_id);
        $bulan = Helper::BULAN[$kontrak->bulan];
        $jenis_kontrak = Helper::getJenisKontrakById($kontrak->jenis_kontrak_id)->jenis;

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'bulan' => $bulan,
            'tahun' => $kontrak->tahun,
            'ubulan' => strtoupper($bulan),
            'no_spk' => optional(NaskahKeluar::find($data->kontrak_naskah_keluar_id))->nomor,
            'hari' => Helper::terbilangHari($data->tanggal_spk),
            'terbilangtanggal' => Helper::terbilangTanggal($data->tanggal_spk, 'l'),
            'ppk' => optional($ppk)->name,
            'nama' => optional($mitra)->nama,
            'jenis' => $jenis_kontrak,
            'ujenis' => strtoupper($jenis_kontrak),
            'alamat' => optional($mitra)->alamat,
            'awal' => Helper::terbilangTanggal($data->awal_kontrak),
            'akhir' => Helper::terbilangTanggal($data->akhir_kontrak),
            'honor' => Helper::formatRupiah((float) $data->nilai_kontrak),
            'terbilanghonor' => Helper::terbilang($data->nilai_kontrak, 'uw', 'rupiah'),
            'tanggal_spk' => Helper::terbilangTanggal($data->tanggal_spk),
            'no_hsks' => optional(Helper::getLatestHargaSatuan($data->tanggal_spk))->nomor,
            'daftar_honor' => Helper::makeKontrakMitra($id),
        ];
    }

    /**
     * Format the values for the BAST.
     *
     * @param  string  $id  The ID of the BAST
     * @return array
     */
    public static function bast($id)
    {
        $data = DaftarKontrakMitra::where('id', $id)->first();
        $bast = BastMitra::find($data->bast_mitra_id);
        $kontrak = KontrakMitra::find($data->kontrak_mitra_id);
        $ppk = Helper::getPegawaiByUserId($data->bast_ppk_user_id);
        $mitra = Helper::getMitraById($data->mitra_id);
        $bulan = Helper::BULAN[$kontrak->bulan];
        $jenis_kontrak = Helper::getJenisKontrakById($kontrak->jenis_kontrak_id)->jenis;

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'bulan' => $bulan,
            'tahun' => $kontrak->tahun,
            'ubulan' => strtoupper($bulan),
            'no_bast' => optional(NaskahKeluar::find($data->bast_naskah_keluar_id))->nomor,
            'no_spk' => optional(NaskahKeluar::find($data->kontrak_naskah_keluar_id))->nomor,
            'tanggal_spk' => Helper::terbilangTanggal($data->tanggal_spk),
            'hari' => Helper::terbilangHari($data->tanggal_bast),
            'terbilangtanggal' => Helper::terbilangTanggal($data->tanggal_bast, 'l'),
            'ppk' => optional($ppk)->name,
            'nipppk' => optional($ppk)->nip,
            'nama' => optional($mitra)->nama,
            'nik' => optional($mitra)->nik,
            'jenis' => $jenis_kontrak,
            'ujenis' => strtoupper($jenis_kontrak),
            'alamat' => optional($mitra)->alamat,
            'tanggal_bast' => Helper::terbilangTanggal($data->tanggal_bast),
            'daftar_honor' => Helper::makeKontrakMitra($id),
        ];
    }

    /**
     * Format the values for the BASTP.
     *
     * @param  string  $id  The ID of the BASTP
     * @return array
     */
    public static function bastp($id)
    {
        $data = PembelianPersediaan::find($id);
        $bmn = Helper::getPegawaiByUserId($data->pbmn_user_id);
        $ppk = Helper::getPegawaiByUserId($data->ppk_user_id);

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'no_bast' => optional(NaskahKeluar::find($data->bast_naskah_keluar_id))->nomor,
            'hari' => Helper::terbilangHari($data->tanggal_bast),
            'terbilangtanggal' => Helper::terbilangTanggal($data->tanggal_bast, 'l'),
            'bmn' => optional($bmn)->name,
            'bmn_ttd' => Helper::namaTanpaGelar(optional($bmn)->name),
            'nipbmn' => optional($bmn)->nip,
            'daftar_barang' => BarangPersediaan::where('barang_persediaanable_id', $id)->where('barang_persediaanable_type', \App\Models\PembelianPersediaan::class)->get()->toArray(),
        ];
    }

    /**
     * Format the values for the request form.
     *
     * @param  string  $id  The ID of the request form
     * @return array
     */
    public static function bon($id)
    {
        $data = PermintaanPersediaan::find($id);
        $bmn = Helper::getPegawaiByUserId($data->pbmn_user_id);
        $pembuat = Helper::getPegawaiByUserId($data->user_id);
        $tim_id = optional(Helper::getDataPegawaiByUserId($data->user_id, $data->tanggal_permintaan))->unit_kerja_id;

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'nomor' => optional(NaskahKeluar::find($data->naskah_keluar_id))->nomor,
            'tim' => optional(UnitKerja::cache()->get('all')->where('id', $tim_id)->first())->unit,
            'kegiatan' => $data->kegiatan,
            'keterangan' => $data->keterangan,
            'tanggal_permintaan' => Helper::terbilangTanggal($data->tanggal_permintaan),
            'tanggal_persetujuan' => Helper::terbilangTanggal($data->tanggal_persetujuan),
            'nama' => Helper::upperNamaTanpaGelar(optional($pembuat)->name),
            'nip' => optional($pembuat)->nip,
            'bmn' => Helper::upperNamaTanpaGelar(optional($bmn)->name),
            'nipbmn' => optional($bmn)->nip,
            'daftar_barang' => BarangPersediaan::where('barang_persediaanable_id', $id)->where('barang_persediaanable_type', \App\Models\PermintaanPersediaan::class)->get()->toArray(),
        ];
    }

    /**
     * Format the values for the invitation.
     *
     * @param  string  $id  The ID of the invitation
     * @return array
     */
    public static function undangan($id)
    {
        $data = RapatInternal::find($id);
        $kepala = Helper::getPegawaiByUserId($data->kepala_user_id);

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'nomor' => optional(NaskahKeluar::find($data->naskah_keluar_id))->nomor,
            'tanggal' => Helper::terbilangTanggal($data->tanggal),
            'tujuan' => $data->tujuan,
            'tema' => $data->tema,
            'tanggal_rapat' => Helper::terbilangTanggal($data->tanggal_rapat),
            'hari' => Helper::terbilanghari($data->tanggal_rapat),
            'mulai' => Helper::formatJam($data->mulai),
            'tempat' => $data->tempat,
            'agenda' => $data->agenda,
            'kepala' => Helper::namaTanpaGelar(optional($kepala)->name),
        ];
    }

    /**
     * Format the values for the attendance list.
     *
     * @param  string  $id  The ID of the attendance list
     * @return array
     */
    public static function daftar_hadir($id)
    {
        $data = RapatInternal::find($id);
        $kepala = Helper::getPegawaiByUserId($data->kepala_user_id);
        $kasubbag = Helper::getPegawaiByUserId($data->kasubbag_user_id);

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'tema' => $data->tema,
            'tanggal_rapat' => Helper::terbilangTanggal($data->tanggal_rapat),
            'mulai' => Helper::formatJam($data->mulai),
            'tempat' => $data->tempat,
            'kepala' => Helper::namaTanpaGelar(optional($kepala)->name),
            'kasubbag' => Helper::namaTanpaGelar(optional($kasubbag)->name),
            'baris' => array_map(function ($i) {
                return ['no' => $i];
            }, range(1, $data->baris)),
        ];
    }

    /**
     * Format the values for the minutes of meeting.
     *
     * @param  string  $id  The ID of the minutes of meeting
     * @return array
     */
    public static function notula($id)
    {
        $data = RapatInternal::find($id);
        $kepala = Helper::getPegawaiByUserId($data->kepala_user_id);
        $pimpinan = Helper::getPegawaiByUserId($data->pimpinan_user_id);
        $notulis = Helper::getPegawaiByUserId($data->notulis_user_id);

        return [
            'kabupaten' => config('satker.kabupaten'),
            'u_kabupaten' => strtoupper(config('satker.kabupaten')),
            'alamat_satker' => config('satker.alamat'),
            'telepon_satker' => config('satker.telepon'),
            'website' => config('satker.website'),
            'email' => config('satker.email'),
            'ibukota' => config('satker.ibukota'),
            'tema' => $data->tema,
            'agenda' => $data->agenda,
            'tanggal_rapat' => Helper::terbilangTanggal($data->tanggal_rapat),
            'tempat' => $data->tempat,
            'kepala' => Helper::namaTanpaGelar(optional($kepala)->name),
            'pimpinan' => optional($pimpinan)->name,
            'notulis' => Helper::namaTanpaGelar(optional($notulis)->name),
            'peserta' => Helper::formatDaftarNama($data->peserta),
        ];
    }

    /**
     * Validate the document before printing.
     *
     * @param  string  $jenis  The type of document (kak|spj|sk|st|dpr|spd|bon)
     * @param  string  $model_id  The ID of the model
     * @return string|null
     */
    public static function validate($jenis, $model_id)
    {
        if ($jenis === 'kak') {
            if (AnggaranKerangkaAcuan::where('kerangka_acuan_id', $model_id)->sum('perkiraan') == 0) {
                return 'Belum terdapat akun anggaran yang digunakan pada KAK ini';
            }
            if (AnggaranKerangkaAcuan::where('kerangka_acuan_id', $model_id)->sum('perkiraan') != SpesifikasiKerangkaAcuan::where('kerangka_acuan_id', $model_id)->sum('total_harga')) {
                return 'Perkiraan jumlah penggunaan anggaran tidak sama dengan total nilai barang/jasa';
            }
        }
        if ($jenis === 'spj') {
            $honor = HonorKegiatan::where('id', $model_id)->first();
            if ($honor->status == 'dibuat') {
                return 'Mohon lengkapi terlebih dulu isian honor kegiatan yang akan dicetak melalui menu Sunting';
            }
            if (Helper::makeBaseListMitraAndPegawai($honor->id, $honor->tanggal_spj)->count() == 0) {
                return 'Belum ada data mitra/pegawai pada daftar ini.';
            }
            if ($honor->perkiraan_anggaran < Helper::makeBaseListMitraAndPegawai($honor->id, $honor->tanggal_spj)->sum('bruto')) {
                return 'Total Honor lebih besar dari perkiraan anggaran yang digunakan di KAK';
            }
            if (Helper::checkEmptyRekeningOnSpjMitraAndPegawai($honor->id, $honor->tanggal_spj)) {
                return 'Masih ada rekening yang kosong pada daftar SPJ ini.';
            }
        }
        if ($jenis === 'pulsa') {
            $pulsa = PulsaKegiatan::where('id', $model_id)->first();
            if (is_null($pulsa->tanggal)) {
                return 'Mohon lengkapi seluruh isian pada daftar pulsa ini sebelum mencetak!';
            }
            $notConfirmed = DaftarPulsaMitra::where('pulsa_kegiatan_id', $pulsa->id)
                ->where('confirmed', false)
                ->count();
            $notUploaded = DaftarPulsaMitra::where('pulsa_kegiatan_id', $pulsa->id)
                ->whereNull('file')
                ->count();
            if ($notConfirmed > 0) {
                return 'Masih ada data nomor handphone yang belum dikonfirmasi pada daftar ini.';
            }
            if ($notUploaded > 0) {
                return 'Masih ada bukti pulsa masuk yang belum diunggah pada daftar ini.';
            }
        }
        if ($jenis === 'st') {
            $honor = HonorKegiatan::where('id', $model_id)->first();
            if (Helper::makeBaseListMitraAndPegawai($honor->id, $honor->tanggal_spj)->count() == 0) {
                return 'Belum ada data mitra/pegawai pada daftar ini.';
            }
        }
        if ($jenis === 'sk') {
            $honor = HonorKegiatan::where('id', $model_id)->first();
            if (Helper::makeBaseListMitraAndPegawai($honor->id, $honor->tanggal_spj)->count() == 0) {
                return 'Belum ada data mitra/pegawai pada daftar ini.';
            }
        }
        if ($jenis === 'kontrak') {
            $kontrak = DaftarKontrakMitra::where('id', $model_id)->first();
            if (is_null($kontrak->kontrak_naskah_keluar_id)) {
                return 'Mohon Generate Kontrak terlebih dahulu sebelum mencetak!';
            }
        }
        if ($jenis === 'bast') {
            $kontrak = DaftarKontrakMitra::where('id', $model_id)->first();
            if (is_null($kontrak->bast_naskah_keluar_id)) {
                return 'Mohon Generate BAST terlebih dahulu sebelum mencetak!';
            }
        }

        if ($jenis === 'bastp') {
            $bastp = PembelianPersediaan::where('id', $model_id)->first();
            if (! in_array($bastp->status, ['diterima', 'dicetak'])) {
                return 'Hanya yang berstatus diterima atau dicetak yang dapat dicetak ulang.';
            }
            if (empty($bastp->tanggal_buku)) {
                return 'Lengkapi terlebih dahulu tanggal buku dan tanggal BAST pada daftar yang akan dicetak.';
            }
        }

        if ($jenis === 'bon') {
            $permintaan = PermintaanPersediaan::where('id', $model_id)->first();
            if (empty($permintaan->pbmn_user_id)) {
                return 'Lengkapi terlebih dahulu tanggal persetujuan dan Pengelola Persediaan yang menyetujui pada daftar yang akan dicetak.';
            }
        }

        return null;
    }
}
