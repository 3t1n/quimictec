<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtividadesExternas extends Model
{
    protected $table = 'atividades_externas';
    protected $fillable = [
        'usuario_id',
        'data',
        'horario',
        'atividade',
        'descricao'
    ];
}
