<!-- Responsável Leonardo de Oliveira Meirelles -->

<?php 

	require_once("Item/class.Item.php");
	require_once("Item/class.ItemDAO.php");

	$dao = new ItemDAO();

?>

<h1 style="color: white;">Item</h1>

<div class="float-md-right" style="margin-right: 25px;">
	<label>NOVO</label>
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#itemModal"><i class="fa fa-plus-circle"></i></button>
</div>
<br><br><br>
 
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formItem" action="php/acao.item.php?action=insert" method="POST">
      	<div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Descrição</label>
            <input type="text" name="descricao" class="form-control">
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

<div id="tableItem" class="form-group col-md-12">
	<table class="table table-striped" >
	  <thead>
	    <tr>
	      <th scope="col">Descricao</th>
	      <th scope="col">Data criação</th>
	      <th scope="col">Última alteração</th>
	      <th scope="col" colspan="2">Ações</th>
	    </tr>
	  </thead>
	  <tbody>
	  	 <?php 
		  	$item = $dao->listar();
			foreach ($item as $key => $obj) {
				$id = $obj->getId();
				$descricao = $obj->getDescricao();
				$date_c = $obj->getDateCreate();
				$date_u = $obj->getDateUpdate();
		  ?>
	    <tr>
	      <td><?php echo $descricao; ?></td>
	      <td><?php echo $date_c; ?></td>
	      <td><?php echo $date_u; ?></td>
	      <td>
	      	<button type="button" id="<?php echo $id; ?>" data-toggle="modal" data-target="#itemModal">
	      		<input type="hidden" value="<?php echo $descricao; ?>">
	      		<i class="fa fa-pencil-alt"></i>
	      	</button>
	      	<button style="margin-left: 20px;" onclick="location.href='php/acao.item.php?action=delete&id=<?php echo $id; ?>'">
	      		<i class="fa fa-trash"></i>
	      	</button>
		  </td>
	    </tr>
	    <?php } ?>
	  </tbody>
	</table>
</div>