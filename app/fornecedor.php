<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fornecedor extends Model
{
    protected $table = 'fornecedores';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'email',
        'cpf_cnpj',
        'telefone',
        'cep',
        'bairro',
        'cidade',
        'uf',
        'logradouro',
        'numero',
        'complemento',
        'produto'
    ];
}
