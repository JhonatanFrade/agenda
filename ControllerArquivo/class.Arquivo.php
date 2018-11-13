<?php
   // Leonardo desenvolveu está classe.
    class Arquivo
    {
        private $dir;
    	private $filename;
        private $file;

    	public function Arquivo(){
            $this->filename = 'log.txt';
            $this->dir = 'C:/xampp/htdocs/ULBRA/web2/agenda/';

    	}

        public function fecharArquivo(){
            $this->escreverNoArquivo(PHP_EOL);
            fclose($this->file);
        }

        public function abrirArquivo($mode){
            switch ($mode) {
                case 'a+':
                    $this->file = fopen($this->dir . $this->filename, 'a+');
                    break;
                
                default:
                    echo 'incorreto';
                    break;
            }
            
        }

        public function escreverNoArquivo($msg){
            fwrite($this->file, $msg);
        }

        public function existeArquivo(){
            if (file_exists($this->dir . $this->filename)) {
               return true;
            } else {
                return false;
            }
        }
        
    }
?>