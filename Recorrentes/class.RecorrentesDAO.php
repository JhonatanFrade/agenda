<?php

/*
 - Jonhatan Desenvolveu está classe

 - Dia 30/11/2018 Leonardo modificou a classe
     Métodos Alterados:
       - cadastrar
       - listar
       
 - Dia 04/12/2018 Leonardo modificou a classe
     Métodos Alterados:
      - excluir
      - atualiza
     Método Adicionado:
      - listarUmaRecorrente
*/

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

				  VALUES ("'.$id_centro_custos.'", "'.$id_conta.'", "'.$tipo_mov.'","'.$dia.'","'.$descricao.'","'.$valor.'")';
		
		$dba->query($query);
		
	}

	public function excluir($objeto)
	{
		

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

		$query = 'UPDATE  recorrentes  
				  SET id_centro_custos = "'.$id_centro_custos.'",
				  id_conta = "'.$id_conta.'",
				  tipo_mov ="'.$tipo_mov.'",
				  dia ="'.$dia.'",
				  descricao ="'.$descricao.'",
				  valor ="'.$valor.'"
				  WHERE id  = "'.$id.'"';
		
		$dba->query($query);
	}

	/* 
		Para identificar e listar as tabelas que condizem com a forma de movimentação, 
		é filtrado apartir do campo tipo_mov:
		1 - para Crédito
		2 - para Débito
	*/

	public function listar($tipoList)
	{
		$tipoDeListagem = $tipoList->getTipo_mov();
		
		$dba = $this->dba;

		$vet = array();

		$query = 'SELECT id, id_centro_custos, id_conta, tipo_mov, dia, descricao, valor
				FROM recorrentes
				WHERE tipo_mov = "'.$tipoDeListagem.'"'; 

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i < $num; $i++) 
		{ 
			$id = $dba->result($res, $i, 'id');
			$id_centro_custos = $dba->result($res, $i, 'id_centro_custos');
			$id_conta = $dba->result($res, $i, 'id_conta');
			$tipo_mov = $dba->result($res, $i, 'tipo_mov');
			$dia = $dba->result($res, $i, 'dia');
			$descricao = $dba->result($res, $i, 'descricao');
			$valor = $dba->result($res, $i, 'valor');

			$Recorrentes = new Recorrentes();

			$Recorrentes->setId($id);
			$Recorrentes->setId_centro_custos($id_centro_custos);
			$Recorrentes->setId_conta($id_conta);
			$Recorrentes->setTipo_mov($tipo_mov);
			$Recorrentes->setDia($dia);
			$Recorrentes->setDescricao($descricao);
			$Recorrentes->setValor($valor);

			$vet[] = $Recorrentes;

		}

		return $vet;
	}

	public function listarUmaRecorrente($obj)
	{
		$dba = $this->dba;

		$id = $obj->getId();
		$tipo_mov = $obj->getTipo_mov();

		$query = 'SELECT id, id_centro_custos, id_conta, tipo_mov, dia, descricao, valor
				  FROM recorrentes
				  WHERE id = "'.$id.'"
				  AND tipo_mov = '.$tipo_mov;

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i < $num; $i++)
		 { 
			$id = $dba->result($res, $i, 'id');
			$id_centro_custos = $dba->result($res, $i, 'id_centro_custos');
			$id_conta = $dba->result($res, $i, 'id_conta');
			$tipo_mov = $dba->result($res, $i, 'tipo_mov');
			$dia = $dba->result($res, $i, 'dia');
			$descricao = $dba->result($res, $i, 'descricao');
			$valor = $dba->result($res, $i, 'valor');

			$Recorrentes = new Recorrentes();

			$Recorrentes->setId($id);
			$Recorrentes->setId_centro_custos($id_centro_custos);
			$Recorrentes->setId_conta($id_conta);
			$Recorrentes->setTipo_mov($tipo_mov);
			$Recorrentes->setDia($dia);
			$Recorrentes->setDescricao($descricao);
			$Recorrentes->setValor($valor);

			$vet[] = $Recorrentes;
		}

		return $vet;
    }

}

?>
