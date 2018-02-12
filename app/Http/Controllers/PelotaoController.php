<?php

namespace cautela\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use cautela\Http\Controllers\Controller;
use cautela\Pelotao;
use Validator;
use Illuminate\Database\QueryException;

class PelotaoController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
    public function lista(){
    	$pelotoes = DB::select('select pelotoes.id, pelotoes.nome
    		from pelotoes
    		where active = 1');
		
		return view('pelotao.listagem')->withPelotoes($pelotoes);
	}

	public function novo(){
		return view('pelotao.novo');
	}

	public function adiciona(){

		if (Request::input('id')){
			Pelotao::find(Request::input('id'))->update(Request::all());
			return redirect()->action('PelotaoController@lista')->withInput();
		} else {
			Pelotao::create(Request::all());
			return redirect()->action('PelotaoController@lista')->withInput(Request::only('nome'));
		}
		
			
		}

	public function altera($id){
		$pelotao = Pelotao::find($id);

		return view('pelotao.atualiza')->withP($pelotao);
	}

	public function apaga(){
		$pelotao = Pelotao::find(Request::input('id'));
		try {

		$pelotao->delete();

		} catch (QueryException $e) {

		DB::table('pelotoes')
            ->where('id', Request::input('id'))
            ->update(['active' => 2]);

		} finally{

		return redirect()->action('PelotaoController@lista');
	}

	}

	public function autocomplete(){
	$term = Request::input('term');
	
	$results = array();
	
	$queries = DB::table('pelotoes')
		->where('nome', 'LIKE', '%'.$term.'%')
		->where('active',1)
		->get();
	
	foreach ($queries as $query)
	{
	    $results[] = [ 'id' => $query->id, 'value' => $query->nome ];
	}
	return $results;
	}
}
