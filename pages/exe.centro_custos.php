<!--
     - Arquivo criado pelo Leonardo dia 16/10.
     - Modificado pelo jonhatan dia 23/10/2018 (Adicionado o Modal e a listagem)
     - Modificado pelo Jonhatam dia 22/11/18 (Retirado o botão excluir da listagem)
     - Modificado pelo jonhatan dia 24/11/2018 (Configuração do Relatório)   
-->

<?php 

	require_once("CentroDeCustos/class.CentroDeCustos.php");
	require_once("CentroDeCustos/class.CentroDeCustosDAO.php");

	$dao = new CentroDeCustosDAO();

?>

<h1 style="color: white;">Centro de Custos</h1>

<div class="float-md-right" style="margin-right: 25px;">
	<label>NOVO</label>
	<button type="button" id="btn-add-2" class="btn btn-primary" data-toggle="modal" data-target="#centerCustosModal"><i class="fa fa-plus-circle"></i></button>
</div>
<br><br><br>
 
<div class="modal fade" id="centerCustosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo Centro de Custos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formCenterCustos" action="php/acao.centro_custos.php?action=insert" method="POST">
      	<div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nome</label>
            <input type="text" name="name" class="form-control">
          </div>
      	</div>
      	<div class="modal-footer">
        	<button type="button" id="btnClose" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        	<button type="submit" class="btn btn-primary">Salvar</button>
      	</div>
      </form>
    </div>
  </div>
</div>

<div id="tableCenterCustos" class="form-group col-md-12">
	<table class="table table-striped" >
	  <thead>
	    <tr>
	      <th scope="col">Nome</th>
	      <th scope="col">Data criação</th>
	      <th scope="col">Última alteração</th>
	      <th scope="col" colspan="2">Ações</th>
	    </tr>
	  </thead>
	  <tbody>
	  	 <?php 
		  	$centro_custos = $dao->listar();
			foreach ($centro_custos as $key => $obj) {
				$id = $obj->getId();
				$name = $obj->getNome();
				$date_c = $obj->getDateCreate();
				$date_u = $obj->getDateUpdate();
		  ?>
	    <tr>
	      <td><?php echo $name; ?></td>
	      <td><?php echo $date_c; ?></td>
	      <td><?php echo $date_u; ?></td>
	      <td>
	      	<button type="button" id="<?php echo $id; ?>" data-toggle="modal" data-target="#centerCustosModal">
	      		<input type="hidden" value="<?php echo $name; ?>">
	      		<i class="fa fa-pencil-alt"></i>
	      	</button>
	      </td>
	    </tr>
	    <?php } ?>
	  </tbody>
	</table>
</div>
