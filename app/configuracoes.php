<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class configuracoes extends Model
{
    protected $table = 'configuracoes';
    protected $fillable = [
        'longitude',
        'latitude',
    ];
}

