<?php
	require_once('C:/xampp/htdocs/ULBRA/web2/agenda/DbAdmin/class.DbAdmin.php');

	// var_dump($_POST);
	// exit;

	$tipo_rel = $_POST['tipo_rel'];

	$dba = new DbAdmin('mysql');

	$dba->connect('localhost','root','','oc_agenda_web_2');

	switch ($tipo_rel) {
		//Tipo relatorio
		case '1':

			$id_conta = $_POST['id_conta'];
			$tipo_mov = $_POST['tipo_mov'];
			$bday = $_POST['bday'];

			$sql = 'SELECT m.id, c.nome as nome_da_carteira, cc.nome as nome_do_centro_custo, 
						sum(m.valor) as totalValor 
					FROM movimentacao as m
					INNER JOIN centro_custos as cc ON (m.id_centro_custos = cc.id)
					INNER JOIN contas as c ON (c.id = m.id_conta)
					WHERE m.tipo_mov = "' . $tipo_mov . '"' .
					' AND m.id_conta = "' . $id_conta . '"' .
					' AND DATE_FORMAT(m.data, "%Y-%m") = "' . $bday . '"' .
					' GROUP BY m.id_centro_custos';

			// echo $sql;
			// exit;

			$res = $dba->query($sql);

			$num = $dba->rows($res);

			for ($i=0; $i < $num; $i++) { 
				echo $dba->result($res, $i, 'id') . " ";
				echo $dba->result($res, $i, 'nome_da_carteira') . " ";
				echo $dba->result($res, $i, 'nome_do_centro_custo') . " ";
				echo $dba->result($res, $i, 'totalValor') . " ";

				echo "<br><br>";

			}

			exit;

		break;

		//Tipo extrato
		case '2':
			$id = $_REQUEST['id'];

			echo 'tipo extrato';
			exit;


			// header("location:../index.php?pag=carteira&msg=2");
			// exit();
		break;

		default:
			echo "Erro na condicao";
		break;
	}
?>