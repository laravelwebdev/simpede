<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SusenasFitur extends Model
{
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
