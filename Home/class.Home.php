<?php
   // Dia 06/12/2018  Leonardo desenvolveu está classe 
class Home
{
    private $id_registro;
	private $id_conta; 
	private $tipo_mov; 
	private $valor;
	private $data;
    

    public function Home()
    {
      
    }

    //--------------------------------------------------------------
    public function setId_registro($id_registro)
    {
        $this->id_registro = $id_registro;
    }

    public function getId_registro()
    {
        return $this->id_registro;
    }
    //--------------------------------------------------------------

    
    //--------------------------------------------------------------
    public function setId_conta($id_conta)
    {
        $this->id_conta = $id_conta;
    }

    public function getId_conta()
    {
        return $this->id_conta;
    }
    //--------------------------------------------------------------
    

    public function setTipo_mov($tipo_mov)
    {
        $this->tipo_mov = $tipo_mov;
    }

    public function getTipo_mov()
    {
        return $this->tipo_mov;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getValor()
    {
        return $this->valor;
    }
}
?>
