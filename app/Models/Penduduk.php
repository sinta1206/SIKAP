<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
   use HasFactory;

    // Daftarkan semua kolom yang boleh diisi
    protected $fillable = [
        'nik',
        'nama',
        'umur',
        'gender',
        'pekerjaan',
        'status_kawin',
        'kewarganegaraan',
        'domisili',
        'status_hidup',
        'hak_pilih',
        'status',
        'keterangan'
    ];
}
