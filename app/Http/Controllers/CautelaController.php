<?php

namespace cautela\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use cautela\Http\Controllers\Controller;
use cautela\Cautela;
use Validator;
use Illuminate\Support\Facades\Auth;

class CautelaController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function lista(){
    	$cautelas = DB::select('select reservas.nome as reserva, cautelas.id, militares.nome_guerra as nome, data_cautela, data_entrega
    		from cautelas,militares, reservas
    		where cautelas.militar = militares.id
    		and cautelas.reserva = reservas.id
            and cautelas.reserva =  ?',
            array(Auth::user()->perfil));
		
		return view('cautela.listagem')->withCautelas($cautelas);
	}

	public function novo(){
    	$militares = DB::select('select * from militares');
		
		return view('cautela.novo')->withMilitares($militares);
	}

	public function adiciona(){
		$cautela = Request::all();
		$cautela['reserva'] = Auth::user()->perfil;
		$cautela['usuario_cautela'] = Auth::user()->id;
    	Cautela::create($cautela);
		return redirect()->action('CautelaController@lista');
	}

	public function encerra(){
		$id = Request::input('id');
        $today = date("Y-m-d"); 
        $count = DB::select('select count(id) as count from cautelamateriais where data_entrega IS NULL and cautela = ?',
        	array($id));

        foreach ($count as $c) {
				$count = $c->count;
			}

        if($count > 0){

			return redirect()->action('CautelaController@lista')->with('status', 'Cautela tem Materiais pendentes!');

        }else{

        	Cautela::where('id', $id)->update(array('data_entrega' => $today,'usuario_entrega' => Auth::user()->id));

			return redirect()->action('CautelaController@lista');
		}
	}

	public function apaga(){
		$id = Request::input('id');
		$count = DB::select('select count(id) as count from cautelamateriais where cautela = ?',
        	array($id));

		foreach ($count as $c) {
				$count = $c->count;
		}

        if($count > 0){
        	return redirect()->action('CautelaController@lista')->with('status', 'Essa cautela não pode ser apagada!');
        } else {

		$cautela = Cautela::find($id);
		$cautela->delete();
		return redirect()->action('CautelaController@lista');

		}
	}

	public function detalhes(){
		$id = Request::input('id');
		$cautela = DB::select('select cautelas.id, postograd.patente, militares.nome_guerra as nome 
    		from cautelas,militares, postograd
    		where cautelas.militar = militares.id
    		and militares.patente = postograd.id
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
