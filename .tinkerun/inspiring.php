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

JenisKontrak::cache()->get('all')->where('tanggal', '<=', '2024-08-01')->sortByDesc('tanggal')->first()






