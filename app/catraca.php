<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class catraca extends Model
{
    protected $table = 'catraca';
    protected $fillable = [
        'usuario_id',
        'data',
        'horario',
        'controle',
    ];
}
