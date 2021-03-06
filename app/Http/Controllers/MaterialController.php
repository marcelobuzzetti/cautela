<?php

namespace cautela\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use cautela\Http\Controllers\Controller;
use cautela\Material;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class MaterialController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
    public function lista(){
    	if(Auth::user()->perfil == 1){
    		$materiais = DB::select('select materiais.id, materiais.nome, materiais.valor, 
									materiais.descricao, materiais.quantidade, reservas.nome as reserva, materiais.active, 
									sum(materiais.quantidade - ifnull((select sum(cautelamateriais.quantidade) AS quantidade 
									from cautelamateriais
									where cautelamateriais.data_entrega IS NULL
									and cautelamateriais.material = materiais.id
									group by cautelamateriais.material),0)) as existente
						    		from materiais,reservas 
						    		where materiais.reserva = reservas.id
						            group by materiais.id
						            order by materiais.nome');

    	} else {

    		$materiais = DB::select('select materiais.id, materiais.nome, materiais.valor, 
									materiais.descricao, materiais.quantidade, reservas.nome as reserva, materiais.active, 
									sum(materiais.quantidade - ifnull((select sum(cautelamateriais.quantidade) AS quantidade 
									from cautelamateriais
									where cautelamateriais.data_entrega IS NULL
									and cautelamateriais.material = materiais.id
									group by cautelamateriais.material),0)) as existente
						    		from materiais,reservas 
						    		where materiais.reserva = reservas.id
						    		and reservas.id != 1
						    		and active = 1
						    		and materiais.reserva = ?
						    		group by materiais.id
						    		order by materiais.nome',
	    		array(Auth::user()->perfil));
    }
		
		return view('material.listagem')->withMateriais($materiais);
	}

	public function novo(){
		$reservas = DB::select('select * from reservas');

		return view('material.novo')->withReservas($reservas);
	}

	public function adiciona(){

		if (Request::input('id')){
			Material::find(Request::input('id'))->update(Request::all());
			return redirect()->action('MaterialController@lista')->withInput();
		} else {
			$material = Request::all();
			$nome = $material['nome'];
			Material::create(Request::all());
			return redirect()->action('MaterialController@lista')->with('status', 'Material '.$nome.' adicionado com sucesso');
		}
			return view('material.listagem')->withMateriais($materiais);
	}

	public function altera($id){
		$material = Material::find($id);
		if(Auth::user()->perfil == 1){
			$reservas = DB::select('select * from reservas');
		} else {
			$reservas = DB::select('select * from reservas 
			where id = ?',
	    	array(Auth::user()->perfil));
		}

		return view('material.atualiza')->withM($material)->withReservas($reservas);
	}

	public function apaga(){
		$material = Material::find(Request::input('id'));
		
		try {

		$material->delete();

		} catch (QueryException $e) {

		DB::table('materiais')
            ->where('id', Request::input('id'))
            ->update(['active' => 2]);

		} finally {

			return redirect()->action('MaterialController@lista');

		}

	}

	public function ativa(){
		
		DB::table('materiais')
            ->where('id', Request::input('id'))
            ->update(['active' => 1]);

        return redirect()->action('MaterialController@lista');
		

	}
}
