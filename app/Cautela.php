<?php

namespace cautela;

use Illuminate\Database\Eloquent\Model;

class Cautela extends Model
{
    protected $table = 'cautelas';
    public $timestamps = false;
    /*O que pode ser inserido nesse objeto*/
    protected $fillable = array('militar', 'material','quantidade', 'data_cautela', 'data_entrega');

    /*O não pode ser modificado*/
    protected $guarded = ['id'];
}
