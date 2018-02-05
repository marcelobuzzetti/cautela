<?php

namespace cautela\Http\Controllers;

use Request;
use cautela\User;
use Illuminate\Support\Facades\DB;
use cautela\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegistroController extends Controller
{
    public function novo(){

    	$perfil = DB::select('select * from perfis');
    	return view('registro.registro')->withPerfil($perfil);
		}

		public function adiciona(){

			User::create(Request::all());
			return view('inicio');
		}
}
