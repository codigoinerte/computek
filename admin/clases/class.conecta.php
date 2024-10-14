<?php
class conecta
{
	public function conectar()
	{
		#$root = "../clases";
		#$root = define('PATH', dirname(__FILE__));
		
		#$root = dirname(__DIR__, 1);
		#$root = substr($_SERVER['SCRIPT_FILENAME'], 0, -strlen($_SERVER['PHP_SELF']))."/";		
		#echo "../funciones/conecta.php";
		
		include URL_ROOT."admin/funciones/conecta.php";
		#exit();
		$conn = NULL;
		try
		{	
            $conn = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", "$dbusername", "$dbuserpass");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  		    return $this->in = $conn; 
        }
		catch(PDOException $e)
		{
            return 'ERROR: ' . $e->getMessage();
        }    
       
	}
	public function executeQuery($consulta,$array=array())
	{
		$query = $this->in->prepare($consulta);
		if(count($array)>0)
		{
			$query->execute($array);
		}
		else
		{
			$query->execute();
		}
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}
    public function updateQuery($consulta,$array=array())
    {	
		$result = $this->in->prepare($consulta);
        if(count($array) > 0)
		{
			$res = ($result->execute($array))?1:0;
		}
		else
		{
			$res = ($result->execute())?1:0;	
		}	
    }	
}
?>