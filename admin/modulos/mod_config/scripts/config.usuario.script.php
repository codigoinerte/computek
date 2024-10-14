<?php
include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."funciones/funciones.php";
include URL_ROOT_ADMIN."funciones/general.php";
include URL_ROOT_ADMIN."funciones/constantes.php";
include URL_ROOT_ADMIN."modulos/$get_modulo/clases/class.config.usuarios.php";
$datos_usuario= new config_usuarios();
$datos_general= new config_general();
$nombres = isset($_POST["nombre"])?$_POST["nombre"]:'';
$apellidos = isset($_POST["apellidos"])?$_POST["apellidos"]:'';
$fecha_nacimiento= isset($_POST["fecha_nacimiento"])?$_POST["fecha_nacimiento"]:'0000-00-00';
$info_contacto = isset($_POST["data"])?$_POST["data"]:array();
$correo = isset($_POST["correo"])?$_POST["correo"]:'';
$usuario = isset($_POST["usuario"])?$_POST["usuario"]:'';
$password = isset($_POST["password"])?$_POST["password"]:'';
$idestado = isset($_POST["estado"])?$_POST["estado"]:'';

$tipo_usuario = isset($_POST["tipo_usuario"])?$_POST["tipo_usuario"]:0;
$tipo_usuario = ($tipo_usuario=='')?0:$tipo_usuario;
$menu = isset($_POST["menu"])?$_POST["menu"]:array();

$array_files = isset($_FILES["imagenes"]) ? $_FILES["imagenes"] : array(); 
$cod_eli_confirm = isset($_GET["cod_eli_confirm"])?$_GET["cod_eli_confirm"]:'';

$ruta_destino = URL_ROOT."admin/images/";			
$ruta_ftp = URL_ROOT."admin/images/";
$allowedExts = array("gif", "jpeg", "jpg", "png");		
$url_retorno="";

$_SESSION['error_imagen'] = array();
$array_error=array();


