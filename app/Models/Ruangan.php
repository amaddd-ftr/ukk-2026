<?php

namespace App\Models;

use Sakuci\Database\Model;

class Ruangan extends Model
{
    protected static ?string $table = 'ruangan';
    protected string $primaryKey = 'id_ruangan';
    protected array $fillable = ['id_gedung','nama_ruangan'];
}
