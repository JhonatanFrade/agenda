<?php
	require_once('C:/xampp/htdocs/ULBRA/web2/agenda/DbAdmin/class.DbAdmin.php');

	require_once("Relatorio/class.Relatorio.php");
	require_once("Relatorio/class.Extrato.php");

	// var_dump($_POST);
	// exit;

	$tipo_rel = $_POST['tipo_rel'];

	$dba = new DbAdmin('mysql');

	$dba->connect('localhost','root','','oc_agenda_web_2');

	switch ($tipo_rel) {

		//Tipo relatorio
		case '1':

			$id_conta = $_POST['id_conta'];
			$tipo_mov = $_POST['tipo_mov'];
			$bday = $_POST['bday'];

			$sql = 'SELECT m.id, c.nome as nome_da_carteira, cc.nome as nome_do_centro_custo, 
						sum(m.valor) as totalValor 
					FROM movimentacao as m
					INNER JOIN centro_custos as cc ON (m.id_centro_custos = cc.id)
					INNER JOIN contas as c ON (c.id = m.id_conta)
					WHERE m.tipo_mov = "' . $tipo_mov . '"' .
					' AND m.id_conta = "' . $id_conta . '"' .
					' AND DATE_FORMAT(m.data, "%Y-%m") = "' . $bday . '"' .
					' GROUP BY m.id_centro_custos';

			// echo $sql;
			// exit;

			$res = $dba->query($sql);

			$num = $dba->rows($res);

			$result = array();

			for ($i=0; $i < $num; $i++) { 
				$id = $dba->result($res, $i, 'id');
				$nome_da_carteira = $dba->result($res, $i, 'nome_da_carteira');
				$nome_do_centro_custo = $dba->result($res, $i, 'nome_do_centro_custo');
				$totalValor =  $dba->result($res, $i, 'totalValor');

				$relatorio = new Relatorio();

				$relatorio->setId($id);
				$relatorio->setNomeDaCarteira($nome_da_carteira);
				$relatorio->setNomeDoCentroDecusto($nome_do_centro_custo);
				$relatorio->setValorTotal($totalValor);

				$vet_relatorio[] = $relatorio;

			}

		break;

		//Tipo extrato
		case '2':

			$id_conta = $_POST['id_conta'];
			$tipo_mov = $_POST['tipo_mov'];
			$bday = $_POST['bday'];

			$sql = 'SELECT m.id, DATE_FORMAT(m.data, "%d-%m-%Y") as data_m, 
						cc.nome as centro_custo, m.valor
					FROM movimentacao as m
					INNER JOIN centro_custos as cc ON (m.id_centro_custos = cc.id)
					WHERE m.tipo_mov = "' . $tipo_mov . '"' .
					' AND m.id_conta = "' . $id_conta . '"' .
					' AND DATE_FORMAT(m.data, "%Y-%m") = "' . $bday . '"' .
					' ORDER BY m.id';

			// echo $sql;
			// exit;

			$res = $dba->query($sql);

			$num = $dba->rows($res);

			$result = array();

			for ($i=0; $i < $num; $i++) { 
				$id = $dba->result($res, $i, 'id');
				$data = $dba->result($res, $i, 'data_m');
				$centro_custo = $dba->result($res, $i, 'centro_custo');
				$valor =  $dba->result($res, $i, 'valor');

				$extrato = new Extrato();

				$extrato->setId($id);
				$extrato->setData($data);
				$extrato->setCentroDecusto($centro_custo);
				$extrato->setValor($valor);

				$vet_extrato[] = $extrato;

			}

		break;

		default:
			echo "Erro na condicao";
		break;
	}
?>
<!doctype html>
<html lang="pt">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome-free-5.3.1-web/css/all.css">

     <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

    <!-- Carregando as classes -->
    <link rel="stylesheet" href="estilos.css">

    <title>Relatorio</title>
  </head>
  <body>
		  
	<?php if(isset($vet_relatorio) && !empty($vet_relatorio)){ ?>

	<h1 style="color: white;">Relatório</h1>
	<div id="tableRelatorio" class="form-group col-md-12">
		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col">Nome da carteira</th>
		      <th scope="col">Nome do centro de custo</th>
		      <th scope="col">Total do valor</th>
		    </tr>
		  </thead>
		  	<tbody>
		  	 	<?php
				foreach ($vet_relatorio as $key => $obj) {
					$id = $obj->getId();
					$nome_da_carteira = $obj->getNomeDaCarteira();
					$nome_do_centro_custo = $obj->getNomeDoCentroDecusto();
					$total_valor = $obj->getValorTotal();
			  ?>
		    <tr>
		      <td><?php echo $nome_da_carteira; ?></td>
		      <td><?php echo $nome_do_centro_custo; ?></td>
		      <td><?php echo $total_valor; ?></td>
		    </tr>
		    <?php } ?>
		  </tbody>
		</table>
	</div>
	<?php } ?>
			
	

	<?php if(isset($vet_extrato) && !empty($vet_extrato)){ ?>

	<h1 style="color: white;">Extrato</h1>	
	<div id="tableExtrato" class="form-group col-md-12">
		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col">data</th>
		      <th scope="col">Centro de custo</th>
		      <th scope="col">Valor</th>
		    </tr>
		  </thead>
		  	<tbody>
		  	 	<?php
				foreach ($vet_extrato as $key => $obj) {
					$id = $obj->getId();
					$data = $obj->getData();
					$centro_custo = $obj->getCentroDecusto();
					$valor = $obj->getValor();
			  ?>
		    <tr>
		      <td><?php echo $data; ?></td>
		      <td><?php echo $centro_custo; ?></td>
		      <td><?php echo $valor; ?></td>
		    </tr>
		    <?php } ?>
		  </tbody>
		</table>
	</div>
	<?php } ?>
			
	<?php if(!isset($vet_extrato) && !isset($vet_relatorio)){ ?> 
		<div>
			<h1 style="color: white;">Sem dados!</h1>
		</div>
	<?php } ?>

 	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/popper.js/dist/popper.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
	<script src="funcoes.js"></script>
	<script src="jQuery-Mask-Plugin/jquery.mask.js"></script>

	<!-- Optional JavaScript via CDN -->
	<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
	
  </body>
</html>