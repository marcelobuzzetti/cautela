<?php

namespace cautela;

use Illuminate\Database\Eloquent\Model;

class Pelotao extends Model
{
   	protected $table = 'pelotoes';
    public $timestamps = false;
    /*O que pode ser inserido nesse objeto*/
    protected $fillable = array('nome','active');

    /*O não pode ser modificado*/
    protected $guarded = ['id'];
}
