<?php
	date_default_timezone_set('America/Araguaina');

	require_once("../Contas/class.Contas.php");
	require_once("../Contas/class.ContasDAO.php");

	$dao = new ContasDAO();
	
	$action = $_REQUEST['action'];

	switch ($action) {
		case 'insert':
			$name = $_POST['name'];
			$date_c = date("d-m-Y H:i:s");
			$date_u = date("d-m-Y H:i:s");

			$carteira = new Contas();

			$carteira->setNome($name);
			$carteira->setDateCreate($date_c);
			$carteira->setDateUpdate($date_u);

			$dao->cadastrar($carteira);

			header("location:../index.php?pag=carteira&msg=1");
			exit();
		break;

		case 'delete':
			$id = $_REQUEST['id'];

			$carteira = new Contas();

			$carteira->setId($id);

			$dao->excluir($carteira);

			header("location:../index.php?pag=carteira&msg=2");
			exit();

		case 'update':
			$id = $_GET['id'];
			$name = $_POST['name'];
			$date_u = date("d-m-Y H:i:s");

			$carteira = new Contas();

			$carteira->setNome($name);
			$carteira->setId($id);
			$carteira->setDateUpdate($date_u);

			$dao->atualizar($carteira);

			header("location:../index.php?pag=carteira&msg=3");
			exit();
		break;
		
		default:
			echo "Erro na condicao";
		break;
	}
?>