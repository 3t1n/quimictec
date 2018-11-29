<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estoque extends Model
{
    protected $table = 'estoque';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome_prod',
        'qtd_prod',
        ];
}
