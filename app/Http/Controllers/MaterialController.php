<?php

namespace cautela\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use cautela\Http\Controllers\Controller;
use cautela\Material;
use Validator;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
    public function lista(){
    	if(Auth::user()->perfil == 1){
    		$materiais = DB::select('select materiais.id, materiais.nome, materiais.valor, 
    		materiais.descricao, materiais.quantidade, reservas.nome as reserva
    		from materiais,reservas 
    		where materiais.reserva = reservas.id');

    	} else {

    		$materiais = DB::select('select materiais.id, materiais.nome, materiais.valor, 
	    		materiais.descricao, materiais.quantidade, reservas.nome as reserva
	    		from materiais,reservas 
	    		where materiais.reserva = reservas.id
	    		and reservas.id != 1
	    		and materiais.reserva = ?',
	    		array(Auth::user()->perfil));
    }
		
		return view('material.listagem')->withMateriais($materiais);
	}

	public function novo(){
		if(Auth::user()->perfil == 1){
		$reservas = DB::select('select * from reservas');

		return view('material.novo')->withReservas($reservas);
		}else{
			return view('inicio');
		}
	}

	public function adiciona(){

		if(Auth::user()->perfil == 1){
		if (Request::input('id')){
			Material::find(Request::input('id'))->update(Request::all());
			return redirect()->action('MaterialController@lista')->withInput();
		} else {
			Material::create(Request::all());
			return redirect()->action('MaterialController@lista')->withInput(Request::only('nome'));
		}
			return view('material.listagem')->withMateriais($materiais);
		}else{
			return view('inicio');
		}		
	}

	public function altera($id){
		$material = Material::find($id);
		$reservas = DB::select('select * from reservas 
			where id = ?',
	    	array(Auth::user()->perfil));

		return view('material.atualiza')->withM($material)->withReservas($reservas);
	}

	public function apaga(){
		$material = Material::find(Request::input('id'));
		$material->delete();

		return redirect()->action('MaterialController@lista');

	}
}
