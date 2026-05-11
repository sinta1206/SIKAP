<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data kolom.
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Helper untuk memeriksa apakah user adalah Pegawai Desa.
     */
    public function isPegawai()
    {
        return $this->role === 'pegawai_desa';
    }

    /**
     * Helper untuk memeriksa apakah user adalah Panitia Pemilu.
     */
    public function isPanitia()
    {
        return $this->role === 'panitia_pemilu';
    }

    public function getAuthIdentifierName()
    {
        return 'username';
    }
}
