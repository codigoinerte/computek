<?php
include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."funciones/funciones.php";
include URL_ROOT_ADMIN."modulos/$get_modulo/clases/class.$get_option.php";
$datos_config_global = new config_global();

$_array = isset($_POST["imagenes"])?$_POST["imagenes"]:array();

$url_retorno="";
switch ($get_action) {
   case 'edit':
		
		if(count($_array) >0)
		{
			foreach($_array as $item)
			{
				$item_idtipo = isset($item["idtipo"])?$item["idtipo"]:0;
				$item_alto = isset($item["alto"])?$item["alto"]:0;
				$item_ancho = isset($item["ancho"])?$item["ancho"]:0;
				$item_calidad = isset($item["calidad"])?$item["calidad"]:0;
				$item_cuadrado = isset($item["cuadrado"])?$item["cuadrado"]:0;
				$item_ratio = isset($item["ratio"])?$item["ratio"]:0;
								
				$detallextipo = $datos_config_global->config_listado_imagenes($item_idtipo);
				if(count($detallextipo) == 0)
				{
					$datos_config_global->config_insertar_imagenes($item_idtipo, $item_alto, $item_ancho, $item_calidad, $item_cuadrado, $item_ratio);
				}
				else
				{
					$datos_config_global->config_actualizar_imagenes($item_idtipo, $item_alto, $item_ancho, $item_calidad, $item_cuadrado, $item_ratio);
				}
				
			}
		}
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&msg=1";		
    break;
    case 'delete':
    	
		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&msg=2";
    break;	
		
}
if($url_retorno!='')
{
	header("Location: $url_retorno");
}
?>