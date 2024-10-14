<?php
include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."funciones/constantes.php";
include URL_ROOT_ADMIN."modulos/$get_modulo/clases/class.com.pagina.php";
$datos_pagina = new pagina();
$ID = isset($_POST["ID"])?$_POST["ID"]:0;
$nombre = isset($_POST["nombre"])?$_POST["nombre"]:'';
$pagina = isset($_POST["pagina"])?$_POST["pagina"]:'';

$url_retorno="";
switch ($get_action) {
    case 'new':    
			
		$array_pagina = $datos_pagina->insertar_pagina($nombre, $pagina);
		$ID = $array_pagina[0]["id"];
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$ID&action=$get_action&msg=1";
		
    break;
    case 'edit':
    	$datos_pagina->actualizar_pagina($ID, $nombre, $pagina);
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$get_id&action=$get_action&msg=1";
		
    break;
    case 'delete':
    	$datos_pagina->eliminar_pagina($cod_eli_confirm);
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&msg=2";
    break;
}
if($url_retorno!='')
{
	header("Location: $url_retorno");
}
?>