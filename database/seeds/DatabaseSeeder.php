<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(ReservaTableSeeder::class);
    	$this->call(PelotaoTableSeeder::class);
    	$this->call(PerfilTableSeeder::class);
    	$this->call(UsuarioTableSeeder::class);
        $this->call(MaterialTableSeeder::class);
        $this->call(MilitarTableSeeder::class);  
        $this->call(CautelaTableSeeder::class);
        $this->call(CautelaMateriaisTableSeeder::class);
        $this->call(PostoGradTableSeeder::class);
    }
}

class MaterialTableSeeder extends Seeder
{

	public function run (){
		DB::insert('insert into materiais(nome, valor, descricao, quantidade, reserva)
			values (?,?,?,?,?)',
			array('Mochila de Campanha',200.00, 'Mochila de Campanha', 100, 2));
	}
}

class MilitarTableSeeder extends Seeder
{

	public function run (){
		DB::insert('insert into militares(nome, patente, nome_guerra,pelotao)
			values (?,?,?,?)',
			array('Marcelo Aparecido Ferreira Silva',4,'Ferreira', 1));
	}
}

class PelotaoTableSeeder extends Seeder
{

	public function run (){
		DB::insert('insert into pelotoes(nome)
			values (?)',
			array('1º Pelotão'));
		DB::insert('insert into pelotoes(nome)
			values (?)',
			array('2º Pelotão'));
		DB::insert('insert into pelotoes(nome)
			values (?)',
			array('Pel Cmdo Ap'));
		DB::insert('insert into pelotoes(nome)
			values (?)',
			array('Posto Médico'));
		DB::insert('insert into pelotoes(nome)
			values (?)',
			array('Cia Cmdo da 11ª Bda Inf L'));
		DB::insert('insert into pelotoes(nome)
			values (?)',
			array('28º BIL'));
		DB::insert('insert into pelotoes(nome)
			values (?)',
			array('2º B Log L'));
		DB::insert('insert into pelotoes(nome)
			values (?)',
			array('11º Pel PE da 11ª Bda Ind L'));
		DB::insert('insert into pelotoes(nome)
			values (?)',
			array('EsPCEx'));
	}
}

class PerfilTableSeeder extends Seeder
{

	public function run (){
		DB::insert('insert into perfis(nome)
			values (?)',
			array('Administrador'));
		DB::insert('insert into perfis(nome)
			values (?)',
			array('Reserva 1º Pel'));
		DB::insert('insert into perfis(nome)
			values (?)',
			array('Reserva 2º Pel'));
		DB::insert('insert into perfis(nome)
			values (?)',
			array('Reserva de Material'));
	}
}

class ReservaTableSeeder extends Seeder
{

	public function run (){
		DB::insert('insert into reservas(nome)
			values (?)',
			array('Administrador'));
		DB::insert('insert into reservas(nome)
			values (?)',
			array('1º Pelotão'));
		DB::insert('insert into reservas(nome)
			values (?)',
			array('2º Pelotão'));
		DB::insert('insert into reservas(nome)
			values (?)',
			array('Subtenecia'));
	}
}

class CautelaTableSeeder extends Seeder
{

	public function run (){
		DB::insert('insert into cautelas(reserva, militar, data_cautela, usuario_cautela)
			values (?,?,?,?)',
			array(2,1,"2018-01-02",1));
	}
}

class CautelaMateriaisTableSeeder extends Seeder
{

	public function run (){
		DB::insert('insert into cautelamateriais(cautela, material, quantidade, data_cautela, observacao_cautela,usuario_cautela)
			values (?,?,?,?,?,?)',
			array(1, 1, 1, "2018-01-02","Desgastada",1));
	}

}

class UsuarioTableSeeder extends Seeder
{

	public function run (){
		DB::insert('insert into users(name, email, password, perfil)
			values (?,?,?,?)',
			array('Marcelo', 'marcelobuzzetti@gmail.com', '$2y$10$CMjFQJ0iuqSk5qXrShmNV.OD74ipTkfq7c6xXH7wVCthUUuxfnQuq', '1'));
		DB::insert('insert into users(name, email, password, perfil)
			values (?,?,?,?)',
			array('Marcelo', 'marcelobuzzetti@hotmail.com', '$2y$10$CMjFQJ0iuqSk5qXrShmNV.OD74ipTkfq7c6xXH7wVCthUUuxfnQuq', '2'));
	}
}

class PostoGradTableSeeder extends Seeder
{

	public function run (){

		DB::insert('insert into postograd(patente)
			values (?)',
			array('Sd'));

		DB::insert('insert into postograd(patente)
			values (?)',
			array('Cb'));

		DB::insert('insert into postograd(patente)
			values (?)',
			array('3º Sgt'));

		DB::insert('insert into postograd(patente)
			values (?)',
			array('2º Sgt'));

		DB::insert('insert into postograd(patente)
			values (?)',
			array('1º Sgt'));

		DB::insert('insert into postograd(patente)
			values (?)',
			array('STen'));

		DB::insert('insert into postograd(patente)
			values (?)',
			array('Asp'));

		DB::insert('insert into postograd(patente)
			values (?)',
			array('2º Ten'));

		DB::insert('insert into postograd(patente)
			values (?)',
			array('1º Ten'));

		DB::insert('insert into postograd(patente)
			values (?)',
			array('Cap'));

		DB::insert('insert into postograd(patente)
			values (?)',
			array('Maj'));

		DB::insert('insert into postograd(patente)
			values (?)',
			array('Ten Cel'));

		DB::insert('insert into postograd(patente)
			values (?)',
			array('Cel'));

		DB::insert('insert into postograd(patente)
			values (?)',
			array('Gen Bda'));

		DB::insert('insert into postograd(patente)
			values (?)',
			array('Gen Div'));

		DB::insert('insert into postograd(patente)
			values (?)',
			array('Gen Ex'));
	}

}



