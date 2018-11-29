<?php
   // Leonardo desenvolveu está classe.
    class Relatorio
    {
        private $id;
    	private $nome_da_carteira;
        private $nome_do_centro_custo;
        private $total_valor;

    	public function Relatorio()
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

    	public function setNomeDaCarteira($nome_da_carteira)
    	{
    		$this->nome_da_carteira = $nome_da_carteira;
    	}

    	public function getNomeDaCarteira()
    	{
    		return $this->nome_da_carteira;
    	}

        public function setNomeDoCentroDecusto($nome_do_centro_custo)
        {
            $this->nome_do_centro_custo = $nome_do_centro_custo;
        }

        public function getNomeDoCentroDecusto()
        {
            return $this->nome_do_centro_custo;
        }

        public function setValorTotal($total_valor)
        {
            $this->total_valor = $total_valor;
        }

        public function getValorTotal()
        {
            return $this->total_valor;
        }
    }
?>