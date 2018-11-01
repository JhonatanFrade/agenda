<?php
// Leonardo desenvolveu está classe.
require_once('class.DbAdmin.php');

class RecorrentesMovimentacaoDAO{

	private $dba;

	public function RecorrentesMovimentacaoDAO(){

		$dba = new DbAdmin('mysql');

		$dba->connect('localhost','root','','web2');

		$this->dba = $dba;

	}

	public function cadastra($objeto){

		$dba = $this->dba;

		$id = $objeto->getId();
		$Id_Recorrentes = $objeto->getId_Recorrentes();
		$id_movimentacao = $objeto->getId_movimentacao();

		$query = 'INSERT INTO recorrentes_movimentacao
					()
				  VALUES ()';
				  // Vazio pois as id não pode ser armazenadas.
		
		$dba->query($query);
		
	}


	public function excluir($objeto){

		$dba = $this->dba;

		$id_objt = $objeto->getId();

		$query = 'DELETE FROM recorrentes_movimentacao
				  WHERE id = "'.$id_objt.'"';
		
		$dba->query($query);
		

	}

	public function atualiza($objeto){

		$dba = $this->dba;

		$id = $objeto->getId();
		$Id_Recorrentes= $objeto->getId_Recorrentes();
		$id_movimentacao = $objeto->getId_movimentacao();

		$query = 'UPDATE FROM recorrentes_movimentacao 
				  SET	Id_Recorrentes ="'.$Id_Recorrentestipo_mov.'",
				  id_movimentacao ="'.$id_movimentacao.'",
				  WHERE id  = "'.$id_objt.'"';
		// Vazio pois as id não pode ser armazenadas.
		$dba->query($query);
	}

}

?>