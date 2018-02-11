<?php

namespace cautela;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';
    public $timestamps = true;
    /*O que pode ser inserido nesse objeto*/
    protected $fillable = array('nome');

    /*O não pode ser modificado*/
    protected $guarded = ['id'];
}
