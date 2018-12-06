<?php

	require_once("../Recorrentes/class.Recorrentes.php");
	require_once("../Recorrentes/class.RecorrentesDAO.php");

	require_once("../Contas/class.Contas.php");
	require_once("../Contas/class.ContasDAO.php");

	require_once('../ControllerArquivo/class.Arquivo.php');

	$dao = new RecorrentesDAO();
	
	$action = $_REQUEST['action'];

	var_dump($_POST);
	exit;


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

			$recorrentes = new Recorrentes();

			$recorrentes->setId_conta($id_conta);
			$recorrentes->setTipo_mov($tipo_mov);
			$recorrentes->setId_centro_custos($id_centro_custos);
			$recorrentes->setDia($data);
			$recorrentes->setDescricao($descricao);
			$recorrentes->setValor($valorNew);

			$dao->cadastrar($recorrentes);

			$arquivo = new Arquivo();

			$arquivo->abrirArquivo("a+");
			
			$arquivo->escreverNoArquivo(' -> '.date("d/m/Y H:i:s").' - recorrentes - '.$valorOld);

			$arquivo->fecharArquivo();

			header("location:../index.php?pag=recorrentes&msg=1");
			exit();
		break;

		case 'delete':
			$id = $_REQUEST['id'];

			$recorrentes = new Recorrentes();

			$recorrentes->setId($id);

			$dao->excluir($recorrentes);

			header("location:../index.php?pag=recorrentes&msg=2");
			exit();

		case 'update':
			$id = $_GET['id'];

			$id_conta = $_POST['id_conta'];
			$id_centro_custos = $_POST['id_centro_custos'];
			$tipo_mov = $_POST['tipo_mov'];
			$data = $_POST['data'];
			$descricao = $_POST['descricao'];
			$valor = $_POST['valor'];

			$debito = new Recorrentes();

			$debito->setId($id);
			$debito->setId_conta($id_conta);
			$debito->setId_centro_custos($id_centro_custos); 
			$debito->setTipo_mov($tipo_mov);
			$debito->setData($data);
			$debito->setDescricao($descricao);
			$debito->setValor($valor);

			$dao->atualizar($debito);

			header("location:../index.php?pag=recorrentes&msg=3");
			exit();
		break;
		
		case 'select':
			$id_conta2 = $_POST['id_conta2'];
			//$tipo_mov = $_POST['tipo_mov'];

			//echo $id_conta2;
			//exit;

			//$credito = new Recorrentes();

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
			 header("location:../index.php?pag=recorrentes&conta=".$id_conta2);
	    break;
		
		default:
			echo "Erro na condicao";
		break;
	}
?>
