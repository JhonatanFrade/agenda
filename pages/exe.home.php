<?php 

  //Responsável Leonardo de Oliveira Meirelles

  require_once("Contas/class.Contas.php");
  require_once("Contas/class.ContasDAO.php");

  $CarteirasDAO = new ContasDAO();

  require_once("Movimentacao/class.Movimentacao.php");
  require_once("Movimentacao/class.MovimentacaoDAO.php");

  $MovimentacaoDAO = new MovimentacaoDAO();

?>
	<h1 style="color: white;">Home</h1>

	<div class="dropdown col-md-4">
		<label>Carteira selecionada</label>
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
	<br>

	<div class="form-group col-md-2">
		<label>Saldo</label>
		<input type="text" value="100.00" class="form-control">
	</div>

	<br>

	<div id="tableConta" class="form-group col-md-8">
		<label>Ultimas movimentações</label>
		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col">Data</th>
		      <th scope="col">Descrição</th>
		      <th scope="col">Valor</th>
		    </tr>
		  </thead>
		  <tbody>
		  	 <?php 
			  	
			  ?>
		    <tr>
		      <td></td>
		      <td></td>
		      <td></td>
		    </tr>
		    <tr>
		      <td colspan="3">TOTAL</td>
		    </tr>
		  </tbody>
		</table>
	</div>

	<br>

	<div id="tableConta" class="form-group col-md-8">
		<label>Próximos débitos</label>
		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col">Data</th>
		      <th scope="col">Centro de Custo</th>
		      <th scope="col">Valor</th>
		    </tr>
		  </thead>
		  <tbody>
		  	 <?php 
			  	
			  ?>
		    <tr>
		      <td></td>
		      <td></td>
		      <td></td>
		    </tr>
		    <tr>
		      <td colspan="3">TOTAL</td>
		    </tr>
		  </tbody>
		</table>
	</div>
