<?php

use App\Helpers\Cetak;
use App\Helpers\Inspiring;
use App\Models\Dipa;
use App\Models\JenisKontrak;
use App\Models\KerangkaAcuan;
use App\Models\NaskahKeluar;
use App\Models\Template;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;


$naskah_id = KerangkaAcuan::find(11)->naskah_keluar_id;
NaskahKeluar::find($naskah_id)->nomor;







