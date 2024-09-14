<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Laravie\SerializesQuery\Eloquent;

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
    }
}
