
<?php 
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
  
//------------------------------------------------------------------------
?>

<!--  
  Leonardo modificou este trecho dia 08/11/2018
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
-->

<h1 style="color: white;">Débitos</h1>

<br>
<!-- **************************************dropdown Nome das contas******************************************* -->
<form action="php/acao.debito.php?action=insert" method="POST">
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
        ?>
      <option value="<?php echo $id ?>"><?php echo $name ?></option>
      <?php } ?>
    </select>
    <small class="form-text text-muted">informe o centro de custo.</small>
  </div>
<!-- ******************************************************************************************************* -->
  <br>

  <div class="form-group col-md-6">
    <label>Descrição</label>
    <textarea name="descricao" class="form-control" rows="3"></textarea>
    <small class="form-text text-muted">informe a descrição do débito.</small>
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
  <input type="hidden" name="tipo_mov" value="2" /> <!--tipo_mov = 2  para Débito-->
</form>

<br><br><br>

<!-- **************************************CONTROLE DA LISTAGEM POR NOME DAS CONTAS******* -->

<!--  Formulário número 2-->
<form name = "form2" action="php/acao.debito.php?action=select" method="POST">
  <div class="dropdown col-md-4">
    <label>Carteiras</label>
    <select name="id_conta2" class="form-control"> 
    <!-- <select name="id_conta" class="form-control selectContaListagem"> -->
      <!--Quando selecionado a opção a id da conta é mandada para o js, para o evento change
      que por sua vez manda a id_conta e o tipo de movimentação para o arquivo acao.debito.php  -->
      <?php 
          $carteiras = $CarteirasDAO->listar();
        foreach ($carteiras as $key => $obj) {
          $id = $obj->getId();
          $name = $obj->getNome();
        ?>
      <option value="<?php echo $id ?>"><?php echo $name ?></option>
      <?php } ?>
    </select>
    <small class="form-text text-muted">Selecione a carteira dejeda e clique em filtrar
    para que seja realizada a filtragem na tabela</small>
  </div>
  <br>
  <div class="form-group col-md-6">
    <button type="submit" class="btn btn-primary">Filtrar</button>
  </div>
</form>

  <br>

<!-- ******************************************************************************************************* -->


<!-- **********************************************LISTAGEM DOS DÉBITOS************************************ -->
<!-- Modificado/Antes eu tinha colocado o col-md com 12 para ter espaço para colocar os botões
Como por enquanto não estamos usando os botões deixei a tabela com o tamanho que estava antes.   -->
<div class="form-group col-md-10"> 
  <label>Listagem de débitos</label>
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

          $debito_selec = $_GET['conta'];

          $tipoDeListagem = 2;

          //************************************************************

          $tipoList = new Movimentacao();

          $tipoList ->setTipo_mov($tipoDeListagem);

          $debitos  = $MovimentacaoDAO->listar($tipoList);

          //$debitos = $MovimentacaoDAO->listar($tipoDeListagem);

          foreach ($debitos as $key => $obj) {

          $id = $obj->getId_conta();
          $tipo = $obj->getTipo_mov();

          if (($id == $debito_selec) && ($tipo == $tipoDeListagem)){
          $data = $obj->getData();
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
          $id_debito = $obj->getId();
      ?>
      <tr>
        <td><?php echo $data;?></td>
        <td><?php echo $descricao_centro_custos;?></td>
        <td><?php echo 'R$' . number_format($valor, 2, ',', '.');?></td>

        <td>
          <a href="index.php?pag=debito.edit&id=<?php echo $id_debito; ?>">
            <i class="fa fa-pencil-alt"></i>
          </a>
          <a href="php/acao.debito.php?action=delete&id=<?php echo $id_debito; ?>">
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
