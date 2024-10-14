<?php
include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."funciones/funciones.php";
include URL_ROOT_ADMIN."funciones/constantes.php";
include URL_ROOT_ADMIN."modulos/$get_modulo/clases/class.registro.php";
$datos_registro = new registro();

$_item_nombre = isset($_POST["nombre"])?$_POST["nombre"]:'';
$_item_url =  isset($_POST["url"])?$_POST["url"]:'';
$_item_resumen =  isset($_POST["resumen"])?$_POST["resumen"]:'';
$_item_pagina = isset($_POST["pagina"])?$_POST["pagina"]:0;
$_item_alias = isset($_POST["alias"])?$_POST["alias"]:'';
$_item_orden = isset($_POST["orden"])?$_POST["orden"]:'';
$_item_estado = isset($_POST["estado"])?$_POST["estado"]:0;
$_item_destacado = isset($_POST["destacado"])?$_POST["destacado"]:0;
$_item_descripcion = isset($_POST["descripcion"])?$_POST["descripcion"]:'';
$_item_titulo_seo = isset($_POST["titulo_seo"])?$_POST["titulo_seo"]:'';
$_item_descripcion_seo = isset($_POST["descripcion_seo"])?$_POST["descripcion_seo"]:'';
$_item_keywords_seo = isset($_POST["keywords_seo"])?$_POST["keywords_seo"]:'';
$_item_galeria = isset($_POST["galeria"])?$_POST["galeria"]:array();

$_item_tipo = isset($_POST["tipo_registro"])?$_POST["tipo_registro"]:0;

$fecha_creacion = $fecha_ahora;
$ruta_destino = URL_ROOT."images/media/";			
$ruta_ftp = URL_ROOT."images/media/";				
$myFile = isset($_FILES["imagenes"]) ? $_FILES["imagenes"] : ''; 	

#$cod_eli_confirm = isset($_GET["cod_eli_confirm"]) ?$_GET["cod_eli_confirm"] : '';			
			
#$tipo = "imagen";
#print_r($myFile);
#print_r($_POST);
#exit();

$url_retorno="";
switch ($get_action) {
    case 'new':    	
		
									#insertar_registro($nombre, $url, $imagen, $resumen, $descripcion, $orden, $idtipo, $idestado, $idusuario, $iddestacado, $fecha_creacion, $fecha_modificacion)
		$array_id = $datos_registro->insertar_registro($_item_nombre, $_item_url, "", $_item_resumen, $_item_descripcion, $_item_orden, $_item_tipo, $_item_estado, 1, $_item_destacado, $fecha_creacion, $fecha_creacion);
		$ID = isset($array_id[0]["id"])?$array_id[0]["id"]:'';		
		
		upload_files_slider(MAX_SIZE_IMAGE_UPLOAD_SIS,$myFile,$ruta_ftp,$ID);
		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$ID&action=edit&msg=1";
		
    break;
    case 'edit':
		
						#actualizar_registro($id, $nombre, $url, $imagen, $resumen, $descripcion, $orden, $idestado, $iddestacado, $fecha_modificacion)
    	$datos_registro->actualizar_registro($get_id, $_item_nombre, $_item_url,"", $_item_resumen,$_item_descripcion,$_item_orden,$_item_estado,$_item_destacado,$fecha_creacion);
		
		$nueva_imagen = isset($myFile["size"][0])?$myFile["size"][0]:0;
		if($nueva_imagen > 0)
		{
			$listado_imagenes = $datos_registro->listar_registro_relacionxtipo($get_id, 4);
			if($listado_imagenes > 0)
			{
				foreach($listado_imagenes as $item)
				{
					$item_id = isset($item["id"])?$item["id"]:'';
					$item_imagen = isset($item["imagen"])?$item["imagen"]:'';
					unlink(URL_ROOT."images/media/$item_imagen");
					$datos_registro->eliminar_registro($item_id);
				}
			}
		}
		if(count($_item_galeria) > 0)
		{
			foreach($_item_galeria as $item)
			{
				$_galeria_id = isset($item["id"])?$item["id"]:'';
				$_galeria_nombre = isset($item["nombre"])?$item["nombre"]:'';
				$_galeria_orden = isset($item["orden"])?$item["orden"]:0;
				$_galeria_destacado = isset($item["destacado"])?$item["destacado"]:0;				
				$datos_registro->actualizar_registro($_galeria_id, $_galeria_nombre, "","","","",$_galeria_orden,0,$_galeria_destacado);
			}
		}
		
		upload_files_slider(MAX_SIZE_IMAGE_UPLOAD_SIS,$myFile,$ruta_ftp,$get_id);
			
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$get_id&action=edit&msg=1";
		
    break;
    case 'delete':
    	$datos_registro->eliminar_registro($cod_eli_confirm);		
		
		$listado_imagenes = $datos_registro->listar_registro_relacionxtipo($cod_eli_confirm, 4);
		if($listado_imagenes > 0)
		{
			foreach($listado_imagenes as $item)
			{
				$item_id = isset($item["id"])?$item["id"]:'';
				$item_imagen = isset($item["imagen"])?$item["imagen"]:'';
				
				if(file_exists(URL_ROOT."images/media/$item_imagen"))
				{
					unlink(URL_ROOT."images/media/$item_imagen");
				}
				if(file_exists(URL_ROOT."images/media/slider/$item_imagen"))
				{
					unlink(URL_ROOT."images/media/slider/$item_imagen");
				}
				
				$datos_registro->eliminar_registro($item_id);
			}
		}
		
		#$datos_registro->eliminar_allrelacion($cod_eli_confirm);
		#$datos_registro->eliminar_relacion($cod_eli_confirm);
		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&msg=2";
    break;
	case 'delete_imagen':
		
		$array_registro = $datos_registro->registro_detalle($cod_eli_confirm);
		$item_imagen = isset($array_registro[0]["imagen"])?$array_registro[0]["imagen"]:'';
		if($item_imagen!=='')
		{
			if(file_exists(URL_ROOT."images/media/$item_imagen"))
			{
				unlink(URL_ROOT."images/media/$item_imagen");
			}
			if(file_exists(URL_ROOT."images/media/slider/$item_imagen"))
			{
				unlink(URL_ROOT."images/media/slider/$item_imagen");
			}				
		}		
		$array_registro = $datos_registro->eliminar_imagen($cod_eli_confirm);
		$get_id = isset($array_registro[0]["id"])?$array_registro[0]["id"]:0;
		
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&ID=$get_id&action=edit&msg=3";
	break;	
		
}
if($url_retorno!='')
{
	header("Location: $url_retorno");
}
?>