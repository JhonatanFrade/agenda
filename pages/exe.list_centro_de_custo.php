<?php 

	

?>

<div class="form-group col-md-10 ">
    <label>Listagem de créditos</label>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Data</th>
          <th scope="col">Centro de Custo</th>
          <th scope="col">Valor</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <!-- <tbody id="listaConta"> -->
      <tbody>
        <?php 

          

          //$creditos = $MovimentacaoDAO->listar($tipoDeListagem);
          

          if (isset($_GET['conta']) and !empty($_GET['conta'])) 
          {

            $credito_selec = $_GET['conta'];

            $tipoDeListagem = 1;

            $tipoList = new Movimentacao();

            $tipoList ->setTipo_mov($tipoDeListagem);

            $creditos = $MovimentacaoDAO->listar($tipoList);

            //echo($creditos);
            //exit;

            /*
            print_r($creditos);
            
            */

            foreach ($creditos as $key => $obj) {

            $id = $obj->getId_conta();
            $tipo = $obj->getTipo_mov();

            if (($id == $credito_selec) && ($tipo == $tipoDeListagem)) 
            {
              $data = $obj->getData();
              $id_centro_custos = $obj->getId_centro_custos();
              $centro_custos = new CentroDeCustos();
              $centro_custos->setId($id_centro_custos);
              $centro_de_custos = $CentroDeCustosDAO->listarUmCentroDeCusto($centro_custos);
              foreach ($centro_de_custos as $k => $objeto) {
                $descricao_centro_custos = $objeto->getNome();
              }

              $valor = $obj->getValor();
              $id_credito = $obj->getId();
        ?>
        <tr>
          <td><?php echo $data;?></td>
          <td><?php echo $descricao_centro_custos;?></td>
          <td><?php echo 'R$' . number_format($valor, 2, ',', '.');?></td>
          <td>
            <a href="index.php?pag=credito.edit&id=<?php echo $id_credito; ?>">
              <i class="fa fa-pencil-alt"></i>
            </a>
            <a href="php/acao.credito.php?action=delete&id=<?php echo $id_credito; ?>">
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