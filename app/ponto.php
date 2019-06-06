<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ponto extends Model
{
  protected $table = 'ponto';
  protected $fillable = [
    'nome',
    'longitude',
    'latitude',
    'usuario_id',
    'data',
    'horario',
    'controle',
    'forma'
];
}
