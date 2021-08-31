<?php


namespace App\Models;

use Eloquent;

class Dependente extends Eloquent
{
    protected $fillable = [
        'id',
        'funcionario_id',
        'nome',
        'email',
        'nascimento'
    ];


    protected $table = "dependentes";

    public function dependentes() {
        return $this->hasMany('App\Models\Dependente');
    }

}
