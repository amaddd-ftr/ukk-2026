<?php

namespace App\Models;

use Sakuci\Database\Model;

class Sarana extends Model
{
    protected static ?string $table = 'sarana';
    protected string $primaryKey = 'id_sarana';

    protected array $fillable = [
        'id_ruangan',
        'id_kondisi',
        'kode_sarana',
        'nama_sarana',
        'jumlah_sarana'
    ];
}