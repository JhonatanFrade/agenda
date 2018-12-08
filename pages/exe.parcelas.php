<?php 
   /*
   Jhonatan Frade Criou este arquivo
   
   Dia 05/12/2018 Leonardo modificou 
     - Adicionou o campos de status de pagamento
     - Editou os campos item e número de parcelas
     - Desenvolveu a listagem
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
?>

<style type="text/css">
  .camp{
    margin-bottom: 45px;
  }
</style>

<h1 style="color: white;">Parcelas</h1>

<br>

<form action="php/acao.parcelas.php?action=insert" method="POST">

  <div class="camp dropdown col-md-3">
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

  <div class="camp dropdown col-md-2">
    <label for="exampleInputEmail1">Tipo</label>
    <select name="tipo_mov" class="form-control">
      <option value="2">Débito</option>
      <option value="1">Crédito</option>
    </select>
  </div>


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
    <small class="form-text text-muted">informe o centro de custo.</small>
  </div>

  <br>

  <div class="dropdown col-md-4">
    <label>Item (Custo)</label>
    <select name="id_item" class="form-control">
      <?php 
          $item = $ItemDAO->listar();
          foreach ($item as $key => $obj) {
            $id = $obj->getId();
            $descricao = $obj->getDescricao();
        ?>
      <option value="<?php echo $id ?>"><?php echo $descricao ?></option>
      <?php } ?>
    </select>
    <small class="form-text text-muted">informe o item.</small>
  </div>

  <br>

  <div class="form-group col-md-2">
    <label>Valor</label>
    <input type="text" id="dinheiro" name="valor" class="form-control" />
    <small class="form-text text-muted">informe o valor.</small>
  </div>

  <br>

  <!-- O type tá como number, mas na tabela tá como Varchar o campo Parcela 
  ///////////////////////////////////////////////////////////////////////////// -->
   <div class="form-group col-md-3">
    <label>Número de Parcelas</label>
    <input type="text" id="nParcelas" name="parcela" class="form-control" />
    <small class="form-text text-muted">informe o número de parcelas.</small>
  </div>
  <!-- ///////////////////////////////////////////////////////////////////////// -->

  <br>

  <div class="form-group col-md-3">
   <label>Data de Vencimento</label>
   <input type="date" name="vencimento" max="3000-12-31" min="1000-01-01" class="form-control">
   <small class="form-text text-muted">informe a data de vencimento das parcelas.</small>
  </div>

  <!-- ///////////////////////////////////////////////////////////////////////// 
       STATUS DE PAGAMENTO:
       Na Tabela tá configurado como char(1) o statu_pagamento
  -->
  
  <div class="camp dropdown col-md-3">
    <label for="exampleInputEmail1">Status de Pagamento</label>
    <select name="status_pagamento" class="form-control">
      <option value="0">Em aberto</option>
      <option value="1">Pago</option>
    </select>
  </div>
  <!-- ///////////////////////////////////////////////////////////////////////// -->

  <br>
  <div class="form-group col-md-6">
    <button type="submit" class="btn btn-primary">Adicionar</button>
  </div>
</form>

<!-- **************************************CONTROLE DA LISTAGEM************************** -->
<br>
<hr width="900" color=white> 

<form name = "form2" action="php/acao.parcelas.php?action=select" method="POST">
  <div class="dropdown col-md-4">
    <label>Carteiras</label>
    <select name="id_conta2" class="form-control"> 
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

  <div class="camp dropdown col-md-2">
    <label for="exampleInputEmail1">Tipo</label>
    <select name="tipo_mov2" class="form-control">
      <option value="2">Débito</option>
      <option value="1">Crédito</option>
    </select>
  </div>

  <br>

  <div class="form-group col-md-6">
    <button type="submit" class="btn btn-primary">Filtrar</button>
  </div>
</form>

<!-- **********************************************LISTAGEM DAS PARCELAS ****************************** -->
<div class="form-group col-md-10"> 
  <label>Listagem das Parcelas</label>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Vencimento</th>
        <th scope="col">Item</th>
        <th scope="col">Centro de Custo</th>
        <th scope="col">Valor</th>
        <th scope="col">Parcelas</th>
        <th scope="col">Status</th>
        <th scope="col" colspan="2">Ações</th> <!-- COLUNA DOS BOTÕES DE EDITAR E EXCLUIR  -->
      </tr>
    </thead>
    <tbody>
      <?php 
        //************************ACIONA O MÉTODO LISTAR***************
         if (isset($_GET['conta']) and !empty($_GET['conta'])){

          $parcela_conta = $_GET['conta'];
          $parcela_tipo = $_GET['tipo'];

        //************************************************************
        $tipoList = new Parcelas();

        $tipoList ->setTipo_mov($parcela_tipo);

        $parcelas  = $ParcelasDAO->listar($tipoList); // ParcelasDAO objeto criado no inicio do script

         foreach ($parcelas as $key => $obj) 
         {

            $id_parcela = $obj->getId();
            $id_conta = $obj->getId_conta();
            $tipo = $obj->getTipo_mov();

            if (($id_conta == $parcela_conta) && ($tipo == $parcela_tipo))
            {

              $vencimento = $obj->getVencimento(); 

              //*******************RETIRA ITEM DA TABELA********************
              $id_item = $obj->getId_item();

              $item = new Item(); 
              $item->setId($id_item);
              $items = $ItemDAO ->listarUmItem($item);
              foreach ($items as $k => $objeto) 
              {
                $nome_item = $objeto->getDescricao();
              }
              //***************************************************************************

              //*******************RETIRA CENTRO DE CUSTO DA TABELA********************
              $id_centro_custos = $obj->getId_centro_custos();
              $centro_custos = new CentroDeCustos(); // 
              $centro_custos->setId($id_centro_custos);
              $centro_de_custos = $CentroDeCustosDAO->listarUmCentroDeCusto($centro_custos);
              foreach ($centro_de_custos as $k => $objeto) 
              {
                $descricao_centro_custos = $objeto->getNome();
              }
              //***************************************************************************

              $valor = $obj->getValor();
              $num_parcelas = $obj->getParcela();
              $status_pagamento = $obj->getStatus_pagamento();

              //***************************************************************************
              if ($status_pagamento == 0)
              {
                $nome_status = "Em aberto" ;
              }
              if ($status_pagamento == 1)
              {
                $nome_status = "Pago" ;
              }
              //***************************************************************************
       ?>

            <tr>
              <td><?php echo $vencimento;?></td>
              <td><?php echo $nome_item;?></td>
              <td><?php echo $descricao_centro_custos;?></td>
              <td><?php echo 'R$' . number_format($valor, 2, ',', '.');?></td>
              <td><?php echo $num_parcelas;?></td>
              <td><?php echo $nome_status;?></td>

              <td>
                <a href="index.php?pag=parcelas.edit&id=<?php echo $id_parcela; ?>&tipo_mov=<?php echo $tipo?>">
                  <i class="fa fa-pencil-alt"></i>
                </a>
                <a href="php/acao.parcelas.php?action=delete&id=<?php echo $id_parcela; ?>">
                  <i class="fa fa-trash"></i>
                </a>
              </td>

            </tr>
      <?php } ?>
      <?php }
      }else{ ?>
         <td><?php echo 'Sem registro!';?></td>
      <?php } ?>
    </tbody>
  </table>
</div>
