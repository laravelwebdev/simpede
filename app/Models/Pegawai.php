<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    public function setGolonganAttribute($value)
    {
        $this->attributes['golongan'] = $value;
        switch ($this->golongan) {
            case 'I/a':
                $this->attributes['pangkat'] = 'Juru Muda';
                break;
            case 'I/b':
                $this->attributes['pangkat'] = 'Juru Muda Tingkat 1';
                break;
            case 'I/c':
                $this->attributes['pangkat'] = 'Juru';
                break;
            case 'I/d':
                $this->attributes['pangkat'] = 'Juru Tingkat 1';
                break;
            case 'II/a':
                $this->attributes['pangkat'] = 'Pengatur Muda';
                break;
            case 'II/b':
                $this->attributes['pangkat'] = 'Pengatur Muda Tingkat 1';
                break;
            case 'II/c':
                $this->attributes['pangkat'] = 'Pengatur';
                break;
            case 'II/d':
                $this->attributes['pangkat'] = 'Pengatur Tingkat 1';
                break;
            case 'III/a':
                $this->attributes['pangkat'] = 'Penata Muda';
                break;
            case 'III/b':
                $this->attributes['pangkat'] = 'Penata Muda Tingkat 1';
                break;
            case 'III/c':
                $this->attributes['pangkat'] = 'Penata';
                break;
            case 'III/d':
                $this->attributes['pangkat'] = 'Penata Tingkat 1';
                break;
            case 'IV/a':
                $this->attributes['pangkat'] = 'Pembina';
                break;
            case 'IV/b':
                $this->attributes['pangkat'] = 'Pembina Tingkat 1';
                break;
            case 'IV/c':
                $this->attributes['pangkat'] = 'Pembina Utama Muda';
                break;
            case 'IV/d':
                $this->attributes['pangkat'] = 'Pembina Utama Madya';
                break;
            case 'IV/e':
                $this->attributes['pangkat'] = 'Pembina Utama';
                break;

        }
    }
}
