<?php

namespace cautela\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use cautela\Http\Controllers\Controller;
use cautela\Cautela;
use Validator;

class CautelaController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function lista(){
    	$cautelas = DB::select('select cautelas.id, militares.nome_guerra as nome, data_cautela
    		from cautelas,militares
    		where cautelas.militar = militares.id');
		
		return view('cautela.listagem')->withCautelas($cautelas);
	}

	public function novo(){
    	$militares = DB::select('select * from militares');
		
		return view('cautela.novo')->withMilitares($militares);
	}

	public function adiciona(){
    	Cautela::create(Request::all());
		return redirect()->action('CautelaController@lista');
	}

	public function apaga(){
		$cautela = Cautela::find(Request::input('id'));
		$cautela->delete();

		return redirect()->action('CautelaController@lista');
	}

	public function detalhes(){
		$id = Request::input('id');
		$cautela = DB::select('select cautelas.id, militares.nome_guerra as nome 
    		from cautelas,militares
    		where cautelas.militar = militares.id
            and cautelas.id = ?',
        array($id));

    	$materiaiscautelados = DB::select('select cautelamateriais.id as id, cautelamateriais.cautela as cautela, materiais.nome, data_cautela, cautelamateriais.quantidade as quantidade, cautelamateriais.data_entrega as data_entrega
    		from cautelamateriais, materiais
    		where cautelamateriais.material = materiais.id
            and cautelamateriais.cautela = ?',
            array($id));
		
		return view('cautela.detalhes')->withCautela($cautela)->withCautelados($materiaiscautelados);

	}
}
