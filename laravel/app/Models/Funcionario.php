<?php


namespace App\Models;

use Eloquent;

class Funcionario extends Eloquent
{
    protected $fillable = [
        'id',
        'nome',
        'email',
        'nascimento',
        'status'
    ];


    protected $table = "funcionarios";

    public function funcionario() {
        return $this->belongsTo('App\Models\Dependente');
    }

}
