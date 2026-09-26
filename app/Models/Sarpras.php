<?php

namespace App\Models;

use Sakuci\Database\Model;

class Sarpras extends Model
{
    protected static ?string $table = 'sarpras';
    protected string $primaryKey = 'id_sarpras';
    protected array $fillable = [
        'id_kategori',
        'id_kondisi',
        'kode_sarpras',
        'nama_sarpras',
    
    ];
}