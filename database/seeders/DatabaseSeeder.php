<?php

namespace Database\Seeders;

use App\Models\DataPegawai;
use App\Models\DerajatNaskah;
use App\Models\Dipa;
use App\Models\HargaSatuan;
use App\Models\JenisKontrak;
use App\Models\JenisNaskah;
use App\Models\KamusAnggaran;
use App\Models\KodeArsip;
use App\Models\KodeNaskah;
use App\Models\MataAnggaran;
use App\Models\Mitra;
use App\Models\Pengelola;
use App\Models\TataNaskah;
use App\Models\Template;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Eloquent::unguard();
        DB::unprepared(
            file_get_contents(database_path().'/dump_sql/users.sql')
        );
        DB::unprepared(
            file_get_contents(database_path().'/dump_sql/data_pegawais.sql')
        );
        DB::unprepared(
            file_get_contents(database_path().'/dump_sql/pengelolas.sql')
        );
        DB::unprepared(
            file_get_contents(database_path().'/dump_sql/tata_naskahs.sql')
        );
        DB::unprepared(
            file_get_contents(database_path().'/dump_sql/kode_naskahs.sql')
        );
        DB::unprepared(
            file_get_contents(database_path().'/dump_sql/jenis_naskahs.sql')
        );
        DB::unprepared(
            file_get_contents(database_path().'/dump_sql/kode_arsips.sql')
        );
        DB::unprepared(
            file_get_contents(database_path().'/dump_sql/templates.sql')
        );
        DB::unprepared(
            file_get_contents(database_path().'/dump_sql/unit_kerjas.sql')
        );
        DB::unprepared(
            file_get_contents(database_path().'/dump_sql/derajat_naskahs.sql')
        );
        DataPegawai::cache()->updateAll();
        DerajatNaskah::cache()->updateAll();
        Dipa::cache()->updateAll();
        HargaSatuan::cache()->updateAll();
        JenisKontrak::cache()->updateAll();
        JenisNaskah::cache()->updateAll();
        KamusAnggaran::cache()->updateAll();
        KodeArsip::cache()->updateAll();
        KodeNaskah::cache()->updateAll();
        MataAnggaran::cache()->updateAll();
        Mitra::cache()->updateAll();
        Pengelola::cache()->updateAll();
        TataNaskah::cache()->updateAll();
        Template::cache()->updateAll();
        UnitKerja::cache()->updateAll();
        User::cache()->updateAll();
    
    }
}
