<?php

namespace cautela;

use Illuminate\Database\Eloquent\Model;

class Cautela extends Model
{
    protected $table = 'cautelas';
    public $timestamps = false;
    /*O que pode ser inserido nesse objeto*/
    protected $fillable = array('militar', 'reserva', 'data_cautela', 'data_entrega','usuario_cautela','usuario_entrega');

    /*O não pode ser modificado*/
    protected $guarded = ['id'];
}
