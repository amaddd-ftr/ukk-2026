<?php

namespace App\Models;

use Sakuci\Database\Model;

class Gedung extends Model
{
    protected static ?string $table = 'gedung';
    protected string $primaryKey = 'id_gedung';
    protected array $fillable = ['nama_gedung'];
}
