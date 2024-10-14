<?php
include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."funciones/funciones.php";
include URL_ROOT_ADMIN."modulos/$get_modulo/clases/class.registro.producto.estado.php";
$datos_estado_producto = new producto_estado();

$_item_estado = isset($_POST["estado"])?$_POST["estado"]:'';

$url_retorno="";
switch ($get_action) {
    case 'new':    	
		
		$array_id = $datos_estado_producto->insertar_estado_producto($_item_estado);
		$ID = isset($array_id[0]["id"])?$array_id[0]["id"]:'';			
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$ID&action=edit&msg=1";
		
    break;
    case 'edit':
		
		$datos_estado_producto->actualizar_estado_producto($get_id, $_item_estado);	
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$get_id&action=edit&msg=1";
		
    break;
    case 'delete':
    	
		$datos_estado_producto->eliminar_estado_producto($cod_eli_confirm);
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&msg=2";
    break;	
		
}
if($url_retorno!='')
{
	header("Location: $url_retorno");
}
?>