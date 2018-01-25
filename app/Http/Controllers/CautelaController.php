<?php

namespace cautela\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use cautela\Http\Controllers\Controller;
use cautela\Cautela;
use Validator;

class CautelaController extends Controller
{
    public function lista(){
    	$cautelas = DB::select('select cautelas.id, militares.nome_guerra as nome, materiais.nome as material, cautelas.quantidade as quantidade, data_cautela
    		from cautelas,militares,materiais 
    		where cautelas.militar = militares.id
    		and cautelas.material = materiais.id');
		
		return view('cautela.listagem')->withCautelas($cautelas);
	}
}
