<?php 
  /*
   Dia 05/12/2018 Leonardeo desenvolveu este arquivo
  */

  require_once("Contas/class.Contas.php");
  require_once("Contas/class.ContasDAO.php");

  $CarteirasDAO = new ContasDAO();

  require_once("CentroDeCustos/class.CentroDeCustos.php");
  require_once("CentroDeCustos/class.CentroDeCustosDAO.php");

  $CentroDeCustosDAO = new CentroDeCustosDAO();

  require_once("Item/class.Item.php");
  require_once("Item/class.ItemDAO.php");

  $ItemDAO = new ItemDAO();

  require_once("Parcelas/class.Parcelas.php");
  require_once("Parcelas/class.ParcelasDAO.php");

  $ParcelasDAO = new ParcelasDAO();
  
  $id = $_GET['id'];
  $tipo = $_GET['tipo_mov'];
  
  $parcelas = new Parcelas();

  $parcelas->setId($id);
  $parcelas->setTipo_mov($tipo);

  $info = $ParcelasDAO->listarUmaParcela($parcelas); // ----> LISTAR SOMENTE UMA PARCELA 

  if(!empty($info))
  {
    foreach ($info as $key => $obj) 
    {
      $id_info = $obj->getId();
      $vencimento_info = date('Y-m-d', strtotime(str_replace('-','/', $obj->getVencimento())));
      $valor_info = number_format($obj->getValor(), 2, ',', '.');
      $id_conta_info = $obj->getId_conta();
      $id_centro_custo_info = $obj->getId_centro_custos();
      $parcela_info = $obj->getParcela();
      $id_item_info = $obj->getId_item();
      $status_info = $obj->getStatus_pagamento();
      /* tipo_mov não é retirado do objeto pois bem no inicio do script já temos o valor do tipo de movimentação */
    }
  } 

?>

<h1 style="color: white;">Parcelas</h1>

<br>

<form action="php/acao.parcelas.php?action=update&id=<?php echo $id_info ?>" method="POST">
  <div class="dropdown col-md-4">
  	<label>Carteiras</label>

  	<select name="id_conta" class="form-control">
      <?php 

          $carteiras = $CarteirasDAO->listar(); // Retira do Banco Todos os registros

          print_r($carteiras);
          
        foreach ($carteiras as $key => $obj) {
          $id = $obj->getId();
          $name = $obj->getNome();
          echo $id;
          echo $name;
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

  <div class="camp dropdown col-md-4">
    <label for="exampleInputEmail1">Tipo</label>
    <select name="tipo_mov" class="form-control">
      <?php
        if ($tipo == 1) 
        {
          $alternativo = 2;
          echo "<option selected value=".$tipo.">Crédito</option>";
          echo "<option value=".$alternativo.">Débito</option>";
        }
        if ($tipo == 2) 
        {
          $alternativo = 1;
          echo "<option selected value=".$tipo.">Débito</option>";
          echo "<option value=".$alternativo.">Crédito</option>";
          
        }
      ?>
    </select>
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

  <br>

  <!--****************************************************************************-->
  <div class="dropdown col-md-4">
    <label>Item (Custo)</label>
    <select name="id_item" class="form-control">
      <?php 
          $item = $ItemDAO->listar();
          foreach ($item as $key => $obj) {
            $id = $obj->getId();
            $descricao = $obj->getDescricao();

            if($id == $id_item_info){
        ?>
            <option selected value="<?php echo $id ?>"><?php echo $descricao ?></option>
            <?php

          }else{
            ?>
            <option value="<?php echo $id ?>"><?php echo $descricao ?></option>
            <?php
          }
        ?>
      <?php } ?>
    </select>
    <small class="form-text text-muted">informe o item.</small>
  </div>
  <!--****************************************************************************-->

  <br>

  <div class="form-group col-md-2">
    <label>Valor</label>
    <input type="text" id="dinheiro" name="valor" value="<?php echo $valor_info ?>" class="form-control" />
    <small class="form-text text-muted">informe o valor.</small>
  </div>

  <br>

  <!-- Número de Parcelas
  ///////////////////////////////////////////////////////////////////////////// -->
   <div class="form-group col-md-3">
    <label>Número de Parcelas</label>
    <input type="text" id="nParcelas" name="parcela"  value="<?php echo $parcela_info ?>" class="form-control" />
    <small class="form-text text-muted">informe o número de parcelas.</small>
  </div>
  <!-- ///////////////////////////////////////////////////////////////////////// -->

  <div class="form-group col-md-3">
   <label>Data de Vencimento</label>
   <input type="date" name="vencimento" max="3000-12-31" min="1000-01-01" value="<?php echo $vencimento_info ?>" class="form-control">
   <small class="form-text text-muted">informe a data de vencimento das parcelas.</small>
  </div>

  <!-- ///////////////////////////////////////////////////////////////////////// 
       STATUS DE PAGAMENTO:
       Na Tabela tá configurado como char(1) o statu_pagamento
  -->
  
  <div class="camp dropdown col-md-3">
    <label for="exampleInputEmail1">Status de Pagamento</label>
    <select name="status_pagamento" class="form-control">
      <?php
        if ($status_info == 0) 
        {
          $alternativo = 1;
          echo "<option selected value=".$status_info.">Em aberto</option>";
          echo "<option value=".$alternativo.">Pago</option>";
        }
        if ($status_info == 1) 
        {
          $alternativo = 0;
          echo "<option selected value=".$status_info.">Pago</option>";
          echo "<option value=".$alternativo.">Em aberto</option>";
          
        }
      ?>
    </select>
  </div>
  <!-- ///////////////////////////////////////////////////////////////////////// -->

  <br>
  <div class="form-group col-md-6">
    <button type="submit" class="btn btn-primary">Editar</button>
  </div>

</form>

