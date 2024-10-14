<?php

include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."funciones/funciones.php";
include URL_ROOT_ADMIN."funciones/conecta.php";
$url_retorno="";
switch ($get_action) {
    case 'new':    	
		
		
		
		$creaBU 	= false;
		$nombre 	= URL_ROOT."admin/systembk/svperu_".date("d-m-Y_H-i-s").".zip";
		$directorio 	= URL_ROOT."admin/systembk/";
		
		if (!file_exists($directorio)) {  mkdir($directorio, 0777, true); }
		
		//busca todos los ficheros que sean .zip
		$files 		= glob($directorio . '*.zip');
		$root=URL_ROOT;
		//Verifica la cantidad de ficheros y si es que hay que borrar y cual.
		if ( $files !== false ){
			$cant = count( $files );
			if($cant >= 5){
				//ya hay 5 respaldos así que hay que eliminar antes de pder seguir
				//genera un array para tomar el archivo más antiguo de los que se encuentran
				array_multisort(
				array_map( 'filemtime', $files ),
				SORT_NUMERIC,
				SORT_ASC,
				$files
				);
				//Si ya se alcanzó el máximo número, se borra el backup más antiguo.
				#print_r($files[0]);
				#exit();
				unlink($files[0]);
				$creaBU 	= true;
			}else{
				//áun no se llega a los 6 respaldos
				$creaBU 	= true;

			}
		}else{
			//si no encuentra quiere decir que no hay ficheros y crea el back de todas formas.
			$creaBU 	= true;
		}
		
		$destino 	= "$root/admin/systembk/svperu_".date("d-m-Y_H-i-s").".zip";
		if($creaBU): ZipBa(realpath("$root"), $destino); endif;		
		
		
		backupDatabaseTables($dbhost,$dbusername,$dbuserpass,$dbname);
		
		$fichero_cache=URL_ROOT_ADMIN."cache/".md5(URL_WEB_ADMIN."cache_backup_system_list").".php"; ;
		if(file_exists($fichero_cache))
		{
			unlink($fichero_cache);
		}
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&msg=4";		
    break;
    case 'delete':
    			
		$url_retorno = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&msg=5";
    break;	
		
}
if($url_retorno!='')
{
	header("Location: $url_retorno");
}
?>