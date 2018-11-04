<?php

	require_once("../Movimentacao/class.Movimentacao.php");
	require_once("../Movimentacao/class.MovimentacaoDAO.php");

	$dao = new MovimentacaoDAO();
	
	$action = $_REQUEST['action'];

	var_dump($_POST);
	echo $action;
	// exit;

	switch ($action) {
		case 'insert':
			$id_conta = $_POST['id_conta'];
			$tipo_mov = $_POST['tipo_mov'];
			$data = $_POST['data'];
			$descricao = $_POST['descricao'];
			$valor = $_POST['valor'];

			$credito = new Movimentacao();

			$credito->setId_conta($id_conta);
			$credito->setTipo_mov($tipo_mov);
			$credito->setData($data);
			$credito->setDescricao($descricao);
			$credito->setValor($valor);

			$dao->cadastrar($credito);

			header("location:../index.php?pag=credito&msg=1");
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
			$date_u = date("Y-m-d H:i:s");

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