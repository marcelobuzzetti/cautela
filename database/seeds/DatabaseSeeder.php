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
        $this->call(MaterialTableSeeder::class);
        $this->call(MilitarTableSeeder::class);
        $this->call(PelotaoTableSeeder::class);
        $this->call(PerfilTableSeeder::class);
        $this->call(ReservaTableSeeder::class);
        $this->call(CautelaTableSeeder::class);
        $this->call(CautelaMateriaisTableSeeder::class);
        $this->call(UsuarioTableSeeder::class);
        
    }
}

class MaterialTableSeeder extends Seeder
{

	public function run (){
		DB::insert('insert into materiais(nome, valor, descricao, quantidade, reserva)
			values (?,?,?,?,?)',
			array('Mochila de Campanha',200.00, 'Mochila de Campanha', 100, 1));
	}
}

class MilitarTableSeeder extends Seeder
{

	public function run (){
		DB::insert('insert into militares(nome, nome_guerra,pelotao)
			values (?,?,?)',
			array('Marcelo Aparecido Ferreira Silva','Ferreira', 1));
	}
}

class PelotaoTableSeeder extends Seeder
{

	public function run (){
		DB::insert('insert into pelotoes(nome)
			values (?)',
			array('1º Pelotão'));
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
		DB::insert('insert into cautelas(militar, data_cautela,usuario_cautela)
			values (?,?,?)',
			array(1,"2018-01-02",1));
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
	}

}



