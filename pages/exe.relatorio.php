<!-- Responsável Leonardo de Oliveira Meirelles -->

<?php 

	require_once("Contas/class.Contas.php");
	require_once("Contas/class.ContasDAO.php");

	 $CarteirasDAO = new ContasDAO();

?>

<style type="text/css">
	.camp{
		margin-bottom: 45px;
	}
</style>

<h1 style="color: white;">Relatórios</h1>

<form action="php/acao.relatorio.php?action=relatorio" method="post">

	<div class="camp dropdown col-md-2">
		<label>Tipo de relatorio</label>
		<input type="radio" name="tipo_rel" value="1"> Geral<br>
		<input type="radio" name="tipo_rel" value="2"> Extrato<br>

	</div>

	<div class="camp dropdown col-md-4">
	  	<label>Carteiras</label>
	  	<select name="id_conta" class="form-control">
	      <?php 
	          $carteiras = $CarteirasDAO->listar();
	        foreach ($carteiras as $key => $obj) {
	          $id = $obj->getId();
	          $name = $obj->getNome();
	        ?>
	  		<option value="<?php echo $id ?>"><?php echo $name ?></option>
	      <?php } ?>
	  	</select>
	    <small class="form-text text-muted">informe a carteira.</small>
	  </div>

	<div class="camp dropdown col-md-4">
		<label for="exampleInputEmail1">Tipo</label>
		<select name="tipo_mov" class="form-control">
			<option></option>
			<option value="2">Débito</option>
			<option value="1">Crédito</option>
		</select>
	</div>


	<div class="camp form-group col-md-4">
		<label >Selecione o mês</label>
		<input type="month" name="bday" max="3000-12" min="2018-01" class="form-control">
	</div>

	<button type="submit" class="btn btn-primary">Imprimir Relatorio</button>
</form>