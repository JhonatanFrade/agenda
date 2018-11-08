$(document).ready(function () {

	$(".selectContaListagem").on('change', function() {
	  var value = $(this).val();
	  alert(value);
	});

	$('#dinheiro').mask('#.##0,00', {reverse: true});

	//Quando clicar no botão editar da Conta
	$('#tableConta button').on("click", function() {
		//pegar o id do bottao editar
		var id = $( this ).attr('id');
		//mudar o action do form
		$( '#formWallet' )[0].attributes[1].value = 'php/acao.carteira.php?action=update&id='+id;
		//pegar o valor do nome
		var valor = $( '#'+id+' input' )[0].value;
		//colocar o valor do nome no input do modal
		$('#walletModal').find('.modal-body input').val(valor);
	});

	$('#btn-add-1').on("click", function() {
		//limpar o input do modal
		$('#walletModal').find('.modal-body input').val('');
		//mudar o action do form
		$( '#formWallet' )[0].attributes[1].value = 'php/acao.carteira.php?action=insert';
	});






	//Quando clicar no botão editar do Centro de Custo
	$('#tableCenterCustos button').on("click", function() {
		//pegar o id do bottao editar
		var id = $( this ).attr('id');
		//mudar o action do form
		$( '#formCenterCustos' )[0].attributes[1].value = 'php/acao.centro_custos.php?action=update&id='+id;
		//pegar o valor do nome
		var valor = $( '#'+id+' input' )[0].value;
		//colocar o valor do nome no input do modal
		$('#centerCustosModal').find('.modal-body input').val(valor);
	});

	$('#btn-add-2').on("click", function() {
		//limpar o input do modal
		$('#centerCustosModal').find('.modal-body input').val('');
		//mudar o action do form
		$( '#formCenterCustos' )[0].attributes[1].value = 'php/acao.centro_custos.php?action=insert';
	});




	//Quando clicar no botão editar do Item
	$('#tableItem button').on("click", function() {
		//pegar o id do bottao editar
		var id = $( this ).attr('id');
		//mudar o action do form
		$( '#formItem' )[0].attributes[1].value = 'php/acao.item.php?action=update&id='+id;
		//pegar o valor do nome
		var valor = $( '#'+id+' input' )[0].value;
		//colocar o valor do nome no input do modal
		$('#itemModal').find('.modal-body input').val(valor);
	});

	$('#btn-add-3').on("click", function() {
		//limpar o input do modal
		$('#itemModal').find('.modal-body input').val('');
		//mudar o action do form
		$( '#formItem' )[0].attributes[1].value = 'php/acao.item.php?action=insert';
	});

});

