<?php

	require_once("../Contas/class.Contas.php");
	require_once("../Contas/class.ContasDAO.php");

	require_once("../Recorrentes/class.Recorrentes.php");
    require_once("../Recorrentes/class.RecorrentesDAO.php");
	
	//require_once('../ControllerArquivo/class.Arquivo.php');

	$dao = new RecorrentesDAO();
	
	$action = $_REQUEST['action'];

	switch ($action) {
		case 'insert':
			$id_conta = $_POST['id_conta'];
			$tipo_mov = $_POST['tipo_mov'];
			$id_centro_custos = $_POST['id_centro_custos'];
			$dia = $_POST['dia'];
			$descricao = $_POST['descricao'];
			$valorOld = $_POST['valor'];

			$valorNew = str_replace('.','', $valorOld);
			$valorNew = str_replace(',','.', $valorNew);

			$recorrente = new Recorrentes();

			$recorrente->setId_conta($id_conta);
			$recorrente->setTipo_mov($tipo_mov);
			$recorrente->setId_centro_custos($id_centro_custos);
			$recorrente->setDia($dia);
			$recorrente->setDescricao($descricao);
			$recorrente->setValor($valorNew);

			$dao->cadastrar($recorrente);

			/*
			$arquivo = new Arquivo();

			$arquivo->abrirArquivo("a+");
			
			$arquivo->escreverNoArquivo(' -> '.date("d/m/Y H:i:s").' - crédito - '.$valorOld);

			$arquivo->fecharArquivo();

			*/

			header("location:../index.php?pag=recorrentes&msg=1");
			exit();
		break;

		case 'delete':

			$id = $_REQUEST['id'];

			$carteira = new Contas();

			$carteira->setId($id);

			$dao->excluir($carteira);

			header("location:../index.php?pag=recorrentes&msg=2");
			exit();

		case 'update':

			$id = $_GET['id'];
			$id_conta = $_POST['id_conta'];
			$id_centro_custos = $_POST['id_centro_custos'];
			$tipo_mov = $_POST['tipo_mov']; 
			$dia = $_POST['dia'];
			$descricao = $_POST['descricao'];
			$valor = $_POST['valor'];

			$recorrentes = new Recorrentes();

			$recorrentes->setId($id);
			$recorrentes->setId_conta($id_conta);
			$recorrentes->setId_centro_custos($id_centro_custos); 
			$recorrentes->setTipo_mov($tipo_mov);
			$recorrentes->setDia($dia);
			$recorrentes->setDescricao($descricao);
			$recorrentes->setValor($valor);

			$dao->atualiza($recorrentes);

			header("location:../index.php?pag=recorrentes&msg=3");
			exit();
		break;

		case 'select':
			$id_conta2 = $_POST['id_conta2'];
			$tipo_mov2 = $_POST['tipo_mov2'];
			

			header("location:../index.php?pag=recorrentes&conta=".$id_conta2."&tipo=$tipo_mov2");
	    break;

		default:
			echo "Erro na condicao";
		break;

		default:
			echo "Erro na condicao";
		break;
	}

?>
