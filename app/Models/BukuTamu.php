<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    protected $fillable = [
        'nama',
        'alamat',
        'email',
        'no_telepon',
        'keperluan',
        'waktu_datang',
        'foto_wajah',
        'status',
    ];

    protected $casts = [
        'waktu_datang' => 'datetime',
    ];

    /**
     * Get the email address of the tamu
     */
    public function getEmailForNotification(): string
    {
        return $this->email;
    }
}
