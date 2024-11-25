<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DaftarSp2d extends Model
{
    protected $casts = [
        'tanggal_sp2d' => 'date',
    ];
    protected $fillable = ['dipa_id', 'nomor_sp2d'];

    public function kerangkaAcuan(): HasMany
    {
        return $this->hasMany(KerangkaAcuan::class);
    }
}
