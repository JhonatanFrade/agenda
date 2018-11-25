<?php
	date_default_timezone_set('America/Araguaina');

	var_dump($_POST);
	exit;

	$tipo_rel = $_POST['tipo_rel'];

	$dao = new ContasDAO();

	switch ($tipo_rel) {
		//Tipo relatorio
		case '1':

			$id_conta = $_POST['id_conta'];
			$tipo_mov = $_POST['tipo_mov'];
			$bday = $_POST['bday'];

			$sql = 'select contas.nome, centro_custo.nome, sum(movimentacao.valor) 
					from centro_custo, movimentacao, contas
					where movimentacao.tipo_mov = '.$tipo_mov.
					'and movimentacao.id_conta = '.$id_conta.
					'and contas.id = '.$id_conta.
					'and ';

		break;

		//Tipo extrato
		case '2':
			$id = $_REQUEST['id'];


			// header("location:../index.php?pag=carteira&msg=2");
			// exit();
		break;

		default:
			echo "Erro na condicao";
		break;
	}
?>