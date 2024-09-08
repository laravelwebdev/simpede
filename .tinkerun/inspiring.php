<?php

use App\Helpers\Cetak;
use App\Helpers\Inspiring;
use App\Helpers\Policy;
use App\Models\Dipa;
use App\Models\JenisKontrak;
use App\Models\KerangkaAcuan;
use App\Models\NaskahKeluar;
use App\Models\Template;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;


Helper::formatSpj(DaftarHonor::where('honor_survei_id', 3)->get(['nama As spj_nama', 'satuan AS spj_satuan', 'jumlah AS spj_jumlah', 'bruto AS spj_bruto', 'pajak AS spj_pajak', 'netto AS spj_netto', 'rekening AS spj_rekening']))





