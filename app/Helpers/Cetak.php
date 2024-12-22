<?php

namespace App\Helpers;

use App\Models\AnggaranKerangkaAcuan;
use App\Models\BarangPersediaan;
use App\Models\BastMitra;
use App\Models\DaftarKontrakMitra;
use App\Models\DaftarPemeliharaan;
use App\Models\DaftarPenilaianReward;
use App\Models\DaftarPesertaPerjalanan;
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
use App\Models\RapatInternal;
use App\Models\RewardPegawai;
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
    public static function cetak($jenis, $models, $filename, $template_id, $tanggal = null, $pengelola = null)
    {
        $mainTemplate = null;
        $mainXml = '';

        foreach ($models as $index => $model) {
            self::validate($jenis, $model->id);

            $template = self::getTemplate($jenis, $model->id, $template_id, $tanggal, $pengelola);

            if ($index === 0) {
                $mainTemplate = $template;
                $mainXml = self::getMainXml($mainTemplate);
            } else {
                $innerXml = self::getModifiedInnerXml($template);
                $mainXml = preg_replace('/<\/w:body>/', $innerXml.'</w:body>', $mainXml);
            }
        }

        if ($mainTemplate === null) {
            throw new \Exception('Main template could not be created.');
        }

        $mainTemplate->settempDocumentMainPart($mainXml);
        $filename .= '.docx';
        $mainTemplate->saveAs(Storage::path('public/'.$filename));

        return $filename;
    }

    /**
     * Ambil TemplateProsessor.
     *
     * @param  string  $jenis  kak|spj|sk|st|dpr|spd|bon
     * @return TemplateProcessor
     */
    public static function getTemplate(string $jenis, $id, $template_id, $tanggal, $pengelola)
    {
        $templateProcessor = new TemplateProcessor(Helper::getTemplatePathById($template_id)['path']);
        if ($tanggal || $pengelola) {
            $data = call_user_func('App\Helpers\Cetak::'.$jenis, $id, $tanggal, $pengelola);
        } else {
            $data = call_user_func('App\Helpers\Cetak::'.$jenis, $id);
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
            BarangPersediaan::where('barang_persediaanable_id', $id)->where('barang_persediaanable_type', 'App\Models\PembelianPersediaan')->update(['tanggal_transaksi' => $pembelian->first()->tanggal_buku]);
        }
        if ($jenis === 'bon') {
            $templateProcessor->cloneRowAndSetValues('no', Helper::formatBarangPersediaan($data['daftar_barang']));
            unset($data['daftar_barang']);
            $permintaan = PermintaanPersediaan::where('id', $id);
            $permintaan->update(['status' => 'dicetak']);
            BarangPersediaan::where('barang_persediaanable_id', $id)->where('barang_persediaanable_type', 'App\Models\PermintaanPersediaan')->update(['tanggal_transaksi' => $permintaan->first()->tanggal_persetujuan]);
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
        $templateProcessor->setValues($data);

        return $templateProcessor;
    }

    /**
     * Ambil XML dari dokumen utama.
     *
     * @param  TemplateProcessor  $templateProcessor
     * @return string
     */
    public static function getMainXml($templateProcessor)
    {
        return $templateProcessor->gettempDocumentMainPart();
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
            'unit' => Helper::getPropertyFromCollection(UnitKerja::cache()->get('all')->where('id', $data->unit_kerja_id)->first(), 'unit'),
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
            'nip' => Helper::getPropertyFromCollection($koordinator, 'nip'),
            'no_dipa' => Helper::getPropertyFromCollection($dipa, 'nomor'),
            'tanggal_dipa' => Helper::terbilangTanggal(Helper::getPropertyFromCollection($dipa, 'tanggal')),
            'tahun' => Helper::getPropertyFromCollection($dipa, 'tahun'),
            'jabatan' => Helper::getPropertyFromCollection(Helper::getDataPegawaiByUserId($data->koordinator_user_id, $data->tanggal), 'jabatan') == 'Kepala Subbagian Umum' ? 'Kepala Subbagian Umum' : 'Penanggung Jawab Kegiatan',
            'waktu' => Helper::jangkaWaktuHariKalender($data->awal, $data->akhir),
            'awal' => Helper::terbilangTanggal($data->awal),
            'akhir' => Helper::terbilangTanggal($data->akhir),
            'ppk' => Helper::getPropertyFromCollection($ppk, 'name'),
            'nipppk' => Helper::getPropertyFromCollection($ppk, 'nip'),
        ];
    }

    public static function pernyataan_kendaraan($id)
    {
        $data = DaftarPesertaPerjalanan::find($id);
        $user = Helper::getPegawaiByUserId($data->user_id);
        $data_user = Helper::getDataPegawaiByUserId($data->user_id, $data->tanggal_kuitansi);
        $perjalanan = $data->perjalananDinas;

        return [
            'nama' => Helper::getPropertyFromCollection($user, 'name'),
            'nama_ttd' => Helper::namaTanpaGelar(Helper::getPropertyFromCollection($user, 'name')),
            'nip' => Helper::getPropertyFromCollection($user, 'nip'),
            'pangkat' => Helper::getPropertyFromCollection($data_user, 'pangkat'),
            'golongan' => Helper::getPropertyFromCollection($data_user, 'golongan'),
            'jabatan' => Helper::getPropertyFromCollection($data_user, 'jabatan'),
            'berangkat' => Helper::terbilangTanggal($data->tanggal_berangkat),
            'kembali' => Helper::terbilangTanggal($data->tanggal_kembali),
            'uraian' => Helper::getPropertyFromCollection($perjalanan, 'uraian'),
        ];
    }

    public static function sppd($id)
    {
        $data = DaftarPesertaPerjalanan::find($id);
        $user = Helper::getPegawaiByUserId($data->user_id);
        $data_user = Helper::getDataPegawaiByUserId($data->user_id, $data->tanggal_kuitansi);
        $perjalanan = $data->perjalananDinas;
        $kepala = Helper::getPegawaiByUserId($perjalanan->kepala_user_id);
        $ppk = Helper::getPegawaiByUserId($perjalanan->ppk_user_id);

        return [
            'no_st' => NaskahKeluar::find($perjalanan->st_naskah_keluar_id)->nomor,
            'uraian_spd' => Helper::getPropertyFromCollection($perjalanan, 'uraian'),
            'nama' => Helper::getPropertyFromCollection($user, 'name'),
            'nip' => Helper::getPropertyFromCollection($user, 'nip'),
            'berangkat' => Helper::terbilangTanggal($data->tanggal_berangkat),
            'kembali' => Helper::terbilangTanggal($data->tanggal_kembali),
            'tanggal_st' => Helper::terbilangTanggal($perjalanan->tanggal_st),
            'kepala' => Helper::getPropertyFromCollection($kepala, 'name'),
            'kepala_ttd' => Helper::namaTanpaGelar(Helper::getPropertyFromCollection($kepala, 'name')),
            'nipkepala' => Helper::getPropertyFromCollection($kepala, 'nip'),
            'no_spd' => NaskahKeluar::find($perjalanan->spd_naskah_keluar_id)->nomor,
            'ppk' => Helper::getPropertyFromCollection($ppk, 'name'),
            'pangkat' => Helper::getPropertyFromCollection($data_user, 'pangkat'),
            'golongan' => Helper::getPropertyFromCollection($data_user, 'golongan'),
            'jabatan' => Helper::getPropertyFromCollection($data_user, 'jabatan'),
            'angkutan' => $data->angkutan,
            'asal' => $data->asal,
            'tujuan' => $data->tujuan,
            'waktu' => Helper::jangkaWaktu($data->tanggal_berangkat, $data->tanggal_kembali),
            'berangkat' => Helper::terbilangTanggal($data->tanggal_berangkat),
            'kembali' => Helper::terbilangTanggal($data->tanggal_kembali),
            'mak' => Helper::getMataAnggaranById($perjalanan->anggaranKerangkaAcuan->mataAnggaran->id)->mak,
            'tanggal_spd' => Helper::terbilangTanggal($perjalanan->tanggal_spd),
            'nipppk' => Helper::getPropertyFromCollection($ppk, 'nip'),
        ];
    }

    public static function karken_pemeliharaan($id, $tanggal, $pengelola)
    {
        $data = MasterBarangPemeliharaan::find($id);
        $user = Helper::getPegawaiByUserId($pengelola);
        $tanggal = Helper::createDateFromString($tanggal);

        return [
            'tanggal_cetak' => Helper::terbilangTanggal($tanggal),
            'bmn' => Helper::namaTanpaGelar(Helper::getPropertyFromCollection($user, 'name')),
            'barang' => $data->nama_barang,
            'kode_barang' => $data->kode_barang,
            'nup' => $data->nup,
            'tahun' => session('year'),
            'daftar_pemeliharaan' => DaftarPemeliharaan::whereYear('tanggal', session('year'))->where('tanggal', '<=', $tanggal)->where('master_barang_pemeliharaan_id', $id)->get(),
        ];
    }

    public static function karken_persediaan($id, $tanggal, $pengelola)
    {
        $data = MasterPersediaan::find($id);
        $user = Helper::getPegawaiByUserId($pengelola);
        $tanggal = Helper::createDateFromString($tanggal);

        return [
            'tanggal' => Helper::terbilangTanggal($tanggal),
            'bmn' => Helper::namaTanpaGelar(Helper::getPropertyFromCollection($user, 'name')),
            'barang' => $data->barang,
            'kode' => $data->kode,
            'satuan' => $data->satuan,
            'tahun' => session('year'),
            'daftar_persediaan' => BarangPersediaan::whereYear('tanggal_transaksi', session('year'))
                ->where('tanggal_transaksi', '<=', $tanggal)
                ->where('master_persediaan_id', $id)
                ->with('barangPersediaanable')
                ->orderBy('tanggal_transaksi', 'asc')
                ->orderBy('id', 'asc')
                ->get(),
        ];
    }

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
            'nomor' => $perjalanan->spdNaskahKeluar->nomor,
            'tanggal' => Helper::terbilangTanggal($perjalanan->tanggal_spd),
            'nama' => Helper::getPropertyFromCollection($user, 'name'),
            'nip' => Helper::getPropertyFromCollection($user, 'nip'),
            'ppk' => Helper::getPropertyFromCollection($ppk, 'name'),
            'nipppk' => Helper::getPropertyFromCollection($ppk, 'nip'),
            'bendahara' => Helper::getPropertyFromCollection($bendahara, 'name'),
            'nipbendahara' => Helper::getPropertyFromCollection($bendahara, 'nip'),
            'pangkat' => Helper::getPropertyFromCollection($data_user, 'pangkat'),
            'golongan' => Helper::getPropertyFromCollection($data_user, 'golongan'),
            'berangkat' => Helper::terbilangTanggal($data->tanggal_berangkat),
            'kembali' => Helper::terbilangTanggal($data->tanggal_kembali),
            'uraian' => Helper::getPropertyFromCollection($perjalanan, 'uraian'),
            'asal' => $data->asal,
            'tujuan' => $data->tujuan,
            'waktu' => Helper::jangkaWaktu($data->tanggal_berangkat, $data->tanggal_kembali),
            'biaya_total' => Helper::formatRupiah(Helper::sumSpek($itemdengannilai, 'nilai')),
            'tahun' => Helper::getYearFromDate($perjalanan->tanggal_spd),
            'mak' => Helper::getMataAnggaranById($perjalanan->anggaranKerangkaAcuan->mataAnggaran->id)->mak,
            'item_biaya' => $item_biaya,
            'biaya_terbilang' => Helper::terbilang(Helper::sumSpek($itemdengannilai, 'nilai'), 'uw', ' rupiah'),
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
        $mataanggaran = Helper::getMataAnggaranById($data->mata_anggaran_id);
        $mak = Helper::getPropertyFromCollection($mataanggaran, 'mak');
        $koordinator = Helper::getPegawaiByUserId($data->koordinator_user_id);
        $ppk = Helper::getPegawaiByUserId($data->ppk_user_id);
        $bendahara = Helper::getPegawaiByUserId($data->bendahara_user_id);

        return [
            'nama' => $data->judul_spj,
            'tanggal_spj' => Helper::terbilangTanggal($data->tanggal_spj),
            'detail' => Helper::getPropertyFromCollection($mataanggaran, 'uraian'),
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
            'ketua' => Helper::getPropertyFromCollection($koordinator, 'name'),
            'nipketua' => Helper::getPropertyFromCollection($koordinator, 'nip'),
            'ppk' => Helper::getPropertyFromCollection($ppk, 'name'),
            'nipppk' => Helper::getPropertyFromCollection($ppk, 'nip'),
            'bendahara' => Helper::getPropertyFromCollection($bendahara, 'name'),
            'nipbendahara' => Helper::getPropertyFromCollection($bendahara, 'nip'),
            'terbilang_total' => Helper::terbilang(Helper::makeBaseListMitraAndPegawai($id, $data->tanggal_spj)->sum('bruto'), 'uw', ' rupiah'),
        ];
    }

    public static function st($id)
    {
        $data = HonorKegiatan::find($id);
        $kepala = Helper::getPegawaiByUserId($data->kepala_user_id);

        return [
            'nomor' => NaskahKeluar::find($data->st_naskah_keluar_id)->nomor,
            'kegiatan' => $data->kegiatan,
            'uraian_tugas' => $data->uraian_tugas,
            'awal' => Helper::terbilangTanggal($data->awal),
            'akhir' => Helper::terbilangTanggal($data->akhir),
            'tanggal' => Helper::terbilangTanggal($data->tanggal_st),
            'kepala' => Helper::namaTanpaGelar(Helper::getPropertyFromCollection($kepala, 'name')),
            'daftar_petugas' => Helper::makeStMitraAndPegawai($id, $data->tanggal_st),
        ];
    }

    public static function sertifikat_reward($id)
    {
        $data = RewardPegawai::find($id);
        $kepala = Helper::getPegawaiByUserId($data->kepala_user_id);
        $user = Helper::getPegawaiByUserId($data->user_id);

        return [
            'nomor' => NaskahKeluar::find($data->sertifikat_naskah_keluar_id)->nomor,
            'nama' => $user->name,
            'tahun' => $data->tahun,
            'bulan' => Helper::$bulan[$data->bulan],
            'tanggal' => Helper::terbilangTanggal($data->tanggal_penetapan),
            'kepala' => Helper::getPropertyFromCollection($kepala, 'name'),
        ];
    }

    public static function sk_reward($id)
    {
        $data = RewardPegawai::find($id);
        $kepala = Helper::getPegawaiByUserId($data->kepala_user_id);
        $user = Helper::getPegawaiByUserId($data->user_id);

        return [
            'nomor' => NaskahKeluar::find($data->sk_naskah_keluar_id)->nomor,
            'nama' => $user->name,
            'nip' => $user->nip,
            'tahun' => $data->tahun,
            'golongan' => Helper::getPropertyFromCollection(Helper::getDataPegawaiByUserId($data->user_id, $data->tanggal_penetapan), 'golongan'),
            'bulan' => Helper::$bulan[$data->bulan],
            'ubulan' => strtoupper(Helper::$bulan[$data->bulan]),
            'tanggal' => Helper::terbilangTanggal($data->tanggal_penetapan),
            'kepala' => Helper::upperNamaTanpaGelar(Helper::getPropertyFromCollection($kepala, 'name')),

        ];
    }

    public static function kertas_kerja_reward($id)
    {
        $data = RewardPegawai::find($id);
        $kepala = Helper::getPegawaiByUserId($data->kepala_user_id);
        $user = Helper::getPegawaiByUserId($data->user_id);

        return [
            'tahun' => $data->tahun,
            'nama_pemenang' => $user->name,
            'skor' => DaftarPenilaianReward::where('reward_pegawai_id', $id)->max('nilai_total'),
            'ubulan' => strtoupper(Helper::$bulan[$data->bulan]),
            'tanggal' => Helper::terbilangTanggal($data->tanggal_penetapan),
            'kepala' => Helper::namaTanpaGelar(Helper::getPropertyFromCollection($kepala, 'name')),
            'nipkepala' => Helper::getPropertyFromCollection($kepala, 'nip'),
            'daftar_penilaian' => DaftarPenilaianReward::where('reward_pegawai_id', $id)->where('user_id', '!=', $data->kepala_user_id)->get(),

        ];
    }

    public static function sk($id)
    {
        $data = HonorKegiatan::find($id);
        $kpa = Helper::getPegawaiByUserId($data->kpa_user_id);

        return [
            'nomor' => NaskahKeluar::find($data->sk_naskah_keluar_id)->nomor,
            'kegiatan' => $data->kegiatan,
            'objek_sk' => $data->objek_sk,
            'tahun' => $data->tahun,
            'upper_objek_sk' => Str::upper($data->objek_sk),
            'tanggal' => Helper::terbilangTanggal($data->tanggal_sk),
            'kpa' => Helper::upperNamaTanpaGelar(Helper::getPropertyFromCollection($kpa, 'name')),
            'daftar_petugas' => Helper::makeSkMitraAndPegawai($id, $data->tanggal_sk),
        ];
    }

    public static function kontrak($id)
    {
        $data = DaftarKontrakMitra::where('id', '=', $id)->first();
        $kontrak = KontrakMitra::find($data->kontrak_mitra_id);
        $ppk = Helper::getPegawaiByUserId($kontrak->ppk_user_id);
        $mitra = Helper::getMitraById($data->mitra_id);
        $bulan = Helper::$bulan[$kontrak->bulan];
        $jenis_kontrak = Helper::getJenisKontrakById($kontrak->jenis_kontrak_id)->jenis;

        return [
            'bulan' => $bulan,
            'tahun' => $kontrak->tahun,
            'ubulan' => strtoupper($bulan),
            'no_spk' => NaskahKeluar::find($data->kontrak_naskah_keluar_id)->nomor,
            'hari' => Helper::terbilangHari($kontrak->tanggal_spk),
            'terbilangtanggal' => Helper::terbilangTanggal($kontrak->tanggal_spk, 'l'),
            'ppk' => Helper::upperNamaTanpaGelar(Helper::getPropertyFromCollection($ppk, 'name')),
            'nama' => Helper::upperNamaTanpaGelar(Helper::getPropertyFromCollection($mitra, 'nama')),
            'jenis' => $jenis_kontrak,
            'ujenis' => strtoupper($jenis_kontrak),
            'alamat' => Helper::upperNamaTanpaGelar(Helper::getPropertyFromCollection($mitra, 'alamat')),
            'awal' => Helper::terbilangTanggal($kontrak->awal_kontrak),
            'akhir' => Helper::terbilangTanggal($kontrak->akhir_kontrak),
            'honor' => Helper::formatRupiah((float) $data->nilai_kontrak),
            'terbilanghonor' => Helper::terbilang($data->nilai_kontrak, 'uw', 'rupiah'),
            'tanggal_spk' => Helper::terbilangTanggal($kontrak->tanggal_spk),
            'no_hsks' => Helper::getPropertyFromCollection(Helper::getLatestHargaSatuan($kontrak->tanggal_spk), 'nomor'),
            'daftar_honor' => Helper::makeKontrakMitra($id),
        ];
    }

    public static function bast($id)
    {
        $data = DaftarKontrakMitra::where('id', $id)->first();
        $bast = BastMitra::find($data->bast_mitra_id);
        $kontrak = KontrakMitra::find($data->kontrak_mitra_id);
        $ppk = Helper::getPegawaiByUserId($bast->ppk_user_id);
        $mitra = Helper::getMitraById($data->mitra_id);
        $bulan = Helper::$bulan[$kontrak->bulan];
        $jenis_kontrak = Helper::getJenisKontrakById($kontrak->jenis_kontrak_id)->jenis;

        return [
            'bulan' => $bulan,
            'tahun' => $kontrak->tahun,
            'ubulan' => strtoupper($bulan),
            'no_bast' => NaskahKeluar::find($data->bast_naskah_keluar_id)->nomor,
            'no_spk' => NaskahKeluar::find($data->kontrak_naskah_keluar_id)->nomor,
            'tanggal_spk' => Helper::terbilangTanggal($kontrak->tanggal_spk),
            'hari' => Helper::terbilangHari($bast->tanggal_bast),
            'terbilangtanggal' => Helper::terbilangTanggal($bast->tanggal_bast, 'l'),
            'ppk' => Helper::upperNamaTanpaGelar(Helper::getPropertyFromCollection($ppk, 'name')),
            'nipppk' => Helper::upperNamaTanpaGelar(Helper::getPropertyFromCollection($ppk, 'nip')),
            'nama' => Helper::upperNamaTanpaGelar(Helper::getPropertyFromCollection($mitra, 'nama')),
            'nik' => Helper::upperNamaTanpaGelar(Helper::getPropertyFromCollection($mitra, 'nik')),
            'jenis' => $jenis_kontrak,
            'ujenis' => strtoupper($jenis_kontrak),
            'alamat' => Helper::upperNamaTanpaGelar(Helper::getPropertyFromCollection($mitra, 'alamat')),
            'tanggal_bast' => Helper::terbilangTanggal($kontrak->tanggal_spk),
            'daftar_honor' => Helper::makeKontrakMitra($id),
        ];
    }

    public static function bastp($id)
    {
        $data = PembelianPersediaan::find($id);
        $bmn = Helper::getPegawaiByUserId($data->pbmn_user_id);
        $ppk = Helper::getPegawaiByUserId($data->ppk_user_id);

        return [
            'no_bast' => NaskahKeluar::find($data->bast_naskah_keluar_id)->nomor,
            'hari' => Helper::terbilangHari($data->tanggal_bast),
            'terbilangtanggal' => Helper::terbilangTanggal($data->tanggal_bast, 'l'),
            'bmn' => Helper::getPropertyFromCollection($bmn, 'name'),
            'bmn_ttd' => Helper::namaTanpaGelar(Helper::getPropertyFromCollection($bmn, 'name')),
            'nipbmn' => Helper::getPropertyFromCollection($bmn, 'nip'),
            'daftar_barang' => BarangPersediaan::where('barang_persediaanable_id', $id)->where('barang_persediaanable_type', 'App\Models\PembelianPersediaan')->get()->toArray(),
        ];
    }

    public static function bon($id)
    {
        $data = PermintaanPersediaan::find($id);
        $bmn = Helper::getPegawaiByUserId($data->pbmn_user_id);
        $pembuat = Helper::getPegawaiByUserId($data->user_id);
        $tim_id = Helper::getPropertyFromCollection(Helper::getDataPegawaiByUserId($data->user_id, $data->tanggal_permintaan), 'unit_kerja_id');

        return [
            'nomor' => NaskahKeluar::find($data->naskah_keluar_id)->nomor,
            'tim' => Helper::getPropertyFromCollection(UnitKerja::cache()->get('all')->where('id', $tim_id)->first(), 'unit'),
            'kegiatan' => $data->kegiatan,
            'keterangan' => $data->keterangan,
            'tanggal_permintaan' => Helper::terbilangTanggal($data->tanggal_permintaan),
            'tanggal_persetujuan' => Helper::terbilangTanggal($data->tanggal_persetujuan),
            'nama' => Helper::upperNamaTanpaGelar(Helper::getPropertyFromCollection($pembuat, 'name')),
            'nip' => Helper::getPropertyFromCollection($pembuat, 'nip'),
            'bmn' => Helper::upperNamaTanpaGelar(Helper::getPropertyFromCollection($bmn, 'name')),
            'nipbmn' => Helper::getPropertyFromCollection($bmn, 'nip'),
            'daftar_barang' => BarangPersediaan::where('barang_persediaanable_id', $id)->where('barang_persediaanable_type', 'App\Models\PermintaanPersediaan')->get()->toArray(),
        ];
    }

    public static function undangan($id)
    {
        $data = RapatInternal::find($id);
        $kepala = Helper::getPegawaiByUserId($data->kepala_user_id);

        return [
            'nomor' => NaskahKeluar::find($data->naskah_keluar_id)->nomor,
            'tanggal' => Helper::terbilangTanggal($data->tanggal),
            'tujuan' => $data->tujuan,
            'tema' => $data->tema,
            'tanggal_rapat' => Helper::terbilangTanggal($data->tanggal_rapat),
            'mulai' => Helper::formatJam($data->mulai),
            'tempat' => $data->tempat,
            'agenda' => $data->agenda,
            'kepala' => Helper::getPropertyFromCollection($kepala, 'name'),
        ];
    }

    public static function daftar_hadir($id)
    {
        $data = RapatInternal::find($id);
        $kepala = Helper::getPegawaiByUserId($data->kepala_user_id);
        $kasubbag = Helper::getPegawaiByUserId($data->kasubbag_user_id);

        return [
            'tema' => $data->tema,
            'tanggal_rapat' => Helper::terbilangTanggal($data->tanggal_rapat),
            'mulai' => Helper::formatJam($data->mulai),
            'tempat' => $data->tempat,
            'kepala' => Helper::getPropertyFromCollection($kepala, 'name'),
            'kasubbag' => Helper::getPropertyFromCollection($kasubbag, 'name'),
            'baris' => array_map(function ($i) {
                return ['no' => $i];
            }, range(1, $data->baris)),
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
            $honor = HonorKegiatan::where('id', $model_id)->first();
            throw_if(
                $honor->status == 'dibuat',
                'Mohon lengkapi terlebih dulu isian honor kegiatan yang akan dicetak melalui menu Sunting'
            );
            throw_if(
                Helper::makeBaseListMitraAndPegawai($honor->id, $honor->tanggal_spj)->count() == 0,
                'Belum ada data mitra/pegawai pada daftar ini.'
            );
            throw_if(
                $honor->perkiraan_anggaran < Helper::makeBaseListMitraAndPegawai($honor->id, $honor->tanggal_spj)->sum('bruto'),
                'Total Honor lebih besar dari perkiraan anggaran yang digunakan di KAK'
            );
        }
        if ($jenis === 'st') {
            $honor = HonorKegiatan::where('id', $model_id)->first();
            throw_if(
                Helper::makeBaseListMitraAndPegawai($honor->id, $honor->tanggal_spj)->count() == 0,
                'Belum ada data mitra/pegawai pada daftar ini.'
            );
        }
        if ($jenis === 'sk') {
            $honor = HonorKegiatan::where('id', $model_id)->first();
            throw_if(
                Helper::makeBaseListMitraAndPegawai($honor->id, $honor->tanggal_spj)->count() == 0,
                'Belum ada data mitra/pegawai pada daftar ini.'
            );
        }
        if ($jenis === 'kontrak') {
            $kontrak = DaftarKontrakMitra::where('id', $model_id)->first();
            throw_if(
                is_null($kontrak->kontrak_naskah_keluar_id),
                'Mohon Generate Kontrak terlebih dahulu sebelum mencetak!'
            );
        }
        if ($jenis === 'bast') {
            $kontrak = DaftarKontrakMitra::where('id', $model_id)->first();
            throw_if(
                is_null($kontrak->bast_naskah_keluar_id),
                'Mohon Generate BAST terlebih dahulu sebelum mencetak!'
            );
        }

        if ($jenis === 'bastp') {
            $bastp = PembelianPersediaan::where('id', $model_id)->first();
            throw_if(
                ! in_array($bastp->status, ['diterima', 'dicetak']),
                'Hanya yang berstatus diterima atau dicetak yang dapat dicetak ulang.'
            );
            throw_if(
                empty($bastp->tanggal_buku),
                'Lengkapi terlebih dahulu tanggal buku dan tanggal BAST pada daftar yang akan dicetak.'
            );
        }

        if ($jenis === 'bon') {
            $permintaan = PermintaanPersediaan::where('id', $model_id)->first();
            throw_if(
                empty($permintaan->pbmn_user_id),
                'Lengkapi terlebih dahulu tanggal persetujuan dan Pengelola Persediaan yang menyetujui pada daftar yang akan dicetak.'
            );
        }
    }
}
