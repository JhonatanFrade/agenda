<?php
// Leonardo desenvolveu está classe.
require_once('C:/xampp/htdocs/ULBRA/web2/agenda/DbAdmin/class.DbAdmin.php');

class ItemDAO{

	private $dba;

	public function ItemDAO(){

		$dba = new DbAdmin('mysql');

		$dba->connect('localhost','root','','oc_agenda_web_2');

		$this->dba = $dba;

	}

	public function cadastrar($objeto){

		$dba = $this->dba;

		$id = $objeto->getId();
		$descricao = $objeto->getDescricao();
		$date_c = $objeto->getDateCreate();
		$date_u = $objeto->getDateUpdate();

		$query = 'INSERT INTO item
					(descricao, date_create, date_update)
				  VALUES ("'.$descricao.'", "'.$date_c.'", "'.$date_u.'")';
		
		$dba->query($query);
		
	}


	public function excluir($objeto){

		$dba = $this->dba;

		$id_objt = $objeto->getId();

		$query = 'DELETE FROM item 
				  WHERE id = "'.$id_objt.'"';
		
		$dba->query($query);
		

	}

	public function atualizar($objeto){

		$dba = $this->dba;

		$id_objt = $objeto->getId();
		$descricao = $objeto->getDescricao();

		$query = 'UPDATE item   
				  SET	descricao = "'.$descricao.'"
				  WHERE id  = "'.$id_objt.'"';
		
		$dba->query($query);
	}

	public function listar(){
		$dba = $this->dba;

		$vet = array();

		$query = 'SELECT *, DATE_FORMAT(date_create, "%d/%m/%Y %H:%i:%s") AS data_criacao, DATE_FORMAT(date_create, "%d/%m/%Y %H:%i:%s") AS data_alteracao
				 FROM item';

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i < $num; $i++) { 
			$id = $dba->result($res, $i, 'id');
			$descricao = $dba->result($res, $i, 'descricao');
			$date_c = $dba->result($res, $i, 'data_criacao');
			$date_u = $dba->result($res, $i, 'data_alteracao');

			$item = new Item();

			$item->setId($id);
			$item->setDescricao($descricao);
			$item->setDateCreate($date_c);
			$item->setDateUpdate($date_u);

			$vet[] = $item;

		}

		return $vet;
	}

	public function listarUmCliente($obj){
		$dba = $this->dba;

		$id = $obj->getId();

		$query = 'SELECT *, DATE_FORMAT(date_create, "%d/%m/%Y %H:%i:%s") AS data_criacao, DATE_FORMAT(date_create, "%d/%m/%Y %H:%i:%s") AS data_alteracao
				 FROM item
				 WHERE id = '.$id;

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i < $num; $i++) { 
			$id = $dba->result($res, $i, 'id');
			$descricao = $dba->result($res, $i, 'descricao');
			$date_c = $dba->result($res, $i, 'data_criacao');
			$date_u = $dba->result($res, $i, 'data_alteracao');

			$item = new Item();

			$item->setId($id);
			$item->setDescricao($descricao);
			$item->setDateCreate($date_c);
			$item->setDateUpdate($date_u);

			$vet[] = $item;

		}

		return $vet;
	}

}

?>