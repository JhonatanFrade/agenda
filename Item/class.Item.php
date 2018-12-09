<?php
   // Dia 10/10/2018 Jonhatan desenvolveu está classe.
    class Item
    {
        private $id;
    	private $descricao;
        private $date_create;
        private $date_update;

    	public function Item()
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

    	public function setDescricao($descricao)
    	{
    		$this->descricao = $descricao;
    	}

    	public function getDescricao()
    	{
    		return $this->descricao;
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
