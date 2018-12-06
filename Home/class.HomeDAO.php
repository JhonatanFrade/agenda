<?php
	// Dia 06/12/2018  Leonardo desenvolveu está classe 
	require_once('C:/xampp/htdocs/ULBRA/web2/agenda/DbAdmin/class.DbAdmin.php');

	class HomeDAO
	{

		private $dba;

		public function HomeDAO()
		{
			$dba = new DbAdmin('mysql');

			$dba->connect('localhost','root','','oc_agenda_web_2');

			$this->dba = $dba;
		}


		function totalMovimentacao($home)
		{
			$dba = $this->dba;

			$id_conta = $home->getId_conta();
	        $bday = $home->getData();
	        $tipo_mov = $home->getTipo_mov();


			$sql = 'SELECT  sum(m.valor) as totalValor 
				    FROM movimentacao as m
				    WHERE m.tipo_mov = "' . $tipo_mov . '"' .
				    ' AND m.id_conta = "' . $id_conta . '"' .
				    ' AND DATE_FORMAT(m.data, "%Y-%m") = "' . $bday . '"';
				   

			$res = $dba->query($sql);

			$num = $dba->rows($res);

			for ($i=0; $i < $num; $i++) 
			{ 

				$total = $dba->result($res, $i, 'totalValor');
			}

			return $total;
		}
	}


?>