<?php

namespace cautela\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use cautela\Http\Controllers\Controller;
use cautela\Militar;
use cautela\Pelotao;
use Validator;
use Illuminate\Database\QueryException;

class MilitarController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
    public function lista(){
    	$militares = DB::select('select militares.id, militares.nome, militares.nome_guerra, 
    		pelotoes.nome as pelotao, postograd.patente as patente, militares.telefone, militares.email
    		from militares,pelotoes,postograd
    		where pelotoes.id = militares.pelotao
    		and militares.patente = postograd.id
    		and militares.active = 1');
		
		return view('militar.listagem')->withMilitares($militares);
	}

	public function novo(){

		$posto = DB::select('select * from postograd');

		return view('militar.novo')->withPostos($posto);
	}

	public function adiciona(){
		
		if (Request::input('id')){

			
			$pelotao = DB::table('pelotoes')->where('nome', 'like', Request::input('pelotao'))->get();
			$pelotao = json_decode(json_encode($pelotao), true);

			if($pelotao){
				if($pelotao[0]['active'] == 2){
					DB::table('pelotoes')
		            ->where('id', $pelotao[0]['id'])            
		            ->update(['active' => 1]);
				}
				$militar = Request::all();
				$militar['pelotao'] = $pelotao[0]['id'];
				Militar::find(Request::input('id'))->update($militar);
				return redirect()->action('MilitarController@lista')->withInput();
			} else {
				
				$pelotao['nome'] = Request::input('pelotao');
				Pelotao::create($pelotao);
				$a = $pelotao['nome'];
				$pelotao = DB::table('pelotoes')->where('nome', 'like', $a)->get();
				$pelotao = json_decode(json_encode($pelotao), true);
				$militar = Request::all();
				$militar['pelotao'] = $pelotao[0]['id'];
				Militar::find(Request::input('id'))->update($militar);
				return redirect()->action('MilitarController@lista')->withInput();
			}

		} else {

			$pelotao = DB::table('pelotoes')->where('nome', 'like', Request::input('pelotao'))->get();
			$pelotao = json_decode(json_encode($pelotao), true);

			if($pelotao){
				if($pelotao[0]['active'] == 2){
					DB::table('pelotoes')
		            ->where('id', $pelotao[0]['id'])            
		            ->update(['active' => 1]);
				}
				$militar = Request::all();
				$militar['pelotao'] = $pelotao[0]['id'];
				Militar::create($militar);
				return redirect()->action('MilitarController@lista')->withInput(Request::only('nome'));	
			} else {
				$pelotao['nome'] = Request::input('pelotao');
				Pelotao::create($pelotao);
				$a = $pelotao['nome'];
				$pelotao = DB::table('pelotoes')->where('nome', 'like', $a)->get();
				$pelotao = json_decode(json_encode($pelotao), true);
				$militar = Request::all();
				$militar['pelotao'] = $pelotao[0]['id'];
				Militar::create($militar);
				return redirect()->action('MilitarController@lista')->withInput(Request::only('nome'));	
			}
		}
	}

	public function adicionacautela(){

			$pelotao = Pelotao::find(Request::input('pelotao'));
			if($pelotao){
				$militar = Request::all();
				$militar['pelotao'] = $pelotao['id'];
				Militar::create($militar);
				return redirect()->action('CautelaController@novo');	
			} else {
				$pelotao['nome'] = Request::input('pelotao');
				Pelotao::create($pelotao);
				$a = $pelotao['nome'];
				$pelotao = Pelotao::find($a);	
				$militar = Request::all();
				$militar['pelotao'] = $pelotao['id'];
				Militar::create($militar);
				return redirect()->action('CautelaController@novo');
			}
			
	}

	public function altera($id){
		$militar = Militar::find($id);
		$pelotao = Pelotao::find($militar['pelotao']);
		$militar['pelotao'] = $pelotao['nome'];
		$postos = DB::select('select * from postograd');

		return view('militar.atualiza')->withM($militar)->withPostos($postos);
	}

	public function apaga(){
		$militar = Militar::find(Request::input('id'));
		try {

		$militar->delete();

		} catch (QueryException $e) {

		DB::table('militares')
            ->where('id', Request::input('id'))
            ->update(['active' => 2]);

		} finally {

		return redirect()->action('MilitarController@lista');
	}

	}
}
