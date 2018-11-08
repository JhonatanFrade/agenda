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
  na tabela e de listar essas informações ao usuário*/

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

<div class="float-md-right" style="margin-right: 50px;">
  <label>NOVO</label>
  <button type="button" id="btn-add-1" class="btn btn-primary" data-toggle="modal" data-target="#walletModal"><i class="fa fa-plus-circle"></i></button>
</div>
<br><br><br>
 
<div class="modal fade" id="walletModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo Débito</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="formWallet" action="php/acao.debito.php?action=insert" method="POST">
        <div class="modal-body">
          <div class="dropdown col-md-4">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Carteiras</label>
              <select name="id_conta" class="form-control">
                <option value="0"></option> <!-- Começa com o preenchimento do dropdown vazio -->
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
          </div>

          <div class="dropdown col-md-4">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Centro de Custo</label>
              <select name="id_centro_custos" class="form-control">
                <option value="0"></option> <!-- Começa com o preenchimento do dropdown vazio -->
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
          </div>

          <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="3"></textarea>
            <small class="form-text text-muted">informe a descrição do débito.</small>
          </div>

          <div class="form-group col-md-2">
            <label>Valor</label>
            <input type="text" id="dinheiro" name="valor" class="form-control" />
            <small class="form-text text-muted">informe o valor.</small>
          </div>

          <div class="form-group col-md-3">
           <label>Data</label>
           <input type="date" name="data" max="3000-12-31" min="1000-01-01" class="form-control">
           <small class="form-text text-muted">informe a data.</small>
          </div>

          <div class="modal-footer">
            <button type="button" id="btnClose" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
          <input type="hidden" name="tipo_mov" value="2" /> <!--tipo_mov = 2  para Débito-->
        </div>
      </form>
    </div>
  </div>
</div>
   
     
<!-- **************************************CONTROLE DA LISTAGEM POR NOME DAS CONTAS******* -->
<!--
  COMO FAZER:
  Quando acessada a página o dropdown começa vazio portanto na tabela não é listado nada porém quando o usuário seleciona uma carteira a tabela é atualizada com os registros correspondentes  aquela conta, a listagem também é apresentada quando o usuário inseri o formulário na base de dados, por exemplo é nserido um formulário no qual o campo o nome da carteira é selecionado como x, quando armazenado e executado o redirecionamento para a página é enviado a esta pagina(arquivo exe.___.php) o nome x e colocado dentro de uma condição para listar somente os registros correspondentes a este nome. -->

<div class="dropdown col-md-4">
  <label>Carteiras</label>
  <select name="id_conta" class="form-control">
    <option value="0"></option> <!-- Começa com o preenchimento do dropdown vazio -->
    <?php 
        $carteiras = $CarteirasDAO->listar();
      foreach ($carteiras as $key => $obj) {
        $id = $obj->getId();
        $name = $obj->getNome();
      ?>
    <option value="<?php echo $id ?>"><?php echo $name ?></option>
    <?php 
    
      }?>

  </select>
</div>
<br>
<!-- ******************************************************************************************************* -->


<!-- **********************************************LISTAGEM DOS DÉBITOS************************************ -->

<div class="form-group col-md-12"> <!--Tamanho da tabela modificado de 8 para 12  -->
  <label>Listagem de débitos</label>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Data</th>
        <!--<th scope="col">Descrição</th>-->
        <th scope="col">Centro de Custo</th>
        <th scope="col">Valor</th>
        <!--<th scope="col" colspan="2">Ações</th>--> <!-- COLUNA DOS BOTÕES DE EDITAR E EXCLUIR  -->
      </tr>
    </thead>
    <tbody>
      <?php 
        //************************ACIONA O MÉTODO LISTAR********************************************
        //$debitos = $MovimentacaoDAO->listarDebitos(); // AQUI LISTAR SOMENTE DÉBITOS!!
        $tipoDeListagem = 2;


        //Têm de criar o objeto
        $debitos = $MovimentacaoDAO->listar($tipoDeListagem);

        //******************************************************************************************
        if(!empty($debitos)){
          foreach ($debitos as $key => $obj) {
          $data = $obj->getData();
          //$descricao_debito = $obj->getDescricao(); // Recebe a descrição do tipo de movimentação
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
      ?>
      <tr>
        <td><?php echo $data;?></td>
        <!--<td><?php //echo $descricao_debito?></td>--> <!-- Descrição do tipo de movimentação  -->
        <td><?php echo $descricao_centro_custos;?></td>
        <td><?php echo $valor;?></td>
        <!-- ********************************BOTÕES DE EDITAR E EXCLUIR****************************************** -->
        <!--
        <td>
          <button type="button" id="<?php //echo $id; ?>" data-toggle="modal" data-target="#centerCustosModal">
            <input type="hidden" value="<?php //echo $name; ?>">
            <i class="fa fa-pencil-alt"></i>
          </button>
          <button style="margin-left: 20px;" onclick="location.href='php/acao.debito.php?action=delete&id=<?php //echo $id; ?>'">
            <i class="fa fa-trash"></i>
          </button>
        </td>
        -->
        <!--****************************************************************************************************  -->
      </tr>
      <?php } ?>
      <?php }else{ ?>
         <td><?php echo 'Sem registro!';?></td>
        <?php } ?>
    </tbody>
  </table>
</div>
<!-- ******************************************************************************************************* -->