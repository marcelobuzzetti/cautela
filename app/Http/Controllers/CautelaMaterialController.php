<?php

namespace cautela\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use cautela\Http\Controllers\Controller;
use cautela\CautelaMaterial;
use Validator;

class CautelaMaterialController extends Controller
{
    public function novo(){
        $id = Request::input('id');
    	$cautela = DB::select('select cautelas.id, militares.nome_guerra as nome 
    		from cautelas,militares
    		where cautelas.militar = militares.id
            and cautelas.id = ?',
        array($id));
        
    	$materiais = DB::select('select *from materiais');

    	$materiaiscautelados = DB::select('select cautelamateriais.id as id, cautelamateriais.cautela as cautela, materiais.nome, data_cautela, cautelamateriais.quantidade as quantidade, cautelamateriais.data_entrega as data_entrega
    		from cautelamateriais, materiais
    		where cautelamateriais.material = materiais.id
            and cautelamateriais.cautela = ?',
            array($id));
		
		 $materiaisentregues = DB::select('select materiais.nome, data_cautela, cautelamateriais.quantidade as quantidade, cautelamateriais.data_entrega as data_entrega
            from cautelamateriais, materiais
            where cautelamateriais.material = materiais.id
            and cautelamateriais.cautela = ?',
            array($id));
        return view('cautelamaterial.novo')->withCautela($cautela)->withMateriais($materiais)->withCautelados($materiaiscautelados)->withEntregues($materiaisentregues);
	}

    public function adiciona(){
        $id = Request::input('cautela');
        CautelaMaterial::create(Request::all());
        $cautela = DB::select('select cautelas.id, militares.nome_guerra as nome 
            from cautelas,militares
            where cautelas.militar = militares.id
            and cautelas.id = ?',
        array($id));
        
        $materiais = DB::select('select *from materiais');

        $materiaiscautelados = DB::select('select cautelamateriais.id as id, cautelamateriais.cautela as cautela, materiais.nome, data_cautela, cautelamateriais.quantidade as quantidade, cautelamateriais.data_entrega as data_entrega
            from cautelamateriais, materiais
            where cautelamateriais.material = materiais.id
            and cautelamateriais.cautela = ?',
            array($id));

        $materiaisentregues = DB::select('select materiais.nome, data_cautela, cautelamateriais.quantidade as quantidade, cautelamateriais.data_entrega as data_entrega
            from cautelamateriais, materiais
            where cautelamateriais.material = materiais.id
            and cautelamateriais.cautela = ?',
            array($id));
        return view('cautelamaterial.novo')->withCautela($cautela)->withMateriais($materiais)->withCautelados($materiaiscautelados)->withEntregues($materiaisentregues);
    }

    public function entrega(){
        $id = Request::input('id');
        $today = date("Y-m-d"); 
        CautelaMaterial::where('id', $id)->update(array('data_entrega' => $today));
        DB::select('update cautelamateriais
                    set data_entrega = ?
                    where id = ?',
                    array($today,$id));

        $id = Request::input('cautela');
        $cautela = DB::select('select cautelas.id, militares.nome_guerra as nome 
            from cautelas,militares
            where cautelas.militar = militares.id
            and cautelas.id = ?',
        array($id));
        
        $materiais = DB::select('select *from materiais');

       $materiaiscautelados = DB::select('select cautelamateriais.id as id, cautelamateriais.cautela as cautela, materiais.nome, data_cautela, cautelamateriais.quantidade as quantidade, cautelamateriais.data_entrega as data_entrega
            from cautelamateriais, materiais
            where cautelamateriais.material = materiais.id
            and cautelamateriais.cautela = ?',
            array($id));
        
         $materiaisentregues = DB::select('select materiais.nome, data_cautela, cautelamateriais.quantidade as quantidade, cautelamateriais.data_entrega as data_entrega
            from cautelamateriais, materiais
            where cautelamateriais.material = materiais.id
            and cautelamateriais.cautela = ?',
            array($id));
        return view('cautelamaterial.novo')->withCautela($cautela)->withMateriais($materiais)->withCautelados($materiaiscautelados)->withEntregues($materiaisentregues);
    }

    public function maximo($id){
         $quantidade = DB::select('select (materiais.quantidade - cautelamateriais.quantidade) as quantidade
                                FROM materiais, cautelamateriais
                                where materiais.id = cautelamateriais.material
                                and materiais.id = ?',
                                array($id));
         //return "<script>$('#quantidade').attr('max','$quantidade');</script>";
 
         foreach ($quantidade as $user)
         {
            $a = $user->quantidade;
        }
        return "<script>$('#quantidade').attr('max','$a');</script>";
        //return $a;


    }
}
