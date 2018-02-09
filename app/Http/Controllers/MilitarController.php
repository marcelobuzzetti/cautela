<?php

namespace cautela\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use cautela\Http\Controllers\Controller;
use cautela\Militar;
use cautela\Pelotao;
use Validator;

class MilitarController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
    public function lista(){
    	$militares = DB::select('select militares.id, militares.nome, militares.nome_guerra, 
    		pelotoes.nome as pelotao
    		from militares,pelotoes 
    		where pelotoes.id = militares.pelotao');
		
		return view('militar.listagem')->withMilitares($militares);
	}

	public function novo(){

		return view('militar.novo');
	}

	public function adiciona(){
		
		if (Request::input('id')){
			
			$pelotao = Pelotao::find(Request::input('pelotao'));
			$militar['pelotao'] = $pelotao['id'];
			Militar::find(Request::input('id'))->update($militar);
			return redirect()->action('MilitarController@lista')->withInput();
		} else {
			$pelotao = Pelotao::find(Request::input('pelotao'));
			if($pelotao){
				$militar = Request::all();
				$militar['pelotao'] = $pelotao['id'];
				Militar::create($militar);
				return redirect()->action('MilitarController@lista')->withInput(Request::only('nome'));	
			} else {
				$pelotao['nome'] = Request::input('pelotao');
				Pelotao::create($pelotao);
				$pelotao = Pelotao::find($pelotao);
				$militar = Request::all();
				$militar['pelotao'] = $pelotao['id'];
				Militar::create($militar);
				return redirect()->action('MilitarController@lista')->withInput(Request::only('nome'));	
			}
		}
	}

	public function adicionacautela(){

			Militar::create(Request::all());
			return redirect()->action('CautelaController@novo');
	}

	public function altera($id){
		$militar = Militar::find($id);
		$pelotao = Pelotao::find($militar['pelotao']);
		$militar['pelotao'] = $pelotao['nome'];

		return view('militar.atualiza')->withM($militar);
	}

	public function apaga(){
		$militar = Militar::find(Request::input('id'));
		$militar->delete();

		return redirect()->action('MilitarController@lista');

	}
}
