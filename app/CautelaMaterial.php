<?php

namespace cautela;

use Illuminate\Database\Eloquent\Model;

class CautelaMaterial extends Model
{
    protected $table = 'cautelamateriais';
    public $timestamps = false;
    /*O que pode ser inserido nesse objeto*/
    protected $fillable = array('cautela', 'material', 'data_cautela');

    /*O não pode ser modificado*/
    protected $guarded = ['id'];
}
