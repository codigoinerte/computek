<?php
include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."modulos/mod_config/clases/class.config.usuarios.php";
include URL_ROOT_ADMIN."modulos/$get_modulo/clases/class.config.mail.php";

$datos_usuario = new config_usuarios();
$datos_mail = new config_mail();

$atencion = isset($_POST["atencion"])?$_POST["atencion"]:2;
$idpersonal = isset($_POST["idpersonal"])?$_POST["idpersonal"]:'';
$cod_eli_confirm = isset($_GET["cod_eli_confirm"])?$_GET["cod_eli_confirm"]:'';

$url_retorno="";
switch ($get_action) {   
    case 'edit':
		$idusuario='';
		if($idpersonal!='')
		{
			$array =  $datos_usuario->listar_usuarioxpersonal($idpersonal);
			$idusuario = isset($array[0]["id"])?$array[0]["id"]:'';
		}
			
		$datos_mail->actualizar_mail($get_id, $atencion,$idusuario);
		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$get_id&action=$get_action&msg=1";		
    break;
}
if($url_retorno!='')
{
	header("Location: $url_retorno");
}
?>