<?php
   // Leonardo desenvolveu está classe.
    class Contas
    {
        private $id;
    	private $nome;
        private $date_create;
        private $date_update;

    	public function Contas()
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

    	public function setNome($nome)
    	{
    		$this->nome = $nome;
    	}

    	public function getNome()
    	{
    		return $this->nome;
    	}

        public function setDateCreate($date_create)
        {
            $this->date_create = $date_create;
        }

        public function getDateCreate()
        {
            return $this->date_create;
        }

        public function setDateUpdate($date_update)
        {
            $this->date_update = $date_update;
        }

        public function getDateUpdate()
        {
            return $this->date_update;
        }
    }
?>