<?php
// Jonhatan desenvolveu está classe.
require_once('C:/xampp/htdocs/ULBRA/web2/agenda/DbAdmin/class.DbAdmin.php');

class RecorrentesDAO{

	private $dba;

	public function RecorrentesDAO(){

		$dba = new DbAdmin('mysql');

		$dba->connect('localhost','root','','oc_agenda_web_2');

		$this->dba = $dba;

	}

	public function cadastrar($objeto){

		$dba = $this->dba;

		$id_centro_custos = $objeto->getId_centro_custos();
		$id_conta = $objeto->getId_conta();
		$tipo_mov = $objeto->getTipo_mov();
		$dia = $objeto->getDia();
		$descricao = $objeto->getDescricao();
		$valor = $objeto->getValor();

		$query = 'INSERT INTO recorrentes
					(id_centro_custos, id_conta, tipo_mov, dia, descricao, valor)
				  VALUES ("'.$id_centro_custos.'","'.$id_conta.'","'.$tipo_mov.'","'.$dia.'","'.$descricao.'","'.$valor.'")';
		
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