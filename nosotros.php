<?php

include "librerias/mod_registros/breadcrumb.php";
if($idtipo_archivo==1)
{
	#CATEGORIA
	include "librerias/mod_registros/articulos/listado.articulo.categoria.php";
}
else if($idtipo_archivo==2)
{
	#SUBCATEGORIA
	include "librerias/mod_registros/articulos/listado.articulo.subcategoria.php";
}
else if($idtipo_archivo==3)
{
	#REGISTRO
	include "librerias/mod_registros/articulos/articulo.php";
}
	
?>

