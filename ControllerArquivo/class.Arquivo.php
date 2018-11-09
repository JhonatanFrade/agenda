<?php
   // Leonardo desenvolveu está classe.
    class Arquivo
    {
        private $dir;
    	private $filename;

    	public function Arquivo(){
            $this->filename = 'log.txt';

            if (file_exists($filename)) {
                echo "O arquivo $filename existe";
            } else {
                echo "O arquivo $filename não existe";
            }

    	}

        public function setFilename($filename)
        {
            $this->filename = $filename;
        }

        public function getFilename()
        {
            return $this->filename;
        }

    	public function setNome($nome)
    	{
    		$this->nome = $nome;
    	}

    	public function getNome()
    	{
    		return $this->nome;
    	}
    }
?>