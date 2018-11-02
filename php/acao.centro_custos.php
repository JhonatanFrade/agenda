<?php
	date_default_timezone_set('America/Araguaina');
	
	require_once("../CentrodeCustos/class.CentroDeCustos.php");
	require_once("../CentrodeCustos/class.CentroDeCustosDAO.php");

	$dao = new CentroDeCustosDAO();
	
	$action = $_REQUEST['action'];

	switch ($action) {
		case 'insert':
			$name = $_POST['name'];
			$date_c = date("Y-m-d H:i:s");
			$date_u = date("Y-m-d H:i:s");

			$centro_custos = new CentroDeCustos();

			$centro_custos->setNome($name);
			$centro_custos->setDateCreate($date_c);
			$centro_custos->setDateUpdate($date_u);

			$dao->cadastrar($centro_custos);

			header("location:../index.php?pag=centro_custos&msg=1");
			exit();
		break;

		case 'delete':
			$id = $_REQUEST['id'];

			$centro_custos = new CentroDeCustos();

			$centro_custos->setId($id);

			$dao->excluir($centro_custos);

			header("location:../index.php?pag=centro_custos&msg=2");
			exit();

		case 'update':
			$id = $_GET['id'];
			$name = $_POST['name'];
			$date_u = date("Y-m-d H:i:s");

			$centro_custos = new CentroDeCustos();

			$centro_custos->setNome($name);
			$centro_custos->setId($id);
			$centro_custos->setDateUpdate($date_u);

			$dao->atualizar($centro_custos);

			header("location:../index.php?pag=centro_custos&msg=3");
			exit();
		break;
		
		default:
			echo "Erro na condicao";
		break;
	}
?>