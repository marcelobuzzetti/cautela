<?php

namespace cautela;

use Illuminate\Database\Eloquent\Model;

class CautelaMaterial extends Model
{
    protected $table = 'cautelamateriais';
    public $timestamps = false;
    /*O que pode ser inserido nesse objeto*/
    protected $fillable = array('cautela', 'material', 'quantidade', 'data_cautela', 'data_entrega','observacao_cautela', 'observacao_entrega');

    /*O não pode ser modificado*/
    protected $guarded = ['id'];
}
