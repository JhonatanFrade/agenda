<?php

	require_once("../Contas/class.Contas.php");
	require_once("../Contas/class.ContasDAO.php");

	require_once("../Parcelas/class.Parcelas.php");
    require_once("../Parcelas/class.ParcelasDAO.php");

	$dao = new ParcelasDAO();
	
	$action = $_REQUEST['action'];

	switch ($action) {
		case 'insert':
			$id_conta = $_POST['id_conta'];
			$tipo_mov = $_POST['tipo_mov'];
			$id_centro_custos = $_POST['id_centro_custos'];
			$id_item = $_POST['id_item'];

			$nParcelas = $_POST['parcela'];

			$vencimento = $_POST['vencimento'];
			$valorOld = $_POST['valor'];
			$valorNew = str_replace('.','', $valorOld);
			$valorNew = str_replace(',','.', $valorNew);
			$status_pagamento = $_POST['status_pagamento']; // --> status_pagamento 


			$parcela = new Parcelas();

			$parcela->setId_conta($id_conta);
			$parcela->setTipo_mov($tipo_mov);
			$parcela->setId_centro_custos($id_centro_custos);
			$parcela->setId_item($id_item);
			$parcela->setVencimento($vencimento);
			$parcela->setParcela($nParcelas);
			$parcela->setValor($valorNew);
			$parcela->setStatus_pagamento($status_pagamento); // --> status_pagamento 

			$dao->cadastrar($parcela);

			header("location:../index.php?pag=parcelas&msg=1");
			exit();
		break;

		case 'delete':

			$id = $_REQUEST['id'];

			$carteira = new Contas();

			$carteira->setId($id);

			$dao->excluir($carteira);

			header("location:../index.php?pag=parcelas&msg=2");
			exit();

		case 'update':

			$id = $_GET['id'];
		    $id_conta = $_POST['id_conta'];
			$tipo_mov = $_POST['tipo_mov'];
			$id_centro_custos = $_POST['id_centro_custos'];
			$id_item = $_POST['id_item'];
			$nParcelas = $_POST['parcela'];
			$vencimento = $_POST['vencimento'];
			$valor = $_POST['valor']; 
			$status_pagamento = $_POST['status_pagamento']; // --> status_pagamento 

			$parcela = new Parcelas();

			$parcela->setId($id);
			$parcela->setId_conta($id_conta);
			$parcela->setTipo_mov($tipo_mov);
			$parcela->setId_centro_custos($id_centro_custos);
			$parcela->setVencimento($vencimento);
			$parcela->setParcela($nParcelas);
			$parcela->setValor($valor); 
			$parcela->setStatus_pagamento($status_pagamento); // --> status_pagamento 

			$dao->atualiza($parcela);

			header("location:../index.php?pag=parcelas&msg=3");
			exit();
		break;

		case 'select':
			$id_conta2 = $_POST['id_conta2'];
			$tipo_mov2 = $_POST['tipo_mov2'];
			

			header("location:../index.php?pag=parcelas&conta=".$id_conta2."&tipo=$tipo_mov2");
	    break;

		default:
			echo "Erro na condicao";
		break;

		default:
			echo "Erro na condicao";
		break;
	}

?>