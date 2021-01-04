<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $fillable = [
        'nik',
        'nama',
        'tgl_masuk',
        'tgl_lahir'
    ];
}
