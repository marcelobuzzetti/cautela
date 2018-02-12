<?php

namespace cautela\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use cautela\Http\Controllers\Controller;
use cautela\Reserva;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class ReservaController extends Controller
{
    public function lista(){
    	$reservas = DB::select('select * from reservas');

    	return view('reserva.listagem')->withReservas($reservas);
    }

    public function novo(){

    	return view('reserva.novo');
    }

    public function adiciona(){
    	if(Request::input('id')){
    		Reserva::find(Request::input('id'))->update(Request::all());
    		return redirect()->action('ReservaController@lista');

    	} else {
	    	Reserva::create(Request::all());
			return redirect()->action('ReservaController@lista');
		}
    }

    public function altera($id){
		$reserva = Reserva::find($id);

		return view('reserva.atualiza')->withR($reserva);
	}

	public function apaga(){
		$reserva = Reserva::find(Request::input('id'));
		try {

		$reserva->delete();

		} catch (QueryException $e) {

		DB::table('reserva')
            ->where('id', Request::input('id'))
            ->update(['active' => 2]);

		} finally {

			return redirect()->action('ReservaController@lista');
		}

	}

	
}
