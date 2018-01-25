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
    	$cautelas = DB::select('select cautelas.id, militares.nome_guerra as nome, data_cautela
    		from cautelas,militares
    		where cautelas.militar = militares.id');
		
		return view('cautela.listagem')->withCautelas($cautelas);
	}
}
