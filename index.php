<?php
	if(!file_exists("inicio.php"))
	{
		include ("copyright.php");
		die('');
	}
	
	require "admin/funciones/conecta.general.php";	
	include "admin/funciones/constantes.php";
	include "librerias/mod_seo/clases/class.seo.php";
	include "librerias/mod_registros/mod.config.registro.php";
	include "librerias/mod_registros/panel.funciones.php";

	if ( !is_bot($_SERVER['HTTP_USER_AGENT']) ) { insertar_estadisticas($id_registro); }	
	/*Compresion web via gzip - si existe*/
	#if (substr_count($_SERVER["HTTP_ACCEPT_ENCODING"], 'gzip')) ob_start('ob_gzhandler');
	ob_start("sanitizeOutput");
	#
	$array_reservado = array("registrar","carrito","ingresar","activacion","libro-de-reclamaciones","contactenos","promociones", "oficina", "gamer", "empresarial", "compras");
	$version = "0.0.2";
	if($_alias =='carrito' && $id_session_empresa_iniciada==0)
	{
		header('location: '.URL_WEB.'registrar');
	}

	$id_productos_cantidad=0;
	if(isset($_SESSION["carrito"]))
	{
		if(count($_SESSION["carrito"]) > 0)
		{
			foreach($_SESSION["carrito"] as $item_carrito)
			{
				$id_productos_cantidad+=$item_carrito["cantidad"];		
			}
		}
	}
	#print_r($_SESSION[0]['empresa']);

include("header.php");

if($alias_archivo != "index.php" && !in_array($_alias, $array_reservado))
{
	if(file_exists($alias_archivo))
	{
		include ("$alias_archivo");
	}
	else
	{
		include ("404.php"); //No encontrado
	}
}
else
{
	if(in_array($_alias, $array_reservado))
	{
		if($_alias == "registrar" && isset($_SESSION['empresa'])){ $_alias = "inicio"; }
		include($_alias.".php");	
		
	}
	else 
	{
		include ("inicio.php");
	}
}

#ob_end_flush();

include("footer.php"); 
?>