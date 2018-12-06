<?php
   // Jonhatan desenvolveu está classe.

   // Dia 05/12/2018 Leonardo corrigiu alguns erros.

    class Parcelas
    {
        private $id;
    	private $id_centro_custos;
        private $id_conta;
        private $id_item;
        private $tipo_mov;
        private $parcela;
        private $vencimento;
        private $valor;
        private $status_pagamento;

    	public function  Parcelas()
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
    		$this->id_centro_custos=$id_centro_custos;
    	}

    	public function getId_centro_custos()
    	{
    		return $this->id_centro_custos;
    	}

        //*****************************************

        public function setId_conta($id_conta)
        {
            $this->id_conta=$id_conta;
        }

        public function getId_conta()
        {
            return $this->id_conta;
        }


        public function setId_item($id_item)
        {
            $this->id_item=$id_item;
        }

        public function getId_item()
        {
            return $this->id_item;
        }

         public function setTipo_mov($tipo_mov)
        {
            $this->tipo_mov=$tipo_mov;
        }

        public function getTipo_mov()
        {
            return $this->tipo_mov;
        }
        
        public function setParcela($parcela)
        {
            $this->parcela=$parcela;
        }

        public function getParcela()
        {
            return $this->parcela;
        }

         
        public function setVencimento($vencimento)
        {
            $this->vencimento=$vencimento;
        }

        public function getVencimento()
        {
            return $this->vencimento;
        }

        public function setValor($valor)
        {
            $this->valor=$valor;
        }

        public function getValor()
        {
            return $this->valor;
        }

        public function setStatus_pagamento($status_pagamento)
        {
            $this->status_pagamento=$status_pagamento;
        }

        public function getStatus_pagamento()
        {
            return $this->status_pagamento;
        }

    }
?>
