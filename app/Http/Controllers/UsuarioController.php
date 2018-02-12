<?php

namespace cautela\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use cautela\Http\Controllers\Controller;
use cautela\User;
use Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
	
    public function lista(){
    	$usuarios = DB::select('select u.id, u.name, u.email, r.nome as perfil , u.active from users as u, reservas as r
								where r.id = u.perfil
								and u.id != ?',
								array(Auth::user()->id));
		
		return view('usuario.listagem')->withUsuarios($usuarios);
	}

	public function apaga(){
		
    	$usuarios = DB::select('select u.id, u.name, u.email, r.nome as perfil , u.active from users as u, reservas as r
								where r.id = u.perfil
								and u.id != ?',
								array(Auth::user()->id));
		
		return view('usuario.listagem')->withUsuarios($usuarios);
	}


}
