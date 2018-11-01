<?php
   // Jonhatan desenvolveu está classe.
    class Movimentacao
    {
        private $id;
    	private $id_centro_custos;
        private $id_conta;
        private $tipo_mov;
        private $data;
        private $descricao;
         private $valor;

    	public function  Movimentacao()
    	{
      
    	}

        public function setId($id)
        {
            $this->id=$id;
        }

        public function getId()
        {
            return $this->id;
        }

    	public function setId_centro_custos($id_centro_custos)
    	{
    		$this->$id_centro_custos=$$id_centro_custos;
    	}

    	public function getId_centro_custos()
    	{
    		return $this->$id_centro_custos;
    	}

        public function setId_conta($id_conta)
        {
            $this->id_conta=$id_conta;
        }

        public function getId_conta()
        {
            return $this->$id_conta;
        }

        public function setTipo_mov($tipo_mov)
        {
            $this->tipo_mov=$tipo_mov;
        }

        public function getTipo_mov()
        {
            return $this->$tipo_mov;
        }

        public function setData($data)
        {
            $this->data=$data;
        }

        public function getData()
        {
            return $this->$data;
        }

        public function setDescricao($descricao)
        {
            $this->descricao=$descricao;
        }

        public function getDescricao()
        {
            return $this->$descricao;
        }

        public function setValor($valor)
        {
            $this->valor=$valor;
        }

        public function getValor()
        {
            return $this->$valor;
        }
    }
?>