<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permitir extends Model
{
    protected $table = 'permitir';
    protected $fillable = [
        'modulo',
    ];
    public function role()
    {
        return $this->belongsToMany(Role::class);
    }
}
