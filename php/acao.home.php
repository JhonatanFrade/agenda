<?php
    // Dia 06/12/2018  Leonardo desenvolveu este arquivo

    require_once("../Home/class.Home.php");
	require_once("../Home/class.HomeDAO.php");

	$homeDAO = new HomeDAO();

	//$action = $_REQUEST['action'];

	$id_conta = $_POST['id_conta'];
	$mes = $_POST['bday'];

    // TOTAL DAS MOVIMENTAÇÕES:
	//-------------------------------------------------------------------------------------
	$tipo = 1;

	$home1 = new Home(); // $home1 para armazenar o tipo de movimentação 1 (crédito)

	$home1->setId_conta($id_conta);
	$home1->setData($mes);
	$home1->setTipo_mov($tipo);

	$total_mov1 = $homeDAO->totalMovimentacao($home1);
	//-------------------------------------------------------------------------------------

	//-------------------------------------------------------------------------------------
	$tipo = 2;

	$home2 = new Home(); // $home2 para armazenar o tipo de movimentação 2 (débito)

	$home2->setId_conta($id_conta);
	$home2->setData($mes);
	$home2->setTipo_mov($tipo);

	$total_mov2 = $homeDAO->totalMovimentacao($home2);
	//-------------------------------------------------------------------------------------

	$total = $total_mov1 - $total_mov2;

	//Têm de ver a questão  da recorrente, se ela ainda não expirou não contabiliza 

	header("location:../index.php?pag=home&total=$total&conta=$id_conta");
	exit();




	

?>