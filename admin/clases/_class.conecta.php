<?php

class conecta extends mysqli
{
    public function __construct()
    {
		include_once("includes/conecta.php");
        parent::__construct($dbhost,$dbusername,$dbuserpass,$dbname);
        $this->query("SET NAMES 'utf8';");
        $this->connect_errno ? die('ERROR CON LA CONEXION'):$x='Conectado';
        echo $x;
        #unset($x);
    }
	
	public function conectar()
	{
		/*
		mysql:conexion utilizando mysql
		include_once("includes/conecta.php");
        parent::__construct($dbhost,$dbusername,$dbuserpass,$dbname);
        $this->query("SET NAMES 'utf8';");
        $this->connect_errno ? die('ERROR CON LA CONEXION'):$x='Conectado';
        echo $x;
        #unset($x);
		*/
		
		/* Conectar a una base de datos de MySQL invocando al controlador */
		
	}
	public function executeQuery($consulta,$array)
	{
		
	}
    public function recorrer($y)
    {
        return mysqli_fetch_array($y);
    }
    public function rows($y)
    {
        return mysqli_num_rows($y);
    }


	public function where($query,$array)
	{	
	 	if(count($array) > 0)
		{	$cadena=array();
			
			for($v=0;$v<count($array);$v++)
			{
				array_push($cadena, mysql_real_escape_string(stripslashes($array[$v])));
			}
			
			$query = vsprintf(str_replace("?", "%s", $query), $cadena);
			return $query;
		}
	}
	
}
/*
	public function where($query,$array)
	{	
	 	if(count($array) > 0)
		{	$cadena=array();
			
			for($v=0;$v<count($array);$v++)
			{
				array_push($cadena, mysql_real_escape_string(stripslashes($array[$v])));
			}
			
			$query = vsprintf(str_replace("?", "%s", $query), $cadena);
			return $query;
		}
	}

*/
?>