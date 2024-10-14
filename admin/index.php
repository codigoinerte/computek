<?php
include("header.php");
$modulo = isset($_GET["modulo"])?$_GET["modulo"]:'';
$option = isset($_GET["option"])?$_GET["option"]:'';

$_ruta = URL_ROOT_ADMIN."modulos/$modulo/$option.php";
if(count($array_usuario_acceso) > 0)
{
	include ("funciones/constantes.php");
	include("includes/home.header.php");
	if(file_exists($_ruta) && $modulo!='' && $option!='')
	{		
		include(URL_ROOT_ADMIN."modulos/$modulo/$option.php");
	}
	else
	{	
		include("includes/inicio.php");
	#	echo "<br>";
	#	echo "<br>";
	#	echo "<br>";
	#	echo "<br>";
	#	echo "<br>";
	#	echo "<br>";
	#	echo "ESTA SECCION ESTA BAJO REPARACION";
	}
	include("footer.php");
}
else
{
	#header("location:".URL_WEB_ADMIN);
	include("includes/acceso.php");
}

?>