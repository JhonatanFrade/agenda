<?php 

	require_once('./ControllerArquivo/class.Arquivo.php');

	$arquivo = new Arquivo();

	$arquivo->abrirArquivo("a+");
	
	$arquivo->escreverNoArquivo("teste 345");

	$arquivo->fecharArquivo();

?>