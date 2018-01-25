<?php

namespace cautela;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
 	protected $table = 'materiais';
    public $timestamps = false;
    /*O que pode ser inserido nesse objeto*/
    protected $fillable = array('nome', 'valor','descricao','quantidade', 'reserva');

    /*O não pode ser modificado*/
    protected $guarded = ['id'];
}
