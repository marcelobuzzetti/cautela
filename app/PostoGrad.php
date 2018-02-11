<?php

namespace cautela;

use Illuminate\Database\Eloquent\Model;

class PostoGrad extends Model
{
    protected $table = 'postograd';
    public $timestamps = true;
    /*O que pode ser inserido nesse objeto*/
    protected $fillable = array('patente');

    /*O não pode ser modificado*/
    protected $guarded = ['id'];
}
