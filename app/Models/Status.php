<?php

namespace App\Models;

use Sakuci\Database\Model;

class Status extends Model
{
    protected static ?string $table = 'status';
    protected string $primaryKey = 'id_status';
    protected array $fillable = [
        'nama_status',
    ];
}