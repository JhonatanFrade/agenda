<?php
// Jonhatan desenvolveu está classe.
require_once('class.DbAdmin.php');

class RecorrentesDAO{

	private $dba;

	public function RecorrentesDAO(){

		$dba = new DbAdmin('mysql');

		$dba->connect('localhost','root','','web2');

		$this->dba = $dba;

	}

	public function cadastra($objeto){

		$dba = $this->dba;

		$id = $objeto->getId();
		$id_centro_custos = $objeto->getId_centro_custos();
		$id_conta = $objeto->getId_conta();
		$tipo_mov = $objeto->getTipo_mov();
		$dia = $objeto->getDia();
		$descricao = $objeto->getDescricao();
		$valor = $objeto->getValor();

		$query = 'INSERT INTO recorrentes
					(tipo_mov,dia,descricao,valor)
				  VALUES ("'.$tipo_mov.'","'.$dia.'","'.$descricao.'","'.$valor.'")';
				  // A id não será armazenada primária e secundaria não serão armazenadas.
		
		$dba->query($query);
		
	}


	public function excluir($objeto){

		$dba = $this->dba;

		$id_objt = $objeto->getId();

		$query = 'DELETE FROM recorrentes
				  WHERE id = "'.$id_objt.'"';
		
		$dba->query($query);
		

	}

	public function atualiza($objeto){

		$dba = $this->dba;

		$id = $objeto->getId();
		$id_centro_custos = $objeto->getId_centro_custos();
		$id_conta = $objeto->getId_conta();
		$tipo_mov = $objeto->getTipo_mov();
		$dia = $objeto->getDia();
		$descricao = $objeto->getDescricao();
		$valor = $objeto->getValor();

		$query = 'UPDATE FROM recorrentes  
				  SET	tipo_mov ="'.$tipo_mov.'",
				  dia ="'.$dia.'",
				  descricao ="'.$vencimento.'",
				  valor ="'.$valor.'"
				  WHERE id  = "'.$id_objt.'"';
		
		$dba->query($query);
	}

}

?>