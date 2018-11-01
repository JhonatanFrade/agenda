<?php 

  //Responsável: Jhonatan Frade

	// echo 'Credito';

?>

<h1 style="color: white;">Crédito</h1>

<br style="margin-top: 25px;">

<div class="dropdown col-md-2">
	<label for="exampleInputEmail1">Carteira</label>
	<select class="form-control">
		<option></option>
		<option>Carteira 1</option>
		<option>Carteira 2</option>
	</select>
</div>

<form style="margin-top: 30px;">
  <div class="form-group col-md-6">
    <label for="exampleInputEmail1">Descrição</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Apenas texto">
    <small id="emailHelp" class="form-text text-muted">informe a descrição do crédito.</small>
  </div>

  <div class="form-group col-md-2">
    <label for="exampleInputPassword1">Valor</label>
    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Valor">
  </div>

	<div class="form-group col-md-4">
	<label >Data</label>
	<input type="date" name="bday" max="3000-12-31" 
	    min="1000-01-01" class="form-control">
	</div>

  <div class="form-group col-md-6">
  	<button type="submit" class="btn btn-primary">Adicionar</button>
  </div>
</form>

<br style="margin-top: 35px;">

<ul class="list-group col-md-6" style="color: black;">
  <li class="list-group-item disabled">Listagem</li>
  <li class="list-group-item">
  	18/10 - Salário
  </li>
  <li class="list-group-item">
  	15/10 - Bonificação
  </li>
  <li class="list-group-item">
  	14/10 - Investimento
  </li>
  <li class="list-group-item">
  	10/10 - Investimento
  </li>
</ul>