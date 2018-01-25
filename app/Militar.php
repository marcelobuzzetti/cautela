<?php

namespace cautela;

use Illuminate\Database\Eloquent\Model;

class Militar extends Model
{
    protected $table = 'militares';
    public $timestamps = false;
    /*O que pode ser inserido nesse objeto*/
    protected $fillable = array('nome', 'nome_guerra','pelotao');

    /*O não pode ser modificado*/
    protected $guarded = ['id'];
}
