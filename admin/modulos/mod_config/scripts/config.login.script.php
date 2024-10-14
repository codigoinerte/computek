<?php
include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/general.php";
include URL_ROOT_ADMIN."modulos/mod_config/clases/class.config.usuarios.php";

$datos_usuario = new config_usuarios();
$get_action=isset($_REQUEST["action"])?$_REQUEST["action"]:'';
$usuario = isset($_POST["usuario"])?$_POST["usuario"]:'';
$password = isset($_POST["password"])?$_POST["password"]:'';
$correo= isset($_POST["correo"])?$_POST["correo"]:'';
	
$url_retorno="";
switch ($get_action)
{
    case 'acceso': 	
		
	if($usuario!='' && $password!='')
	{
		$array_datos_usuario = $datos_usuario->verificar_usuario($usuario);
		if(count($array_datos_usuario) > 0)
		{
			$_user_pass = isset($array_datos_usuario[0]["pass"])?$array_datos_usuario[0]["pass"]:'';
			$_idusuario = isset($array_datos_usuario[0]["id"])?$array_datos_usuario[0]["id"]:0;
			$_idempresa = isset($array_datos_usuario[0]["idempresa"])?$array_datos_usuario[0]["idempresa"]:0;			
			$_nombre = isset($array_datos_usuario[0]["nombre_usuario"])?$array_datos_usuario[0]["nombre_usuario"]:'';
			
			if(password_verify($password, $_user_pass))
			{
				
				$key =md5(uniqid(mt_rand(), true));
				$iphost = ExtractUserIpAddress();
				$_SESSION["acceso"]=
					array(
							'userAgent'=>$_SERVER['HTTP_USER_AGENT'],
							'sKey'=>$key,
							'IPaddress'=>$iphost,
							'LastActivity'=>$_SERVER['REQUEST_TIME'],
							'usuario'=>
										array
										(
											'idusuario'=>$_idusuario,
											'idempresa'=>$_idempresa,
											'nombre_usuario'=>$_nombre
										)
						);
				$datos_definition->actualizar_estado_sesion($_idusuario, 1);	
			 	$url_retorno=URL_WEB_ADMIN."?token=$key";
			}
			else
			{
				$url_retorno=URL_WEB."admin?result=2";			
			}
		}
		else
		{
			$url_retorno=URL_WEB."admin?result=3";	
		}
	}
	else
	{
		$url_retorno=URL_WEB."admin?result=4";	
	}	
		
	break;
	case 'logout':
		#$datos_definition->actualizar_estado_sesion($SisID, 0);	
		session_unset();
		session_destroy();
		#session_start();
		#session_regenerate_id(true);
		$url_retorno=URL_WEB_ADMIN;	
	break;	
	case 'recuperar': 
		
		$listado_contacto = $datos_usuario->verificar_recuperacion($usuario, $correo);
		if(count($listado_contacto) > 0)
		{
			$new_password = get_random_string(6);
			$password = crypt_clave($new_password,7);
			$idusuario = isset($listado_contacto[0]["idusuario"])?$listado_contacto[0]["idusuario"]:0;			
			$nombre_usuario = isset($listado_contacto[0]["nombre_usuario"])?$listado_contacto[0]["nombre_usuario"]:0;			
			$datos_usuario->actualizar_password($idusuario,$password);
			
			///////////////////////////////////////////////
			/// ENVIAR  A USUARIO MENSAJE DEL ADMINISTRADOR
			////////////////////////////////////////////// 
			$sender_subject = "Recuperar password.";
			$tpl2 = new TemplatePower(URL_ROOT_ADMIN."template/contacto_usuario_password.tpl" );
			$tpl2->prepare();
			$tpl2->assign("password", $new_password);
			$tpl2->assign("name", $nombre_usuario);
			$tpl2->assign("tienda", NOMBRE_TIENDA);
			$tpl2->assign("slogan", SLOGAN);
			$tpl2->assign("admin", ADMINISTRADOR);		
			$tpl2->assign("info", INFO);				
			$tpl2->assign("footer", FOOTER_CORREO);		

			$respuesta = enviar_correo_web(ADMINISTRADOR, CORREO_ADMIN, $sender_name, $correo, $sender_subject, $tpl2->getOutputContent(), $image);
			$url_retorno=URL_WEB."admin?result=5";	
		}
		else
		{
			$url_retorno=URL_WEB."admin?result=6";	
		}
		
	break;	
}
if($url_retorno!='')
{
	header("Location: $url_retorno");
}