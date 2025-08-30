<?php

namespace App\Console\Commands;

use App\Models\Announcement;
use App\Models\DataPegawai;
use App\Models\DerajatNaskah;
use App\Models\Dipa;
use App\Models\HargaSatuan;
use App\Models\JenisBelanja;
use App\Models\JenisKontrak;
use App\Models\JenisNaskah;
use App\Models\JenisPulsa;
use App\Models\KamusAnggaran;
use App\Models\KepkaMitra;
use App\Models\KodeArsip;
use App\Models\KodeBank;
use App\Models\KodeNaskah;
use App\Models\LimitPulsa;
use App\Models\MasterBarangPemeliharaan;
use App\Models\MasterPersediaan;
use App\Models\MasterWilayah;
use App\Models\MataAnggaran;
use App\Models\Mitra;
use App\Models\NaskahDefault;
use App\Models\Pengelola;
use App\Models\RateTranslok;
use App\Models\SkTranslok;
use App\Models\TargetKkp;
use App\Models\TargetSerapanAnggaran;
use App\Models\TataNaskah;
use App\Models\Template;
use App\Models\UnitKerja;
use App\Models\User;
use App\Models\UserEksternal;
use App\Models\WhatsappGroup;
use Illuminate\Console\Command;

class SimpedeCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simpede:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all laracache entities';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Announcement::cache()->updateAll();
        DataPegawai::cache()->updateAll();
        DerajatNaskah::cache()->updateAll();
        Dipa::cache()->updateAll();
        HargaSatuan::cache()->updateAll();
        JenisBelanja::cache()->updateAll();
        JenisKontrak::cache()->updateAll();
        JenisNaskah::cache()->updateAll();
        JenisPulsa::cache()->updateAll();
        KamusAnggaran::cache()->updateAll();
        KepkaMitra::cache()->updateAll();
        KodeArsip::cache()->updateAll();
        KodeBank::cache()->updateAll();
        KodeNaskah::cache()->updateAll();
        LimitPulsa::cache()->updateAll();
        MasterBarangPemeliharaan::cache()->updateAll();
        MasterPersediaan::cache()->updateAll();
        MasterWilayah::cache()->updateAll();
        MataAnggaran::cache()->updateAll();
        Mitra::cache()->updateAll();
        NaskahDefault::cache()->updateAll();
        Pengelola::cache()->updateAll();
        RateTranslok::cache()->updateAll();
        SkTranslok::cache()->updateAll();
        TargetKkp::cache()->updateAll();
        TargetSerapanAnggaran::cache()->updateAll();
        TataNaskah::cache()->updateAll();
        Template::cache()->updateAll();
        UnitKerja::cache()->updateAll();
        User::cache()->updateAll();
        UserEksternal::cache()->updateAll();
        WhatsappGroup::cache()->updateAll();

        $this->info('All cache updated successfully.');
    }
}
