<?php

namespace cautela\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use cautela\Http\Controllers\Controller;
use cautela\CautelaMaterial;
use cautela\Reserva;
use Validator;
use Illuminate\Support\Facades\Auth;

class CautelaMaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function novo(){
        $id = Request::input('id');
        $reserva['nome'] = Request::input('reserva');
        $reserva = DB::select('select * from reservas where nome like ?',
            array($reserva['nome']));
        foreach($reserva as $r){
            $reserva = $r->id;
        }

    	$cautela = DB::select('select cautelas.id, militares.nome_guerra as nome , reserva
    		from cautelas,militares
    		where cautelas.militar = militares.id
            and cautelas.id = ?',
            array($id));

        foreach($cautela as $c){
                $teste = $c->reserva;
            }

        if(Auth::user()->perfil == 1){
            $materiais = DB::select('select materiais.id, materiais.nome, materiais.valor, 
            materiais.descricao, materiais.quantidade, reservas.nome as reserva
            from materiais,reservas 
            where materiais.reserva = reservas.id
            and reservas.id = ?',
            array($teste));

        } else {
            if($teste != Auth::user()->perfil){
                return redirect()->action('CautelaController@lista');
            }


        	$materiais = DB::select('select materiais.id, materiais.nome, materiais.valor, 
                materiais.descricao, materiais.quantidade, reservas.nome as reserva
                from materiais,reservas 
                where materiais.reserva = reservas.id
                and reservas.id != 1
                and materiais.reserva = ?',
                array(Auth::user()->perfil));
            }

        	$materiaiscautelados = DB::select('select cautelamateriais.id as id, cautelamateriais.cautela as cautela, materiais.nome, data_cautela, cautelamateriais.quantidade as quantidade, cautelamateriais.data_entrega as data_entrega, observacao_cautela, observacao_entrega
        		from cautelamateriais, materiais
        		where cautelamateriais.material = materiais.id
                and cautelamateriais.cautela = ?',
                array($id));
    		
    		 $materiaisentregues = DB::select('select materiais.nome, data_cautela, cautelamateriais.quantidade as quantidade, cautelamateriais.data_entrega as data_entrega, observacao_cautela, observacao_entrega
                from cautelamateriais, materiais
                where cautelamateriais.material = materiais.id
                and cautelamateriais.cautela = ?',
                array($id));
            return view('cautelamaterial.novo')->withCautela($cautela)->withMateriais($materiais)->withCautelados($materiaiscautelados)->withEntregues($materiaisentregues);
	}

    public function adiciona(){
        $id = Request::input('cautela');
        $cautela = Request::all();
        $cautela['usuario_cautela'] = Auth::user()->id;
        CautelaMaterial::create($cautela);
        $cautela = DB::select('select cautelas.id, militares.nome_guerra as nome , reserva
            from cautelas,militares
            where cautelas.militar = militares.id
            and cautelas.id = ?',
        array($id));
        
       $materiais = DB::select('select materiais.id, materiais.nome, materiais.valor, 
            materiais.descricao, materiais.quantidade, reservas.nome as reserva
            from materiais,reservas 
            where materiais.reserva = reservas.id
            and reservas.id != 1
            and materiais.reserva = ?',
            array(Auth::user()->perfil));
       
     $materiaiscautelados = DB::select('select cautelamateriais.id as id, cautelamateriais.cautela as cautela, materiais.nome, data_cautela, cautelamateriais.quantidade as quantidade, cautelamateriais.data_entrega as data_entrega, observacao_cautela, observacao_entrega
            from cautelamateriais, materiais
            where cautelamateriais.material = materiais.id
            and cautelamateriais.cautela = ?',
            array($id));
        
         $materiaisentregues = DB::select('select materiais.nome, data_cautela, cautelamateriais.quantidade as quantidade, cautelamateriais.data_entrega as data_entrega, observacao_cautela, observacao_entrega
            from cautelamateriais, materiais
            where cautelamateriais.material = materiais.id
            and cautelamateriais.cautela = ?',
            array($id));
         return redirect()->action(
            'CautelaMaterialController@novo', ['id' => $id]
        );
    }

    public function entrega(){
        $id = Request::input('id');
        $obs = Request::input('observacao_entrega');
        $today = date("Y-m-d"); 
        CautelaMaterial::where('id', $id)->update(array('data_entrega' => $today, 'observacao_entrega' => $obs, 'usuario_entrega' => Auth::user()->id));
        /*DB::select('update cautelamateriais
                    set data_entrega = ?
                    where id = ?',
                    array($today,$id));*/

        $id = Request::input('cautela');
        $cautela = DB::select('select cautelas.id, militares.nome_guerra as nome 
            from cautelas,militares
            where cautelas.militar = militares.id
            and cautelas.id = ?',
        array($id));
        
        $materiais = DB::select('select materiais.id, materiais.nome, materiais.valor, 
            materiais.descricao, materiais.quantidade, reservas.nome as reserva
            from materiais,reservas 
            where materiais.reserva = reservas.id
            and reservas.id != 1
            and materiais.reserva = ?',
            array(Auth::user()->perfil));

       $materiaiscautelados = DB::select('select cautelamateriais.id as id, cautelamateriais.cautela as cautela, materiais.nome, data_cautela, cautelamateriais.quantidade as quantidade, cautelamateriais.data_entrega as data_entrega, observacao_cautela, observacao_entrega
            from cautelamateriais, materiais
            where cautelamateriais.material = materiais.id
            and cautelamateriais.cautela = ?',
            array($id));
        
         $materiaisentregues = DB::select('select materiais.nome, data_cautela, cautelamateriais.quantidade as quantidade, cautelamateriais.data_entrega as data_entrega, observacao_cautela, observacao_entrega, observacao_entrega
            from cautelamateriais, materiais
            where cautelamateriais.material = materiais.id
            and cautelamateriais.cautela = ?',
            array($id));
        return view('cautelamaterial.novo')->withCautela($cautela)->withMateriais($materiais)->withCautelados($materiaiscautelados)->withEntregues($materiaisentregues)->with('sucesso','Material entregue com sucesso');
    }

    public function maximo($id){
        $cautela = DB::table('cautelamateriais')
        ->select(DB::raw('sum(cautelamateriais.quantidade) AS quantidade'))
        ->where('cautelamateriais.material', '=' ,$id)
        ->whereNull('cautelamateriais.data_entrega')
        ->groupBy('cautelamateriais.material')
        ->first();

        if(!$cautela){
            $cautela = 0;
        } else {
            $cautela = $cautela->quantidade;
        }

        $quantidade = DB::table('materiais')
        ->selectRaw('materiais.quantidade - ? AS quantidade', [$cautela])
        ->where('materiais.id', '=' ,$id)
        ->get();

         foreach ($quantidade as $q) {
             $quantidade = $q->quantidade;
         }
 
        return "<script>$('#quantidade').attr('max','$quantidade');</script>";

    }
}
