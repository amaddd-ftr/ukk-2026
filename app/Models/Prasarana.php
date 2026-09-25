<?php

namespace App\Models;

use Sakuci\Database\Model;

class Prasarana extends Model
{
    protected static ?string $table = 'prasarana';
    protected string $primaryKey = 'id_prasarana';

    protected array $fillable = [
        'id_ruangan',
        'id_kondisi',
        'kode_prasarana',
        'nama_prasarana',
        'jumlah_prasarana'
    ];
}