<?php
// Jonhatan desenvolveu está classe.
require_once('C:/xampp/htdocs/ULBRA/web2/agenda/DbAdmin/class.DbAdmin.php');

class ContasDAO{

	private $dba;

	public function ContasDAO(){

		$dba = new DbAdmin('mysql');

		$dba->connect('localhost','root','','oc_agenda_web_2');

		$this->dba = $dba;

	}

	public function cadastrar($objeto){

		$dba = $this->dba;

		$id = $objeto->getId();
		$nome = $objeto->getNome();
		$date_c = $objeto->getDateCreate();
		$date_u = $objeto->getDateUpdate();

		$query = 'INSERT INTO contas
					(nome, date_create, date_update)
				  VALUES ("'.$nome.'", "'.$date_c.'", "'.$date_u.'")';
		
		$dba->query($query);
		
	}


	public function excluir($objeto){

		$dba = $this->dba;

		$id_objt = $objeto->getId();

		$query = 'DELETE FROM contas 
				  WHERE id = "'.$id_objt.'"';
		
		$dba->query($query);
		

	}

	public function atualizar($objeto){

		$dba = $this->dba;

		$id_objt = $objeto->getId();
		$nome = $objeto->getNome();
		$date_u = $objeto->getDateUpdate();

		$query = 'UPDATE contas  
				  SET	nome = "'.$nome.'", date_update = "'.$date_u.'"
				  WHERE id = "'.$id_objt.'"';
		
		$dba->query($query);
	}

	public function listar(){
		$dba = $this->dba;

		$vet = array();

		$query = 'SELECT *, DATE_FORMAT(date_create, "%d/%m/%Y %H:%i:%s") AS data_criacao, DATE_FORMAT(date_create, "%d/%m/%Y %H:%i:%s") AS data_alteracao
				 FROM contas';

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i < $num; $i++) { 
			$id = $dba->result($res, $i, 'id');
			$name = $dba->result($res, $i, 'nome');
			$date_c = $dba->result($res, $i, 'data_criacao');
			$date_u = $dba->result($res, $i, 'data_alteracao');

			$contas = new Contas();

			$contas->setId($id);
			$contas->setNome($name);
			$contas->setDateCreate($date_c);
			$contas->setDateUpdate($date_u);

			$vet[] = $contas;

		}

		return $vet;
	}

	public function listarUmCliente($obj){
		$dba = $this->dba;

		$id = $obj->getId();

		$query = 'SELECT *, DATE_FORMAT(date_create, "%d/%m/%Y %H:%i:%s") AS data_criacao, DATE_FORMAT(date_create, "%d/%m/%Y %H:%i:%s") AS data_alteracao
				 FROM contas
				 WHERE id = '.$id;

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i < $num; $i++) { 
			$id = $dba->result($res, $i, 'id');
			$name = $dba->result($res, $i, 'nome');
			$date_c = $dba->result($res, $i, 'data_criacao');
			$date_u = $dba->result($res, $i, 'data_alteracao');

			$contas = new Contas();

			$contas->setId($id);
			$contas->setNome($name);
			$contas->setDateCreate($date_c);
			$contas->setDateUpdate($date_u);

			$vet[] = $contas;

		}

		return $vet;
	}

}

?>