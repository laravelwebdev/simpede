<?php

namespace App\Console\Commands;

use App\Models\DaftarKontrakMitra;
use Illuminate\Console\Command;

class UpgradeDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simpede:upgrade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $daftar_kontrak = DaftarKontrakMitra::with('kontrakMitra')->get();
        foreach ($daftar_kontrak as $kontrak) {
            $kontrak->update([
                'awal_kontrak' => $kontrak->kontrakMitra->awal_kontrak,
                'akhir_kontrak' => $kontrak->kontrakMitra->akhir_kontrak,
                'tanggal_spk' => $kontrak->kontrakMitra->tanggal_spk,
                'spk_ppk_user_id' => $kontrak->kontrakMitra->ppk_user_id,
                'spk_kode_arsip_id' => $kontrak->kontrakMitra->kode_arsip_id,
            ]);
        }
        $daftar_kontrak = DaftarKontrakMitra::with('bastMitra')->get();
        foreach($daftar_kontrak as $daftar) {
            if (! empty($daftar->bastMitra))
            $daftar->update(
                [
                    'tanggal_bast' => $daftar->bastMitra->tanggal_bast,
                    'bast_ppk_user_id' => $daftar->bastMitra->ppk_user_id,
                    'bast_kode_arsip_id' => $daftar->bastMitra->kode_arsip_id,
                ]

            );
        }
        $this->info('Database upgrade completed successfully.');
    }
}
