<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class homeoffice extends Model
{
    protected $table = 'homeoffice';
    protected $fillable = [
        'usuario_id',
        'data'
    ];
}
