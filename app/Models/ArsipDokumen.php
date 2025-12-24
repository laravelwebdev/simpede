<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArsipDokumen extends Model
{
    protected $fillable = ['slug', 'file', 'kerangka_acuan_id'];
    
    protected function casts(): array
    {
        return [
            'tanggal_dokumen' => 'date',
        ];
    }

    public function kerangkaAcuan(): BelongsTo
    {
        return $this->belongsTo(KerangkaAcuan::class);
    }
}
