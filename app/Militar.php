<?php

namespace cautela;

use Illuminate\Database\Eloquent\Model;

class Militar extends Model
{
    protected $table = 'militares';
    public $timestamps = true;
    /*O que pode ser inserido nesse objeto*/
    protected $fillable = array('nome', 'patente', 'nome_guerra','pelotao','telefone', 'email','active');

    /*O não pode ser modificado*/
    protected $guarded = ['id'];
}
