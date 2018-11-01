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

    <title>Matriz</title>
  </head>
  <body>

  	<?php 

  		// Exibir mensagem
		if(isset($_GET['msg'])){
			if($_GET['msg'] == 1){
			?>
			<div class="alert alert-success alert-dismissible fade show my-content" role="alert">
			  <strong>Inserido com sucesso!</strong>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<?php
			}elseif($_GET['msg'] == 2){
			?>
			<div class="alert alert-danger alert-dismissible fade show my-content" role="alert">
			  <strong>Deletado com sucesso!</strong>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<?php
			}elseif($_GET['msg'] == 3){
			?>
			<div class="alert alert-info alert-dismissible fade show my-content" role="alert">
			  <strong>Editado com sucesso!</strong>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<?php
			}
		}

  	?>
  	
	<div>
	    <aside class="main_sidebar">

	        <ul>
	        	<h1 style="color: white;">App</h1>
	            <li>
	            	<a href="index.php?pag=home">
	            		<i class="fa fa-home"></i>Home
	            	</a>
	            </li>

	            <li>
	            	<a href="index.php?pag=carteira">
	            		<i class="fa fa-wallet"></i>Nova carteira
	            	</a>
	            </li>

	            <li>
	            	<a href="index.php?pag=centro_custos">
	            		<i class="fa fa-edit"></i>Novo centro de custo
	            	</a>
	            </li>

	            <li><i class="fa fa-info"></i>
	            	<a href="index.php?pag=item">Item</a>
	            </li>

		        <li>
		        	<i class="fa fa-hand-holding-usd"></i>
		        	<a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false">
		        		Movimentação
		        	</a>
					<ul class="nav collapse" id="submenu1" role="menu" aria-labelledby="btn-1">
						<li style="width: 100%">
							<a href="index.php?pag=credito">
								<i class="fa fa-plus-circle"></i>Credito
							</a>
						</li>
						<li style="width: 100%">
							<a href="index.php?pag=debito">
								<i class="fa fa-minus-circle"></i>Debito
							</a>
						</li>
						<li style="width: 100%">
							<a href="index.php?pag=recorrentes">
								<i class="fa fa-asterisk"></i>Recorrentes
							</a>
						</li>
						<li style="width: 100%">
							<a href="index.php?pag=parcelas">
								<i class="fa fa-table"></i>Parcelas
							</a>
						</li>
					</ul>
				</li>

	            <li><i class="fa fa-chart-bar"></i>
	            	<a href="index.php?pag=relatorio">Relatórios</a>
	            </li>
	        </ul>
	    </aside>
	</div>

	<div class="my-style">
	<?php	

		if( isset($_GET['pag']) and !empty($_GET['pag'])){
			$pag = $_GET['pag'];
		}else{
			$pag = 'home';
		}

		include_once('pages/exe.'.$pag.'.php');

 	?>
 	</div>

 	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/popper.js/dist/popper.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
	<script src="funcoes.js"></script>

	<!-- Optional JavaScript via CDN -->
	<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
	
  </body>
</html>