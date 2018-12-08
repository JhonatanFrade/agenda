<?php
   // Dia 10/10/2018 Jonhatan desenvolveu está classe.
    class RecorrentesMovimentacao
    {
        private $id;
        private $id_recorrentes;
    	private $id_movimentacao;
       
    	public function  RecorrentesMovimentacao()
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
        public function setId_Recorrentes($id_recorrentes)
        {
            $this->$id_recorrentes=$id_recorrentes;
        }

        public function getId_Recorrentes()
        {
            return $this->$id_recorrentes
        }

        public function setId_Movimentacao($id_Movimentacao)
        {
            $this->id=$id_Movimentacao;
        }

        public function getId_Movimentacao()
        {
            return $this->$id_Movimentacao;
        }
    }
?>
