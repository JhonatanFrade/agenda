<?php

	require_once("../Movimentacao/class.Movimentacao.php");
	require_once("../Movimentacao/class.MovimentacaoDAO.php");

	require_once("../Contas/class.Contas.php");
	require_once("../Contas/class.ContasDAO.php");

	require_once('../ControllerArquivo/class.Arquivo.php');

	$dao = new MovimentacaoDAO();
	
	$action = $_REQUEST['action'];

	//var_dump($_POST);
	//echo $action;
	//exit;

	
	switch ($action) {
		case 'insert':
			$id_conta = $_POST['id_conta'];
			$id_centro_custos = $_POST['id_centro_custos'];
			$tipo_mov = $_POST['tipo_mov']; //  1 - Crédito , 2 - Débito / O campo ná tabela tá como int
			$data = $_POST['data'];
			$descricao = $_POST['descricao'];
			$valorOld = $_POST['valor'];

			/*
			Replace:
			Esta função retorna uma string ou um array com todas as ocorrências de search em subject substituídas com o valor dado para replace
			*/
			$valorNew = str_replace('.','', $valorOld);
			$valorNew = str_replace(',','.', $valorNew);

			$debito = new Movimentacao();

			$debito->setId_conta($id_conta);
			$debito->setId_centro_custos($id_centro_custos); 
			$debito->setTipo_mov($tipo_mov);
			$debito->setData($data);
			$debito->setDescricao($descricao);
			$debito->setValor($valorNew);

			$dao->cadastrar($debito);

			$arquivo = new Arquivo();

			$arquivo->abrirArquivo("a+");
			
			$arquivo->escreverNoArquivo(' -> '.date("d/m/Y H:i:s").' - debito - '.$valorOld);

			$arquivo->fecharArquivo();

			header("location:../index.php?pag=debito&msg=1");
			exit();
		break;

		case 'delete':
			$id = $_REQUEST['id'];

			$carteira = new Contas();

			$carteira->setId($id);

			$dao->excluir($carteira);

			header("location:../index.php?pag=debito&msg=2");
			exit();

		case 'update':
			$id = $_GET['id'];

			$id_conta = $_POST['id_conta'];
			$id_centro_custos = $_POST['id_centro_custos'];
			$tipo_mov = $_POST['tipo_mov']; //  1 - Crédito , 2 - Débito / O campo ná tabela tá como int
			$data = $_POST['data'];
			$descricao = $_POST['descricao'];
			$valor = $_POST['valor'];

			$debito = new Movimentacao();

			$debito->setId($id);
			$debito->setId_conta($id_conta);
			$debito->setId_centro_custos($id_centro_custos); 
			$debito->setTipo_mov($tipo_mov);
			$debito->setData($data);
			$debito->setDescricao($descricao);
			$debito->setValor($valor);

			$dao->atualizar($debito);

			header("location:../index.php?pag=debito&msg=3");
			exit();
		break;

		case 'select':
			$id_conta2 = $_POST['id_conta2'];
			
			header("location:../index.php?pag=debito&conta=".$id_conta2);
	    break;

		default:
			echo "Erro na condicao";
		break;
	}
?>
