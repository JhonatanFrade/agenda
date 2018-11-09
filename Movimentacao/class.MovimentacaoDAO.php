<?php
// Leonardo desenvolveu está classe.
require_once('C:/xampp/htdocs/ULBRA/web2/agenda/DbAdmin/class.DbAdmin.php');

class MovimentacaoDAO{

	private $dba;

	public function MovimentacaoDAO(){

		$dba = new DbAdmin('mysql');

		$dba->connect('localhost','root','','oc_agenda_web_2');

		$this->dba = $dba;

	}

	public function cadastrar($objeto){

		$dba = $this->dba;

		$tipo_mov = $objeto->getTipo_mov();
		$id_centro_custos = $objeto->getId_centro_custos();
		$id = $objeto->getId();
		$id_conta = $objeto->getId_conta();
		$data = $objeto->getData();
		$descricao = $objeto->getDescricao();
		$valor = $objeto->getValor();

		$query = 'INSERT INTO movimentacao
					(id_centro_custos, id_conta, tipo_mov, data, descricao, valor)
				  VALUES ("'.$id_centro_custos.'", "'.$id_conta.'", "'.$tipo_mov.'","'.$data.'","'.$descricao.'","'.$valor.'")';
		
		$dba->query($query);
		
	}

	public function excluir($objeto){

		$dba = $this->dba;

		$id_objt = $objeto->getId();

		$query = 'DELETE FROM movimentacao
				  WHERE id = "'.$id_objt.'"';
		
		$dba->query($query);
		

	}

	public function atualizar($objeto){

		$dba = $this->dba;

		$id_objt = $objeto->getId();
		$id_centro_custos = $objeto->getId_centro_custos();
		$id_conta = $objeto->getId_conta();
		$tipo_mov = $objeto->getTipo_mov();
		$data = $objeto->getData();
		$descricao = $objeto->getDescricao();
		$valor = $objeto->getValor();

		$query = 'UPDATE movimentacao   
				  SET id_centro_custos ="'.$id_centro_custos.'",
				  id_conta ="'.$id_conta.'",
				  tipo_mov ="'.$tipo_mov.'",
				  data ="'.$data.'",
				  descricao ="'.$descricao.'",
				  valor ="'.$valor.'"
				  WHERE id  = "'.$id_objt.'"';
		
		$dba->query($query);
	}

	/* 
		Para identificar e listar as tabelas que condizem com a forma de movimentação, 
		é filtrado apartir do campo tipo_mov:
		1 - para Crédito
		2 - para Débito
	*/
	public function listar($tipoDeListagem)
	{
		$dba = $this->dba;

		$vet = array();

		$query = 'SELECT *, DATE_FORMAT(data, "%d/%m") AS data_d
				FROM movimentacao
				WHERE tipo_mov = "'.$tipoDeListagem.'"'; 

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i < $num; $i++) { 
			$id = $dba->result($res, $i, 'id');
			$id_centro_custos = $dba->result($res, $i, 'id_centro_custos');
			$id_conta = $dba->result($res, $i, 'id_conta');
			$tipo_mov = $dba->result($res, $i, 'tipo_mov');
			$data = $dba->result($res, $i, 'data_d');
			$descricao = $dba->result($res, $i, 'descricao');
			$valor = $dba->result($res, $i, 'valor');

			$Movimentacao = new Movimentacao();

			$Movimentacao->setId($id);
			$Movimentacao->setId_centro_custos($id_centro_custos);
			$Movimentacao->setId_conta($id_conta);
			$Movimentacao->setTipo_mov($tipo_mov);
			$Movimentacao->setData($data);
			$Movimentacao->setDescricao($descricao);
			$Movimentacao->setValor($valor);

			$vet[] = $Movimentacao;

		}

		return $vet;
	}

	public function listarUmaMovimentacao($obj)
	{
		$dba = $this->dba;

		$vet = array();

		$query = 'SELECT *
				FROM movimentacao
				WHERE tipo_mov = "'.$obj->getTipo_mov().'" 
				and id = "'.$obj->getId().'"'; 

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i < $num; $i++) { 
			$id = $dba->result($res, $i, 'id');
			$id_centro_custos = $dba->result($res, $i, 'id_centro_custos');
			$id_conta = $dba->result($res, $i, 'id_conta');
			$tipo_mov = $dba->result($res, $i, 'tipo_mov');
			$data = $dba->result($res, $i, 'data');
			$descricao = $dba->result($res, $i, 'descricao');
			$valor = $dba->result($res, $i, 'valor');

			$Movimentacao = new Movimentacao();

			$Movimentacao->setId($id);
			$Movimentacao->setId_centro_custos($id_centro_custos);
			$Movimentacao->setId_conta($id_conta);
			$Movimentacao->setTipo_mov($tipo_mov);
			$Movimentacao->setData($data);
			$Movimentacao->setDescricao($descricao);
			$Movimentacao->setValor($valor);

			$vet[] = $Movimentacao;

		}

		return $vet;
	}
}

?>
