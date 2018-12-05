<?php 

  require_once("Contas/class.Contas.php");
  require_once("Contas/class.ContasDAO.php");

  $CarteirasDAO = new ContasDAO();

  require_once("CentroDeCustos/class.CentroDeCustos.php");
  require_once("CentroDeCustos/class.CentroDeCustosDAO.php");

  $CentroDeCustosDAO = new CentroDeCustosDAO();

  require_once("Recorrentes/class.Recorrentes.php");
  require_once("Recorrentes/class.RecorrentesDAO.php");

  $RecorrentesDAO = new RecorrentesDAO();

?>

<style type="text/css">
  .camp{
    margin-bottom: 45px;
  }
</style>

<h1 style="color: white;">Recorrentes</h1>

<br>

<form action="php/acao.recorrentes.php?action=insert" method="POST">

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

  <div class="camp dropdown col-md-4">
    <label for="exampleInputEmail1">Tipo</label>
    <select name="tipo_mov" class="form-control">
      <option value="2">Débito</option>
      <option value="1">Crédito</option>
    </select>
  </div>

  <div class="form-group col-md-6">
    <label>Descrição</label>
    <textarea name="descricao" class="form-control" rows="3"></textarea>
    <small class="form-text text-muted">informe a descrição da recorrente.</small>
  </div>

  <br>
  <div class="form-group col-md-2">
    <label>Valor</label>
    <input type="text" id="dinheiro" name="valor" class="form-control" />
    <small class="form-text text-muted">informe o valor.</small>
  </div>

  <br>

  <div class="form-group col-md-2">
   <label>Dia</label>
   <input type="number" name = "dia" value="1" min="1" max="28" class="form-control">
   <small class="form-text text-muted">informe o dia.</small>
  </div>
  
  <br>
  <div class="form-group col-md-6">
    <button type="submit" class="btn btn-primary">Adicionar</button>
  </div>
</form>

<br><br><br>

<!-- **************************************CONTROLE DA LISTAGEM POR NOME DAS CONTAS******* -->

<!--  Formulário número 2-->
<form name = "form2" action="php/acao.recorrentes.php?action=select" method="POST">
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
    <small class="form-text text-muted">Selecione a carteira desejada e clique em filtrar
    para que seja realizada a filtragem na tabela</small>
  </div>

  <div class="camp dropdown col-md-4">
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

<!-- **********************************************LISTAGEM DAS RECORRENTES********************************** -->
<div class="form-group col-md-10"> 
  <label>Listagem de Recorrentes</label>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Data</th>
        <th scope="col">Centro de Custo</th>
        <th scope="col">Valor</th>
        <th scope="col" colspan="2">Ações</th> <!-- COLUNA DOS BOTÕES DE EDITAR E EXCLUIR  -->
      </tr>
    </thead>
    <tbody>
      <?php 
        //************************ACIONA O MÉTODO LISTAR********************************************
         if (isset($_GET['conta']) and !empty($_GET['conta'])){

          $recorrente_conta = $_GET['conta'];
          $recorrente_tipo = $_GET['tipo'];

          //************************************************************

          $tipoList = new Recorrentes();

          $tipoList ->setTipo_mov($recorrente_tipo);

          $recorrentes  = $RecorrentesDAO->listar($tipoList);

          foreach ($recorrentes  as $key => $obj) {

          $id = $obj->getId_conta();
          $tipo = $obj->getTipo_mov();

          if (($id == $recorrente_conta) && ($tipo == $recorrente_tipo)){
          $dia = $obj->getDia();
          //*******************APRESENTAR CENTRO DE CUSTO NA TABELA******************************
          $id_centro_custos = $obj->getId_centro_custos();
          $centro_custos = new CentroDeCustos(); // 
          $centro_custos->setId($id_centro_custos);
          $centro_de_custos = $CentroDeCustosDAO->listarUmCentroDeCusto($centro_custos);
          foreach ($centro_de_custos as $k => $objeto) 
          {
            $descricao_centro_custos = $objeto->getNome();
          }
          //************************************************************************************
          $valor = $obj->getValor();
          $id_recorrente = $obj->getId();
      ?>
      <tr>
        <td><?php echo $dia;?></td>
        <td><?php echo $descricao_centro_custos;?></td>
        <td><?php echo 'R$' . number_format($valor, 2, ',', '.');?></td>

        <td>
          <a href="index.php?pag=recorrentes.edit&id=<?php echo $id_recorrente; ?>&tipo_mov=<?php echo $tipo?>">
            <i class="fa fa-pencil-alt"></i>
          </a>
          <a href="php/acao.recorrentes.php?action=delete&id=<?php echo $id_recorrente; ?>">
            <i class="fa fa-trash"></i>
          </a>
        </td>
        
        <!--****************************************************************************************************  -->
      </tr>
      <?php } ?>
      <?php }
      }else{ ?>
         <td><?php echo 'Sem registro!';?></td>
        <?php } ?>
    </tbody>
  </table>
</div>
<!-- ******************************************************************************************************* -->
