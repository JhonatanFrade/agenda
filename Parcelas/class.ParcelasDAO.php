<?php
// Leonardo desenvolveu está classe.
require_once('class.DbAdmin.php');

class ParcelasDAO{

	private $dba;

	public function ParcelasDAO(){

		$dba = new DbAdmin('mysql');

		$dba->connect('localhost','root','','web2');

		$this->dba = $dba;

	}

	public function cadastra($objeto){

		$dba = $this->dba;

		$id = $objeto->getId();
		$id_centro_custos = $objeto->getId_centro_custos();
		$id_conta = $objeto->getId_conta();
		$id_item = $objeto->getId_item();
		$tipo_mov = $objeto->getTipo_mov();
		$parcela = $objeto->getParcela();
		$vencimento = $objeto->getVencimento();
		$valor = $objeto->getValor();
		$status_pagamento = $objeto->getStatus_Pagamento();

		$query = 'INSERT INTO parcelas
					(tipo_mov,parcela,vencimento,valor,status_pagamento)
				  VALUES ("'.$tipo_mov.'","'.$parcela.'","'.$vencimento.'","'.$valor.'","'.$status_pagamento.'")';
				  // A id não será armazenada primária e secundaria não serão armazenadas.
		
		$dba->query($query);
		
	}


	public function excluir($objeto){

		$dba = $this->dba;

		$id_objt = $objeto->getId();

		$query = 'DELETE FROM parcelas
				  WHERE id = "'.$id_objt.'"';
		
		$dba->query($query);
		

	}

	public function atualiza($objeto){

		$dba = $this->dba;

		$id = $objeto->getId();
		$id_centro_custos = $objeto->getId_centro_custos();
		$id_conta = $objeto->getId_conta();
		$id_item = $objeto->getId_item();
		$tipo_mov = $objeto->getTipo_mov();
		$parcela = $objeto->getParcela();
		$vencimento = $objeto->getVencimento();
		$valor = $objeto->getValor();
		$status_Pagamento = $objeto->getStatus_pagamento();

		$query = 'UPDATE FROM parcelas  
				  SET	tipo_mov ="'.$tipo_mov.'",
				  parcela ="'.$parcela.'",
				  vencimento ="'.$vencimento.'",
				  valor ="'.$valor.'",
				  status_pagamento ="'.$status_pagamento.'"
				  WHERE id  = "'.$id_objt.'"';
		
		$dba->query($query);
	}

}

?>