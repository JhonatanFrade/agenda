<?php
	date_default_timezone_set('America/Araguaina');
	
	require_once("../Item/class.Item.php");
	require_once("../Item/class.ItemDAO.php");

	$dao = new ItemDAO();
	
	$action = $_REQUEST['action'];

	switch ($action) {
		case 'insert':
			$descricao = $_POST['descricao'];
			$date_c = date("Y-m-d H:i:s");
			$date_u = date("Y-m-d H:i:s");

			$item = new Item();

			$item->setDescricao($descricao);
			$item->setDateCreate($date_c);
			$item->setDateUpdate($date_u);

			$dao->cadastrar($item);

			header("location:../index.php?pag=item&msg=1");
			exit();
		break;

		case 'delete':
			$id = $_REQUEST['id'];

			$item = new Item();

			$item->setId($id);

			$dao->excluir($item);

			header("location:../index.php?pag=item&msg=2");
			exit();

		case 'update':
			$id = $_GET['id'];
			$descricao = $_POST['descricao'];
			$date_u = date("Y-m-d H:i:s");

			$item = new Item();

			$item->setDescricao($descricao);
			$item->setId($id);
			$item->setDateUpdate($date_u);

			$dao->atualizar($item);

			header("location:../index.php?pag=item&msg=3");
			exit();
		break;
		
		default:
			echo "Erro na condicao";
		break;
	}
?>