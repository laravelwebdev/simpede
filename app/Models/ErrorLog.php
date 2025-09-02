<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $fillable = [
        'message', 'context', 'level', 'file', 'line', 'resolved', 'count', 'trace',
    ];
}
