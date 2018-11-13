<?php 

  //Responsável: Jhonatan Frade

  require_once("Contas/class.Contas.php");
  require_once("Contas/class.ContasDAO.php");

  $CarteirasDAO = new ContasDAO();

  require_once("Movimentacao/class.Movimentacao.php");
  require_once("Movimentacao/class.MovimentacaoDAO.php");

  $MovimentacaoDAO = new MovimentacaoDAO();

  require_once("CentroDeCustos/class.CentroDeCustos.php");
  require_once("CentroDeCustos/class.CentroDeCustosDAO.php");

  $CentroDeCustosDAO = new CentroDeCustosDAO();

?>

<h1 style="color: white;">Crédito</h1>

<br>

<form action="php/acao.credito.php?action=insert" method="POST">
  <div class="dropdown col-md-4">
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
  <br>
  <div class="dropdown col-md-4">
    <label>Centro de custos</label>
    <select name="id_centro_custos" class="form-control">
      <?php 
          $centro_de_custos = $CentroDeCustosDAO->listar();
        foreach ($centro_de_custos as $key => $obj) {
          $id = $obj->getId();
          $name = $obj->getNome();
        ?>
      <option value="<?php echo $id ?>"><?php echo $name ?></option>
      <?php } ?>
    </select>
    <small class="form-text text-muted">informe a carteira.</small>
  </div>
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

<br><br><br><br>

<div class="dropdown col-md-4">
  <label>Carteiras</label>
  <select name="id_conta" class="form-control selectContaListagem">
    <?php 
        $carteiras = $CarteirasDAO->listar();
      foreach ($carteiras as $key => $obj) {
        $id = $obj->getId();
        $name = $obj->getNome();
      ?>
    <option value="<?php echo $id ?>"><?php echo $name ?></option>
    <?php } ?>
  </select>
</div>
<br>
<div class="form-group col-md-10">
  <label>Listagem de créditos</label>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Data</th>
        <th scope="col">Centro de Custo</th>
        <th scope="col">Valor</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php 

        $tipoDeListagem = 1;

        $creditos = $MovimentacaoDAO->listar($tipoDeListagem);
        if(!empty($creditos)){
          foreach ($creditos as $key => $obj) {
          $data = $obj->getData();

          $id_centro_custos = $obj->getId_centro_custos();
          $centro_custos = new CentroDeCustos();
          $centro_custos->setId($id_centro_custos);
          $centro_de_custos = $CentroDeCustosDAO->listarUmCentroDeCusto($centro_custos);
          foreach ($centro_de_custos as $k => $objeto) {
            $descricao_centro_custos = $objeto->getNome();
          }

          $valor = $obj->getValor();
          $id_credito = $obj->getId();
      ?>
      <tr>
        <td><?php echo $data;?></td>
        <td><?php echo $descricao_centro_custos;?></td>
        <td><?php echo 'R$' . number_format($valor, 2, ',', '.');?></td>
        <td>
          <a href="index.php?pag=credito.edit&id=<?php echo $id_credito; ?>">
            <i class="fa fa-pencil-alt"></i>
          </a>
          <a href="php/acao.credito.php?action=delete&id=<?php echo $id_credito; ?>">
            <i class="fa fa-trash"></i>
          </a>
        </td>
      </tr>
      <?php } ?>
      <?php }else{ ?>
         <td><?php echo 'Sem registro!';?></td>
        <?php } ?>
    </tbody>
  </table>
</div>

