<?php

namespace cautela\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use cautela\Http\Controllers\Controller;
use cautela\Reserva;
use Validator;
use Illuminate\Support\Facades\Auth;

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
    	Reserva::create(Request::all());
		return redirect()->action('ReservaController@lista');
    }
}
