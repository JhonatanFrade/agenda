<?php

	require_once("../Movimentacao/class.Movimentacao.php");
	require_once("../Movimentacao/class.MovimentacaoDAO.php");

	require_once("../Contas/class.Contas.php");
	require_once("../Contas/class.ContasDAO.php");

	require_once('../ControllerArquivo/class.Arquivo.php');

	$dao = new MovimentacaoDAO();
	
	$action = $_REQUEST['action'];


	switch ($action) {
		case 'insert':
			$id_conta = $_POST['id_conta'];
			$tipo_mov = $_POST['tipo_mov'];
			$id_centro_custos = $_POST['id_centro_custos'];
			$data = $_POST['data'];
			$descricao = $_POST['descricao'];
			$valorOld = $_POST['valor'];

			$valorNew = str_replace('.','', $valorOld);
			$valorNew = str_replace(',','.', $valorNew);

			$credito = new Movimentacao();

			$credito->setId_conta($id_conta);
			$credito->setTipo_mov($tipo_mov);
			$credito->setId_centro_custos($id_centro_custos);
			$credito->setData($data);
			$credito->setDescricao($descricao);
			$credito->setValor($valorNew);

			$dao->cadastrar($credito);

			$arquivo = new Arquivo();

			$arquivo->abrirArquivo("a+");
			
			$arquivo->escreverNoArquivo(' -> '.date("d/m/Y H:i:s").' - crédito - '.$valorOld);

			$arquivo->fecharArquivo();

			header("location:../index.php?pag=credito&msg=1");
			exit();
		break;

		case 'delete':
			$id = $_REQUEST['id'];

			$credito = new Movimentacao();

			$credito->setId($id);

			$dao->excluir($credito);

			header("location:../index.php?pag=credito&msg=2");
			exit();

		case 'update':
			$id = $_GET['id'];

			$id_conta = $_POST['id_conta'];
			$id_centro_custos = $_POST['id_centro_custos'];
			$tipo_mov = $_POST['tipo_mov'];
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

			header("location:../index.php?pag=credito&msg=3");
			exit();
		break;
		
		case 'select':
			$id_conta2 = $_POST['id_conta2'];
			//$tipo_mov = $_POST['tipo_mov'];

			//echo $id_conta2;
			//exit;

			//$credito = new Movimentacao();

			//$credito->setId_conta($id_conta2);

			//$credito->setTipo_mov($tipo_mov);

			//$creditos = $dao->listarDeUmaCarteira($credito);
			
			/*
			//var_dump($creditos);
			//exit;

			 header('Content-Type: application/json'); // para formatar corretamente os acentos para o formato json
			 echo json_encode($creditos); // Tranforma o array que está no formato php para o formato json
			 //exit;
			 */
			 header("location:../index.php?pag=credito&conta=".$id_conta2);
	    break;
		
		default:
			echo "Erro na condicao";
		break;
	}
?>
