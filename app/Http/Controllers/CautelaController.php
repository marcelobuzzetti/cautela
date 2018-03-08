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
    	if(Auth::user()->perfil == 1){
    			$cautelas = DB::select('select reservas.nome as reserva, cautelas.id, postograd.patente, militares.nome_guerra as nome, data_cautela, data_entrega, (select users.name from users where users.id = cautelas.usuario_cautela) as cautelador, (select users.name from users where users.id = cautelas.usuario_entrega) as descautelador
    		from cautelas,militares, reservas, postograd
    		where cautelas.militar = militares.id
    		and militares.patente = postograd.id
    		and cautelas.reserva = reservas.id');
		
		return view('cautela.listagem')->withCautelas($cautelas);

    	} else {
    	$cautelas = DB::select('select reservas.nome as reserva, cautelas.id, postograd.patente, militares.nome_guerra as nome, data_cautela, data_entrega
    		from cautelas,militares, reservas, postograd
    		where cautelas.militar = militares.id
    		and cautelas.reserva = reservas.id
    		and militares.patente = postograd.id
            and cautelas.reserva =  ?',
            array(Auth::user()->perfil));
		
		return view('cautela.listagem')->withCautelas($cautelas);
	}
	}

	public function novo(){
    	$militares = DB::select('select militares.id, militares.nome, postograd.patente, militares.nome_guerra, telefone, email, pelotao, militares.active 
			from militares, postograd
			where militares.patente = postograd.id
			order by militares.nome_guerra');

    	$reservas = DB::select('select * from reservas');

    	$posto = DB::select('select * from postograd');
		
		return view('cautela.novo')->withMilitares($militares)->withReservas($reservas)->withPostos($posto);
	}

	public function adiciona(){
		if(Auth::user()->perfil == 1){
			$cautela = Request::all();
			$cautela['usuario_cautela'] = Auth::user()->id;
    		Cautela::create($cautela);
			return redirect()->action('CautelaController@lista')->with('sucesso','Cautela adicioanda com sucesso');
		} else {
			$cautela = Request::all();
			$cautela['reserva'] = Auth::user()->perfil;
			$cautela['usuario_cautela'] = Auth::user()->id;
	    	Cautela::create($cautela);
			return redirect()->action('CautelaController@lista')->with('sucesso','Cautela adicioanda com sucesso');
		}
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

			return redirect()->action('CautelaController@lista')->with('sucesso','Cautela encerrada com sucesso');
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
		return redirect()->action('CautelaController@lista')->with('sucesso', 'Cautela apagada com sucesso!');

		}
	}

	public function detalhes(){
		$id = Request::input('id');
		$cautela = DB::select('select cautelas.id, postograd.patente, militares.nome_guerra as nome, militares.nome as nome_completo, militares.telefone, militares.email, pelotoes.nome as pelotao
    		from cautelas,militares, postograd, pelotoes
    		where cautelas.militar = militares.id
    		and militares.patente = postograd.id
    		and militares.pelotao = pelotoes.id
            and cautelas.id = ?',
        array($id));

        $materiaiscautelados = DB::select('select cautelamateriais.id as id, cautelamateriais.cautela as cautela, materiais.nome, data_cautela, cautelamateriais.quantidade as quantidade, cautelamateriais.data_entrega as data_entrega, observacao_cautela, observacao_entrega
    		from cautelamateriais, materiais
    		where cautelamateriais.material = materiais.id
            and cautelamateriais.cautela = ?',
            array($id));

		
		return view('cautela.detalhes')->withCautela($cautela)->withCautelados($materiaiscautelados);

	}
}
