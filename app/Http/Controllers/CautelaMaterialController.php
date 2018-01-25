<?php

namespace cautela\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use cautela\Http\Controllers\Controller;
use cautela\CautelaMaterial;
use Validator;

class CautelaMaterialController extends Controller
{
    public function novo(){
    	$cautelas = DB::select('select cautelas.id, militares.nome_guerra as nome 
    		from cautelas,militares
    		where cautelas.militar = militares.id');
    	$materiais = DB::select('select *from materiais');

    	$materiaiscautelados = DB::select('select materiais.nome, data_cautela 
    		from cautelamateriais, materiais
    		where cautelamateriais.material = materiais.id');
		
		return view('cautelamaterial.novo')->withCautelas($cautelas)->withMateriais($materiais)->withCautelados($materiaiscautelados);
	}
}
