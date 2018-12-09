<?php 
  /*
   Dia 05/12/2018 Leonardeo desenvolveu este arquivo
  */
  require_once("Contas/class.Contas.php");
  require_once("Contas/class.ContasDAO.php");

  $CarteirasDAO = new ContasDAO();

  require_once("Recorrentes/class.Recorrentes.php");
  require_once("Recorrentes/class.RecorrentesDAO.php");

  $RecorrentesDAO = new RecorrentesDAO();

  require_once("CentroDeCustos/class.CentroDeCustos.php");
  require_once("CentroDeCustos/class.CentroDeCustosDAO.php");

  $CentroDeCustosDAO = new CentroDeCustosDAO();

  //print_r($_GET);
  //exit;

  $id = $_GET['id'];
  $tipo = $_GET['tipo_mov'];
  
  $recorrentes = new Recorrentes();

  $recorrentes->setId($id);
  $recorrentes->setTipo_mov($tipo);

  $info = $RecorrentesDAO->listarUmaRecorrente($recorrentes);

  if(!empty($info)){
          foreach ($info as $key => $obj) {
          $dia_info = $obj->getDia();
          $valor_info = number_format($obj->getValor(), 2, ',', '.');
          $id_conta_info = $obj->getId_conta();
          $id_centro_custo_info = $obj->getId_centro_custos();
          $descricao_info = $obj->getDescricao();
          $id_info = $obj->getId();
    }
  } 

?>

<h1 style="color: white;">Recorrentes</h1>

<br>

<form action="php/acao.recorrentes.php?action=update&id=<?php echo $id_info ?>" method="POST">
  <div class="dropdown col-md-4">
  	<label>Carteiras</label>

  	<select name="id_conta" class="form-control">
      <?php 
          $carteiras = $CarteirasDAO->listar(); // Retira do Banco Todos os registros
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
    <small class="form-text text-muted">informe a carteira.</small>
  </div>

  <br>


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

  <div class="form-group col-md-6">
    <label>Descrição</label>
    <textarea name="descricao" class="form-control" rows="3"><?php echo $descricao_info ?></textarea>
    <small class="form-text text-muted">informe a descrição do crédito.</small>
  </div>

  <br>

  <div class="form-group col-md-2">
    <label>Valor</label>
    <input type="text" id="dinheiro" name="valor" class="form-control" value="<?php echo $valor_info ?>"/>
    <small class="form-text text-muted">informe o valor.</small>
  </div>
  <br>

<div class="form-group col-md-2">
   <label>Dia</label>
   <input type="number" name = "dia" value="<?php echo $dia_info ?>" min="1" max="28" class="form-control">
   <small class="form-text text-muted">informe o dia.</small>
</div>

  <br>
  <div class="form-group col-md-6">
    <button type="submit" class="btn btn-primary">Editar</button>
  </div>

</form>

