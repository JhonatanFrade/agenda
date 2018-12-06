<?php
// Leonardo desenvolveu está classe.
require_once('C:/xampp/htdocs/ULBRA/web2/agenda/DbAdmin/class.DbAdmin.php');

class ParcelasDAO{

	private $dba;

	public function ParcelasDAO(){

		$dba = new DbAdmin('mysql');

		$dba->connect('localhost','root','','oc_agenda_web_2');

		$this->dba = $dba;

	}

	public function cadastrar($objeto){

		$dba = $this->dba;

		
		$id_centro_custos = $objeto->getId_centro_custos();
		$id_conta = $objeto->getId_conta();
		$id_item = $objeto->getId_item();
		$tipo_mov = $objeto->getTipo_mov();
		$parcela = $objeto->getParcela();
		$vencimento = $objeto->getVencimento();
		$valor = $objeto->getValor();
		$status_pagamento = $objeto->getStatus_Pagamento();

		$query = 'INSERT INTO parcelas
				(id_centro_custos,id_conta,id_item,tipo_mov,parcela,vencimento,valor,status_pagamento)
				  VALUES ("'.$id_centro_custos.'","'.$id_conta.'","'.$id_item.'","'.$tipo_mov.'","'.$parcela.'","'.$vencimento.'","'.$valor.'","'.$status_pagamento.'")';
		
		$dba->query($query);
		
	}


	public function excluir($objeto)
	{

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
		$status_pagamento = $objeto->getStatus_pagamento();

		$query = 'UPDATE parcelas  
				  SET	tipo_mov ="'.$tipo_mov.'",
				  parcela ="'.$parcela.'",
				  vencimento ="'.$vencimento.'",
				  valor ="'.$valor.'",
				  status_pagamento ="'.$status_pagamento.'"
				  WHERE id  = "'.$id.'"';
		
		$dba->query($query);
	}

    public function listar($tipoList)
	{
		$tipoDeListagem = $tipoList->getTipo_mov();

		$dba = $this->dba;

		$vet = array();

		$query = 'SELECT *, DATE_FORMAT(vencimento, "%d/%m/%Y") AS prazo
			      FROM parcelas
			      WHERE tipo_mov = "'.$tipoDeListagem.'"'; 

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i < $num; $i++) 
		{ 
			$id = $dba->result($res, $i, 'id');
			$id_centro_custos = $dba->result($res, $i, 'id_centro_custos');
			$id_conta = $dba->result($res, $i, 'id_conta');
			$id_item = $dba->result($res, $i, 'id_item');
			$tipo_mov = $dba->result($res, $i, 'tipo_mov');
			$vencimento = $dba->result($res, $i, 'prazo');
			$num_parcelas = $dba->result($res, $i, 'parcela');
			$valor = $dba->result($res, $i, 'valor');
			$status_pagamento = $dba->result($res, $i, 'status_pagamento');

			$parcelas = new Parcelas();

			$parcelas->setId($id);
			$parcelas->setId_centro_custos($id_centro_custos);
			$parcelas->setId_conta($id_conta);
			$parcelas->setId_item($id_item);
			$parcelas->setTipo_mov($tipo_mov);
			$parcelas->setVencimento($vencimento);
			$parcelas->setParcela($num_parcelas);
			$parcelas->setValor($valor);
			$parcelas->setStatus_pagamento($status_pagamento);


			$vet[] = $parcelas;

		}

		return $vet;
	}

	public function listarUmaParcela($obj)
	{
		$dba = $this->dba;

		$id = $obj->getId();
		$tipo_mov = $obj->getTipo_mov();

		$query = 'SELECT id, id_centro_custos, id_conta,id_item, tipo_mov, parcela, valor, status_pagamento, vencimento
				  FROM parcelas
				  WHERE id = "'.$id.'"
				  AND tipo_mov = '.$tipo_mov;

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i < $num; $i++)
		 { 
			$id = $dba->result($res, $i, 'id');
			$id_centro_custos = $dba->result($res, $i, 'id_centro_custos');
			$id_conta = $dba->result($res, $i, 'id_conta');
			$id_item = $dba->result($res, $i, 'id_item');
			$tipo_mov = $dba->result($res, $i, 'tipo_mov');
			$vencimento = $dba->result($res, $i, 'vencimento');
			$num_parcelas = $dba->result($res, $i, 'parcela');
			$valor = $dba->result($res, $i, 'valor');
			$status_pagamento = $dba->result($res, $i, 'status_pagamento');

			$parcela = new Parcelas();

			$parcela->setId($id);
			$parcela->setId_centro_custos($id_centro_custos);
			$parcela->setId_conta($id_conta);
			$parcela->setId_item($id_item);
			$parcela->setTipo_mov($tipo_mov);
			$parcela->setVencimento($vencimento);
			$parcela->setParcela($num_parcelas);
			$parcela->setValor($valor);
			$parcela->setStatus_pagamento($status_pagamento);

			$vet[] = $parcela;
		}

		return $vet;
    }
}

?>
