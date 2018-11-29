<?php
   // Jhonatan desenvolveu essa classe.
    class Extrato
    {
        private $id;
    	private $data;
        private $centro_custo;
        private $tipo_mov;
        private $valor;

    	public function Extrato()
    	{
      
    	}

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getId()
        {
            return $this->id;
        }

    	public function setData($data)
    	{
    		$this->data = $data;
    	}

    	public function getData()
    	{
    		return $this->data;
    	}

        public function setCentroDecusto($centro_custo)
        {
            $this->centro_custo = $centro_custo;
        }

        public function getCentroDecusto()
        {
            return $this->centro_custo;
        }

        public function setTipoMov($tipo_mov)
        {
            $this->tipo_mov = $tipo_mov;
        }

        public function getTipoMov()
        {
            return $this->tipo_mov;
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