<?php

namespace cautela;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfis';
    public $timestamps = true;
    /*O que pode ser inserido nesse objeto*/
    protected $fillable = array('nome');

    /*O não pode ser modificado*/
    protected $guarded = ['id'];
}
