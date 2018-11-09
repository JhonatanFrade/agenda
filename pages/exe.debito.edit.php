<?php 
  date_default_timezone_set('America/Araguaina');
  /*
  Leonardo modificou este trecho dia 07/11/2018
  ----------------------------------------------------------------------
  */
  require_once("Contas/class.Contas.php");
  require_once("Contas/class.ContasDAO.php");

  $CarteirasDAO = new ContasDAO(); // Crio o objeto da classe ContasDAO, para realizar a listagem no dropdown

  require_once("Movimentacao/class.Movimentacao.php");
  require_once("Movimentacao/class.MovimentacaoDAO.php");

  $MovimentacaoDAO = new MovimentacaoDAO(); 
  /* Crio o objeto da classes MovimentacaoDAO para utlizar os metodos responsáveis por inserir os dados 
  na tebela e de listar essas informações ao usuário*/

  require_once("CentroDeCustos/class.CentroDeCustos.php"); 
  require_once("CentroDeCustos/class.CentroDeCustosDAO.php");

  $CentroDeCustosDAO = new CentroDeCustosDAO(); 

  $id = $_GET['id'];

  $movimentacao = new Movimentacao();

  $movimentacao->setId($id);
  $movimentacao->setTipo_mov(2);

  $info = $MovimentacaoDAO->listarUmaMovimentacao($movimentacao);

  if(!empty($info)){
          foreach ($info as $key => $obj) {
          $data_info = date('Y-m-d', strtotime(str_replace('-','/', $obj->getData())));
          $valor_info = number_format($obj->getValor(), 2, ',', '.');
          $id_conta_info = $obj->getId_conta();
          $id_centro_custo_info = $obj->getId_centro_custos();
          $descricao_info = $obj->getDescricao();
          $id_info = $obj->getId();
  
    }
  } 
//------------------------------------------------------------------------
?>

<!--  
  Leonardo modificou este trecho dia 08/11/2018
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
-->

<h1 style="color: white;">Débitos</h1>

<br>
<!-- **************************************dropdown Nome das contas******************************************* -->
<form action="php/acao.debito.php?action=update&id=<?php echo $id_info ?>" method="POST">
  <div class="dropdown col-md-4">
    <label>Carteiras</label>
    <select name="id_conta" class="form-control">
      <?php 
          $carteiras = $CarteirasDAO->listar();
        foreach ($carteiras as $key => $obj) {
          $id = $obj->getId();
          $name = $obj->getNome();

          if($id == $id_conta_info){

            ?>
             <option selected value="<?php echo $id ?>"><?php echo $name ?></option>
            <?php

          }else{
            ?>
            <option value="<?php echo $id ?>"><?php echo $name ?></option>
            <?php
          }
        ?>
      <?php } ?>
    </select>
    <small class="form-text text-muted">informe a carteira.</small>
  </div>
<!-- ******************************************************************************************************* -->
  <br>
<!-- **************************************dropdown Nome dos Centros de custos****************************** -->
  <div class="dropdown col-md-4">
    <label>Centro de custos</label>
    <select name="id_centro_custos" class="form-control">
      <?php 
          $centro_de_custos = $CentroDeCustosDAO->listar();
        foreach ($centro_de_custos as $key => $obj) {
          $id = $obj->getId();
          $name = $obj->getNome();

          if($id == $id_centro_custo_info){

            ?>
             <option selected value="<?php echo $id ?>"><?php echo $name ?></option>
            <?php

          }else{
            ?>
            <option value="<?php echo $id ?>"><?php echo $name ?></option>
            <?php
          }
        ?>
      <?php } ?>
    </select>
    <small class="form-text text-muted">informe o centro de custo.</small>
  </div>
<!-- ******************************************************************************************************* -->
  <br>

  <div class="form-group col-md-6">
    <label>Descrição</label>
    <textarea name="descricao" class="form-control" rows="3"><?php echo $descricao_info ?></textarea>
    <small class="form-text text-muted">informe a descrição do débito.</small>
  </div>
  <br>
  <div class="form-group col-md-2">
    <label>Valor</label>
    <input type="text" id="dinheiro" name="valor" class="form-control" value="<?php echo $valor_info ?>" />
    <small class="form-text text-muted">informe o valor.</small>
  </div>
  <br>
  <div class="form-group col-md-3">
   <label>Data</label>
   <input type="date" name="data" max="3000-12-31" min="1000-01-01" value="<?php echo $data_info ?>" class="form-control">
   <small class="form-text text-muted">informe a data.</small>
  </div>
  <br>
  <div class="form-group col-md-6">
    <button type="submit" class="btn btn-primary">Adicionar</button>
  </div>
  <input type="hidden" name="tipo_mov" value="2" /> <!--tipo_mov = 2  para Débito-->
</form>
