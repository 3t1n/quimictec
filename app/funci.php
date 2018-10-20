<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class funci extends Model
{
    protected $table = 'funcionarios';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'senha',
        'departamento',
        'cargo',
        'email',
        'cpf',
        'telefone',
        'cep',
        'bairro',
        'cidade',
        'uf',
        'logradouro',
        'numero',
        'complemento'
    ];

}
