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
        $id = Request::input('id');
    	$cautela = DB::select('select cautelas.id, militares.nome_guerra as nome 
    		from cautelas,militares
    		where cautelas.militar = militares.id
            and cautelas.id = ?',
        array($id));
        
    	$materiais = DB::select('select *from materiais');

    	$materiaiscautelados = DB::select('select materiais.nome, data_cautela 
    		from cautelamateriais, materiais
    		where cautelamateriais.material = materiais.id
           and cautelamateriais.cautela = ?',
            array($id));
		
		return view('cautelamaterial.novo')->withCautela($cautela)->withMateriais($materiais)->withCautelados($materiaiscautelados);
	}

    public function adiciona(){
        CautelaMaterial::create(Request::all());
         $id = Request::input('id');
        $cautela = DB::select('select cautelas.id, militares.nome_guerra as nome 
            from cautelas,militares
            where cautelas.militar = militares.id
            and cautelas.id = ?',
        array($id));
        
        $materiais = DB::select('select *from materiais');

        $materiaiscautelados = DB::select('select materiais.nome, data_cautela 
            from cautelamateriais, materiais
            where cautelamateriais.material = materiais.id');
        
        return view('cautelamaterial.novo')->withCautela($cautela)->withMateriais($materiais)->withCautelados($materiaiscautelados);
    }
}
