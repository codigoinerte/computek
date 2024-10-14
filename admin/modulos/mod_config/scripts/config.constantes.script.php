<?php
include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."funciones/funciones.php";
include URL_ROOT_ADMIN."modulos/$get_modulo/clases/class.config.constantes.php";
$datos_config_constantes = new config_constantes();

$_item_nombre = isset($_POST["nombre"])?$_POST["nombre"]:'';
$_item_comentario = isset($_POST["comentario"])?$_POST["comentario"]:'';
$_item_constante = isset($_POST["constante"])?$_POST["constante"]:'';
$_item_valor = isset($_POST["valor"])?$_POST["valor"]:'';

$url_retorno="";
switch ($get_action) {
    case 'new':    	
		
		$array_id = $datos_config_constantes->insertar_constante($_item_nombre, $_item_comentario, $_item_constante, $_item_valor);
		$ID = isset($array_id[0]["id"])?$array_id[0]["id"]:'';			
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$ID&action=edit&msg=1";
		
    break;
    case 'edit':
		
		$datos_config_constantes->actualizar_constante($get_id, $_item_nombre, $_item_comentario, $_item_constante, $_item_valor);	
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$get_id&action=edit&msg=1";
		
    break;	
		
}
if($url_retorno!='')
{
	header("Location: $url_retorno");
}
?>