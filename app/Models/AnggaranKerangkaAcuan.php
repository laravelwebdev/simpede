<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnggaranKerangkaAcuan extends Model
{
    use HasFactory;

    /**
     * Define a relationship where the AnggaranKerangkaAcuan model belongs to the KerangkaAcuan model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kerangkaAcuan(): BelongsTo
    {
        return $this->belongsTo(KerangkaAcuan::class);
    }
}
