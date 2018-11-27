<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ponto extends Model
{
  protected $table = 'ponto';
  protected $fillable = [
      'longitude',
      'latitude',
      'id_usuario',
      'data',
      'horario',
      'controle',
  ];
}