switch ($get_action) {
    case 'new': 	
		$array_usuario = $datos_usuario->insertar_personal($SisERP, $nombres, $apellidos, $fecha_nacimiento, $correo, $idestado, $tipo_usuario);
		$ID = isset($array_usuario[0]["id"])?$array_usuario[0]["id"]:0;
		$password = crypt_clave($password);
		$array_usuario = $datos_usuario->insertar_usuario($usuario, $password, $ID);
		$idusuario = isset($array_usuario[0]["id"])?$array_usuario[0]["id"]:0;
		if(count($info_contacto) > 0)
		{
			foreach($info_contacto as $item)
			{
				$item_value = isset($item["value"])?$item["value"]:'';
				$item_idtipo= isset($item["idtipo"])?$item["idtipo"]:0;
				$item_principal= isset($item["principal"])?$item["principal"]:0;	
				
				$datos_usuario->insertar_info_contacto($item_value, $item_idtipo, $ID, 'mod_empresa_personal', $item_principal);
			}
		}
		if($tipo_usuario == 0 && count($menu) > 0)
		{	
			foreach($menu as $item)
			{
				$idmenu = isset($item["id"])?$item["id"]:0;	
				if($idmenu!==0)
				{
					$datos_usuario->insertar_usuario_permiso($idusuario, 99, 1, $idmenu);
				}
			}
		}
		
		##########################################################################################
		
		$detalle_imagen = $datos_general->config_listado_imagenes(2);

		$item_alto = isset($detalle_imagen[0]["alto"])?$detalle_imagen[0]["alto"]:'';
		$item_ancho = isset($detalle_imagen[0]["ancho"])?$detalle_imagen[0]["ancho"]:'';
		$item_calidad = isset($detalle_imagen[0]["calidad"])?$detalle_imagen[0]["calidad"]:5;
		$item_cuadrado = isset($detalle_imagen[0]["cuadrado"])?$detalle_imagen[0]["cuadrado"]:0;
		$item_ratio = isset($detalle_imagen[0]["ratio"])?$detalle_imagen[0]["ratio"]:0;

		##########################################################################################
		$tmpFilePath = isset($array_files['tmp_name'][0])?$array_files['tmp_name'][0]:'';
		$name_imagen = isset($array_files["name"][0])?$array_files["name"][0]:'';
		if(($array_files['error'][0])==0)
		{
			if($tmpFilePath != "" && ($array_files["size"][0] < MAX_SIZE_IMAGE_UPLOAD_SIS) && ($array_files["size"][0] > 0))
			{			
				$temp = explode(".", $array_files["name"][0]);
				$newfilename = trim(str_replace (" ","",uniqid().uniqidReal().PHP_EOL)). '.' . end($temp);
				$newFilePath = $ruta_ftp. $newfilename;

				if(move_uploaded_file($tmpFilePath, $newFilePath))
				{
					//Handle other code here
					$datos_usuario->actualizar_personal_imagen($ID, $newfilename);
					###################################################################

					$imgh = icreate($newFilePath);

					if($item_cuadrado == 1)
					{
						$imgr = resizeCrop($imgh, $item_ancho, $item_ancho, "0.$item_calidad");
					}
					else if ($item_ratio==1)
					{
						$imgr = resizeAspectW($imgh, $item_ancho);
					}
					else
					{
						$imgr = resizeCrop($imgh, $item_ancho, $item_alto, "0.$item_calidad");
					}

					$directorio_final = $ruta_ftp."th/";
					if (!file_exists($directorio_final)){  mkdir($directorio_final, 0777, true); } 

					imagejpeg($imgr,$directorio_final.$newfilename);


				}
				else
				{
					$array_error = array(
						"imagen" => "$name_imagen",
						"error" => 2,
					);
					array_push($_SESSION['error_imagen'], $array_error);
				}
			}
			else
			{
				$array_error = array(
					"imagen" => "$name_imagen",
					"error" => 1,
				);
				array_push($_SESSION['error_imagen'], $array_error);
			}
		}
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$ID&action=edit&msg=1";		
    break;
    case 'edit':
    	$datos_usuario->actualizar_personal($get_id, $nombres, $apellidos, $fecha_nacimiento, $correo, $idestado, $tipo_usuario);
		$datos_usuario->actualizar_usuario($get_id, $usuario);
		$datos_usuario->eliminar_data_info($get_id, 'mod_empresa_personal');		
		if(count($info_contacto) > 0)
		{
			foreach($info_contacto as $item)
			{
				$item_value = isset($item["value"])?$item["value"]:'';
				$item_idtipo= isset($item["idtipo"])?$item["idtipo"]:0;			
				$item_principal= isset($item["principal"])?$item["principal"]:0;	
				
				$datos_usuario->insertar_info_contacto($item_value, $item_idtipo, $get_id, 'mod_empresa_personal',$item_principal);
			}
		}
		$array_usuario = $datos_usuario->listar_usuarioxpersonal($get_id);
		$idusuario = isset($array_usuario[0]["id"])?$array_usuario[0]["id"]:0;		
		if($tipo_usuario == 0 && count($menu) > 0)
		{
			$datos_usuario->eliminar_permisos($idusuario);
			foreach($menu as $item)
			{
				$idmenu = isset($item["id"])?$item["id"]:0;	
				if($idmenu!==0)
				{
					$datos_usuario->insertar_usuario_permiso($idusuario, 99, 1, $idmenu);
				}
			}
		}
		
		##########################################################################################
		
		$detalle_imagen = $datos_general->config_listado_imagenes(2);

		$item_alto = isset($detalle_imagen[0]["alto"])?$detalle_imagen[0]["alto"]:'';
		$item_ancho = isset($detalle_imagen[0]["ancho"])?$detalle_imagen[0]["ancho"]:'';
		$item_calidad = isset($detalle_imagen[0]["calidad"])?$detalle_imagen[0]["calidad"]:5;
		$item_cuadrado = isset($detalle_imagen[0]["cuadrado"])?$detalle_imagen[0]["cuadrado"]:0;
		$item_ratio = isset($detalle_imagen[0]["ratio"])?$detalle_imagen[0]["ratio"]:0;

		##########################################################################################		
		
		$tmpFilePath = isset($array_files['tmp_name'][0])?$array_files['tmp_name'][0]:'';
		$name_imagen = isset($array_files["name"][0])?$array_files["name"][0]:'';
		
		if(($array_files['error'][0])==0)
		{
			if($tmpFilePath != "" && ($array_files["size"][0] < MAX_SIZE_IMAGE_UPLOAD_SIS) && ($array_files["size"][0] > 0))
			{			
				$temp = explode(".", $array_files["name"][0]);
				$newfilename = trim(str_replace (" ","",uniqid().uniqidReal().PHP_EOL)). '.' . end($temp);
				$newFilePath = $ruta_ftp. $newfilename;
				#exit();	
				if(move_uploaded_file($tmpFilePath, $newFilePath))
				{
					//Handle other code here
					$datos_usuario->actualizar_personal_imagen($get_id, $newfilename);	
					###################################################################

					$imgh = icreate($newFilePath);

					if($item_cuadrado == 1)
					{
						$imgr = resizeCrop($imgh, $item_ancho, $item_ancho, "0.$item_calidad");
					}
					else if ($item_ratio==1)
					{
						$imgr = resizeAspectW($imgh, $item_ancho);
					}
					else
					{
						$imgr = resizeCrop($imgh, $item_ancho, $item_alto, "0.$item_calidad");
					}

					$directorio_final = $ruta_ftp."th/";
					if (!file_exists($directorio_final)){  mkdir($directorio_final, 0777, true); } 

					imagejpeg($imgr,$directorio_final.$newfilename);
				}
				else
				{
					$array_error = array(
						"imagen" => "$name_imagen",
						"error" => 2,
					);
					array_push($_SESSION['error_imagen'], $array_error);
				}
			}
			else
			{
				$array_error = array(
					"imagen" => "$name_imagen",
					"error" => 1,
				);
				array_push($_SESSION['error_imagen'], $array_error);
			}
		}
		if($password!=='')
		{
			$password = crypt_clave($password);
			$datos_usuario->actualizar_only_password($get_id, $password);
		}
		
		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$get_id&action=edit&msg=1";				
    break;
    case 'delete':
		
		$detalle_usuario = $datos_usuario->detalle_usuario($cod_eli_confirm);
		$imagen = isset($detalle_usuario[0]["imagen"])?$detalle_usuario[0]["imagen"]:'';
		if($imagen!=='')
		{
			delete_image_registros($ruta_destino.$imagen);
			delete_image_registros($ruta_destino."th/".$imagen);
		}	
    	$array_usuario = $datos_usuario->listar_usuarioxpersonal($cod_eli_confirm);
		$idusuario = isset($array_usuario[0]["id"])?$array_usuario[0]["id"]:0;
		$datos_usuario->eliminar_permisos($idusuario);		
		$datos_usuario->eliminar_personal($cod_eli_confirm);
		$datos_usuario->eliminar_usuario($cod_eli_confirm);
		$datos_usuario->eliminar_data_info($cod_eli_confirm, 'mod_empresa_personal');
		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&msg=2";				
	break;
	case 'delete_imagen'	:
		$detalle_usuario = $datos_usuario->detalle_usuario($cod_eli_confirm);
		$imagen = isset($detalle_usuario[0]["imagen"])?$detalle_usuario[0]["imagen"]:'';
		if($imagen!=='')
		{
			delete_image_registros($ruta_destino.$imagen);
			delete_image_registros($ruta_destino."th/".$imagen);
			$datos_usuario->actualizar_personal_imagen($cod_eli_confirm, "");	
		}
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$cod_eli_confirm&action=edit&msg=3";							
    break;
}
if($url_retorno!=='')
{
	header("Location: $url_retorno");
}
?>