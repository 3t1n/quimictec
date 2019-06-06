<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $fillable = [
        'nome',
        'descricao',

    ];

    public function users()
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }
    public function permitir()
    {
        return $this->belongsToMany(permitir::class);
    }
}
