<?php 

  //Responsável: Jhonatan Frade

	// echo 'Credito';

  require_once("Contas/class.Contas.php");
  require_once("Contas/class.ContasDAO.php");

  $CarteirasDAO = new ContasDAO();

  require_once("Movimentacao/class.Movimentacao.php");
  require_once("Movimentacao/class.MovimentacaoDAO.php");

  $MovimentacaoDAO = new MovimentacaoDAO();

?>

<h1 style="color: white;">Crédito</h1>

<br>

<form action="php/acao.credito.php?action=insert" method="POST">
  <div class="dropdown col-md-4">
  	<label>Carteiras</label>
  	<select name="id_conta" class="form-control">
  		<option value="0"></option>
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
  <div class="form-group col-md-6">
    <label>Descrição</label>
    <textarea name="descricao" class="form-control" rows="3"></textarea>
    <small class="form-text text-muted">informe a descrição do crédito.</small>
  </div>
  <br>
  <div class="form-group col-md-2">
    <label>Valor</label>
    <input type="text" id="dinheiro" name="valor" class="form-control" />
    <small class="form-text text-muted">informe o valor.</small>
  </div>
  <br>
	<div class="form-group col-md-3">
	 <label>Data</label>
	 <input type="date" name="data" max="3000-12-31" min="1000-01-01" class="form-control">
   <small class="form-text text-muted">informe a data.</small>
	</div>
  <br>
  <div class="form-group col-md-6">
    <button type="submit" class="btn btn-primary">Adicionar</button>
  </div>
  <input type="hidden" name="tipo_mov" value="1" />
</form>

<br><br>

<ul class="list-group col-md-6" style="color: black;">
  <li class="list-group-item disabled">Listagem de créditos do mês</li>
  <?php 
    $creditos = $MovimentacaoDAO->listar();
    if(!empty($creditos)){
      foreach ($creditos as $key => $obj) {
      $data = $obj->getData();
      $descricao = $obj->getDescricao();
  ?>
  <li class="list-group-item">
  	<?php echo $data . ' - '. $descricao;?>
  </li>
  <?php } ?>
<?php }else{ ?>
  <li class="list-group-item">
    não há registro!
  </li>
  <?php } ?>
</ul>

