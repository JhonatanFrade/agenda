<?php 
// Dia 06/12/2018  Leonardo alterou este arquivo.

  require_once("Contas/class.Contas.php");
  require_once("Contas/class.ContasDAO.php");

  $CarteirasDAO = new ContasDAO();

  require_once("Recorrentes/class.Recorrentes.php");
  require_once("Recorrentes/class.RecorrentesDAO.php");

  $RecorrentesDAO = new RecorrentesDAO();

  require_once("Movimentacao/class.Movimentacao.php");
  require_once("Movimentacao/class.MovimentacaoDAO.php");

  $MovimentacaoDAO = new MovimentacaoDAO();

  $total = "sem valor";

  if (isset($_GET['total']) and !empty($_GET['total']))
  {
  	$total = $_GET['total'];
  }

?>

	<style type="text/css">
		.camp{
			margin-bottom: 45px;
		}
	</style>

	<h1 style="color: white;">Home</h1>

	<br>
<form action="php/acao.home.php?action=insert" method="POST">
	<div class="dropdown col-md-4">
		<label>Carteira selecionada</label>
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

	<div class="camp form-group col-md-4">
		<label >Selecione o mês</label>
		<input type="month" name="bday" max="3000-12" min="2018-01" class="form-control">
	</div>

	
	<div class="form-group col-md-6">
	   <button type="submit" class="btn btn-primary">Filtrar</button>
	</div>
</form>

<br>

<div class="form-group col-md-2">
	<label>Saldo Disponivel</label>
	<input type="text" value="<?php echo $total ?>" class="form-control">
</div>

<div id="tableConta" class="form-group col-md-8">
	<label>Ultimas movimentações</label>
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col">Data</th>
	      <th scope="col">Tipo de Movimentacão</th> 
	      <th scope="col">Valor</th>
	    </tr>
	  </thead>
	  <tbody>
		  	<?php 

			   if (isset($_GET['conta']) and !empty($_GET['conta'])) 
	           {
		            $select_conta = $_GET['conta'];

		            $tipoDeListagem = 1;
		            $tipoList = new Movimentacao();
		            $tipoList ->setTipo_mov($tipoDeListagem);
		            $creditos = $MovimentacaoDAO->listar($tipoList);

		            foreach ($creditos as $key => $obj) 
		            {

			            $id = $obj->getId_conta();
			            $tipo = $obj->getTipo_mov();

			            if (($id == $select_conta) && ($tipo == $tipoDeListagem)) 
			            {
			              $data = $obj->getData();

			              $valor = $obj->getValor();
			              $id_credito = $obj->getId();

			             echo '<tr>';

		                       echo '<td>'.$data.'</td>';
		                       echo '<td>';
		                          echo "Credito";
		          	          echo '</td>';
		          	          echo '<td> R$ '. number_format($valor, 2, ',', '.').'</td>';
		          	      echo '</tr>';
		          	    }
		          	}

		          	$tipoDeListagem = 2;
		            $tipoList = new Movimentacao();
		            $tipoList ->setTipo_mov($tipoDeListagem);
		            $debitos = $MovimentacaoDAO->listar($tipoList);

		            foreach ($debitos as $key => $obj) 
		            {
			            $id = $obj->getId_conta();
			            $tipo = $obj->getTipo_mov();

			            if (($id == $select_conta) && ($tipo == $tipoDeListagem)) 
			            {
			              $data = $obj->getData();

			              $valor = $obj->getValor();
			              $id_credito = $obj->getId();

			              echo '<tr>';

		                        echo '<td>'.$data.'</td>';
		                        echo '<td>';
		          	            echo "Debito";
		          	          echo '</td>';
		          	          echo '<td> R$ '. number_format($valor, 2, ',', '.').'</td>';
		          	       echo '</tr>';
		          	    }  
		          	}
		        }

		        else
		        {
		            echo '<td> "Sem registro!"</td>';
		        }
		    ?>
      </tbody>
    </table>
</div>
