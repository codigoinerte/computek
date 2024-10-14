<?php
include "clases/class.registros.php";
$datos_reg_home = new registros_home();

#OBTENER ALIAS DE LA URL
$_alias = isset($_GET["alias"])?$_GET["alias"]:'';
$_pag = isset($_GET["pag"])?$_GET["pag"]:1;
$_var = isset($_GET["var"])?$_GET["var"]:'';
$id_registro=0;

$registros_home=array();
$datos_registro= array();
$datos_registro_videos=array();
$datos_registro_revistas=array();
$datos_registro_galeria=array();

$paginas = explode("/",$_SERVER['PHP_SELF']);		 	
$alias_archivo = end($paginas);

if($_alias!='')
{
	$datos_alias = $datos_reg_home->identificador($_alias);
	if(count($datos_alias)>0)
	{
		$id_registro = isset($datos_alias[0]["id_registro"])?$datos_alias[0]["id_registro"]:0;				
		
		$alias_archivo = isset($datos_alias[0]["pagina"])?$datos_alias[0]["pagina"]:'';
		$idtipo_archivo = isset($datos_alias[0]["idtipo"])?$datos_alias[0]["idtipo"]:'';
		
		if($id_registro > 0)
		{
			#titulo,alias,resumen,descripcion
			$datos_registro = $datos_reg_home->detalle_registro($id_registro);	
			#print_r($datos_registro);
			#LISTAR VIDEOS 
			$datos_registro_videos = $datos_reg_home->listar_registro_relacionados($id_registro,2);
			#LISTAR REVISTAS
			$datos_registro_revistas = $datos_reg_home->listar_registro_relacionados($id_registro,3);
			#LISTAR GALERIA
			$datos_registro_galeria = $datos_reg_home->listar_registro_relacionados($id_registro,4);
		}
		
	}
	else
	{
		$alias_archivo = '';
	}
}

?>