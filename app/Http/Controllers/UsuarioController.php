<?php

namespace cautela\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use cautela\Http\Controllers\Controller;
use cautela\User;
use cautela\Reserva;
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
		
    	$usuario = User::find(Request::input('id'));
		try {

		$usuario->delete();
		
		return redirect()->action('UsuarioController@lista')->with('status', 'Usuário Apagado!');

		} catch (QueryException $e) {

		DB::table('users')
            ->where('id', Request::input('id'))
            ->update(['active' => 2]);

        return redirect()->action('UsuarioController@lista')->with('status', 'Usuário Desativado!');
		}
	}

		public function ativar(){
		
    	$usuario = User::find(Request::input('id'));

		DB::table('users')
            ->where('id', Request::input('id'))
            ->update(['active' => 1]);

        return redirect()->action('UsuarioController@lista')->with('status', 'Usuário Ativado!');
		

	}

		public function altera($id){
			$usuario = User::find($id);
			$perfil = DB::select('select * from reservas');
    		return view('usuario.atualiza')->withPerfil($perfil)->withU($usuario);
	}

		public function atualiza(){
			$usuario = Request::all();
			User::find(Request::input('id'))->update($usuario);
			return redirect()->action('UsuarioController@lista')->withInput();
	}

	public function reset(){
			$usuario['password'] = bcrypt('123456');
			User::find(Request::input('id'))->update($usuario);
			return redirect()->action('UsuarioController@lista')->with('status',"Senha Alterada para '123456'");
	}

}
