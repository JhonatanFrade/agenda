<?php
// Leonardo desenvolveu está classe.
require_once('class.DbAdmin.php');

class MovimentacaoDAO{

	private $dba;

	public function MovimentacaoDAO(){

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
		$data = $objeto->getData();
		$descricao = $objeto->getDescricao();
		$valor = $objeto->getValor();

		$query = 'INSERT INTO movimentacao
					(tipo_mov,data,descricao,valor)
				  VALUES ("'.$tipo_mov.'","'.$data.'","'.$descricao.'","'.$valor.'")';
				  // A id não será armazenada primária e secundaria não serão armazenadas.
		
		$dba->query($query);
		
	}


	public function excluir($objeto){

		$dba = $this->dba;

		$id_objt = $objeto->getId();

		$query = 'DELETE FROM movimentacao
				  WHERE id = "'.$id_objt.'"';
		
		$dba->query($query);
		

	}

	public function atualiza($objeto){

		$dba = $this->dba;

		$id_objt = $$objeto->getId();
		$id_centro_custos = $objeto->getId_centro_custos();
		$id_conta = $objeto->getId_conta();
		$tipo_mov = $objeto->getTipo_mov();
		$data = $objeto->getData();
		$descricao = $objeto->getDescricao();
		$valor = $objeto->getValor();

		$query = 'UPDATE FROM movimentacao   
				  SET	nome ="'.$nome.'",
				  tipo_mov ="'.$tipo_mov.'",
				  data ="'.$data.'",
				  descricao ="'.$descricao.'",
				  valor ="'.$valor.'"
				  WHERE id  = "'.$id_objt.'"';
		
		$dba->query($query);
	}

}

?>