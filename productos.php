<?php

include "librerias/mod_registros/breadcrumb.php";

$enlaces_excluidos = [
	"computadoras",
	"combos",
	"pc-completas",
];

$isExclude = in_array($_alias, $enlaces_excluidos);

if($idtipo_archivo==1)
{
	if($isExclude){
		include "librerias/mod_registros/productos/listado.producto.subcategoria.complete.php";	
	}else{
		$cantidad_subcatgoria = $datos_reg_home->contar_registro_relacionados($id_registro, 2);
		#CATEGORIA
		if(count($cantidad_subcatgoria) > 0)
		{
			include "librerias/mod_registros/productos/listado.producto.subcategoria.php";
		}
		else
		{
			include "librerias/mod_registros/productos/listado.producto.php";	
		}
	}
}

else if($idtipo_archivo==2)
{

   include "librerias/mod_registros/productos/listado.producto.php";	

}

else if($idtipo_archivo==3)

{

	#REGISTRO

	include "librerias/mod_registros/productos/producto.php";

}

	

?>



