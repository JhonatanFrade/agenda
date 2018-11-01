<?php
// Jonhatan desenvolveu está classe.
require_once('C:/xampp/htdocs/ULBRA/web2/agenda/DbAdmin/class.DbAdmin.php');

class CentroDeCustosDAO{

	private $dba;

	public function CentroDeCustosDAO(){

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

		$query = 'INSERT INTO centro_custos
					(nome, date_create, date_update)
				  VALUES ("'.$nome.'", "'.$date_c.'", "'.$date_u.'")';
		
		$dba->query($query);
		
	}


	public function excluir($objeto){

		$dba = $this->dba;

		$id_objt = $objeto->getId();

		$query = 'DELETE FROM centro_custos 
				  WHERE id = "'.$id_objt.'"';
		
		$dba->query($query);
		

	}

	public function atualizar($objeto){

		$dba = $this->dba;

		$id_objt = $objeto->getId();
		$nome = $objeto->getNome();
		$date_u = $objeto->getDateUpdate();

		$query = 'UPDATE centro_custos  
				  SET	nome = "'.$nome.'", date_update = "'.$date_u.'"
				  WHERE id = "'.$id_objt.'"';
		
		$dba->query($query);
	}

	public function listar(){
		$dba = $this->dba;

		$vet = array();

		$query = 'SELECT *
				 FROM centro_custos';

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i < $num; $i++) { 
			$id = $dba->result($res, $i, 'id');
			$name = $dba->result($res, $i, 'nome');
			$date_c = $dba->result($res, $i, 'date_create');
			$date_u = $dba->result($res, $i, 'date_update');

			$centro_custos = new CentroDeCustos();

			$centro_custos->setId($id);
			$centro_custos->setNome($name);
			$centro_custos->setDateCreate($date_c);
			$centro_custos->setDateUpdate($date_u);

			$vet[] = $centro_custos;

		}

		return $vet;
	}

	public function listarUmCentroDeCusto($obj){
		$dba = $this->dba;

		$id = $obj->getId();

		$query = 'SELECT *
				 FROM centro_custos
				 WHERE id = '.$id;

		$res = $dba->query($query);

		$num = $dba->rows($res);

		for ($i=0; $i < $num; $i++) { 
			$id = $dba->result($res, $i, 'id');
			$name = $dba->result($res, $i, 'nome');
			$date_c = $dba->result($res, $i, 'data_criacao');
			$date_u = $dba->result($res, $i, 'data_modificacao');

			$centro_custos = new CentroDeCustos();

			$centro_custos->setId($id);
			$centro_custos->setNome($name);
			$centro_custos->setDateCreate($date_c);
			$centro_custos->setDateUpdate($date_u);

			$vet[] = $centro_custos;

		}

		return $vet;
	}
}

?>