<?php

namespace App\Models;

use Sakuci\Database\Model;

class Pengaduan extends Model
{
    protected static ?string $table = 'pengaduan';
    protected string $primaryKey = 'id_pemgaduan'
    protected array $fillable = [
        'id_siswa',
        'id_sarpras',
        'id_lokasi',
        'id_status',
        'judul',
        'deskripsi',
    ];
}