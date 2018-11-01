<?php

class DbAdmin
{
	private $conn;
	private $tipo;

	public function DbAdmin($tipo)
	{
		$this->tipo=$tipo;
	}

	public function connect($host,$user,$pass,$base)
	{
		switch ($this->tipo) 
		{
			case 'mysql':
			    $this->conn = mysql_connect($host,$user,$pass) or die (mysql_error());
			    mysql_select_db($base,$this->conn) or die (mysql_error());
			break;

			default:
				# code...
				break;
		}
	}

	public function query($sql)
	{
		switch ($this->tipo)
		 {
			case 'mysql':
			    $res = mysql_query($sql,$this->conn) or die (mysql_error());
				break;
			
			default:
				# code...
				break;
		}
		return $res;
	}

	public function rows($res)
	{
	
		switch($this->tipo){
			
			case 'mysql':
				
				$num = mysql_num_rows($res);
			
			break;

			default:
				# code...
				break;
			
		}
		
		return $num;
		
	}

	public function result ($res, $lin, $col)
	{
		switch($this->tipo){
			
			case 'mysql':
				
				$val = mysql_result($res, $lin, $col);
			
			break;
			
			default:
				# code...
				break;
			
		}
		
		return $val;
	}

}

?>