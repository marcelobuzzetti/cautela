<?php

namespace cautela\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use cautela\Http\Controllers\Controller;
use cautela\Militar;
use Validator;

class MilitarController extends Controller
{
    public function lista(){
    	$militares = DB::select('select militares.id, militares.nome, militares.nome_guerra, 
    		pelotoes.nome as pelotao
    		from militares,pelotoes 
    		where pelotoes.id = militares.pelotao');
		
		return view('militar.listagem')->withMilitares($militares);
	}

	public function novo(){
		$pelotoes = DB::select('select * from pelotoes');

		return view('militar.novo')->withPelotoes($pelotoes);
	}

	public function adiciona(){

		if (Request::input('id')){
			Militar::find(Request::input('id'))->update(Request::all());
			return redirect()->action('MilitarController@lista')->withInput();
		} else {
			Militar::create(Request::all());
			return redirect()->action('MilitarController@lista')->withInput(Request::only('nome'));
		}
	}

	public function altera($id){
		$militar = Militar::find($id);
		$pelotoes = DB::select('select * from pelotoes');

		return view('militar.atualiza')->withM($militar)->withP($pelotoes);
	}

	public function apaga(){
		$militar = Militar::find(Request::input('id'));
		$militar->delete();

		return redirect()->action('MilitarController@lista');

	}
}
