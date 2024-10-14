<?php
#if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$root = $_SERVER["DOCUMENT_ROOT"];
#echo $root;
#exit();
error_reporting(E_ALL);
$creaBU 	= false;
$nombre 	= "$root/admin/backup/svperu_".date("d-m-Y_H-i-s").".zip";
$directorio 	= "$root/admin/backup/";
//busca todos los ficheros que sean .zip
$files 		= glob($directorio . '*.zip');

//Verifica la cantidad de ficheros y si es que hay que borrar y cual.
if ( $files !== false ){
    $cant = count( $files );
    if($cant >= 5){
    	//ya hay 5 respaldos así que hay que eliminar antes de pder seguir
    	//genera un array para tomar el archivo más antiguo de los que se encuentran
    	array_multisort(
		array_map( 'filemtime', $files ),
		SORT_NUMERIC,
		SORT_DESC,
		$files
		);
        //Si ya se alcanzó el máximo número, se borra el backup más antiguo.
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

/**
@abstract Archivo de backup automatico de ficheros de sitios alojados
@param $directorio contiene la ruta de los ficheros
@version creacion 1.0
**/
function ZipBa($desde, $destino){
    if (extension_loaded('zip') === true) {
        if (file_exists($desde) === true) {
            $zip = new ZipArchive();

            if ($zip->open($destino, ZIPARCHIVE::CREATE) === true){
                $desde = realpath($desde);

                if (is_dir($desde) === true){
                    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($desde), RecursiveIteratorIterator::SELF_FIRST);

                    foreach ($files as $file){
                        $file = realpath($file);

                        if (is_dir($file) === true){
                            $zip->addEmptyDir(str_replace($desde . '/', '', $file . '/'));
                        }else if (is_file($file) === true){
                            $zip->addFromString(str_replace($desde . '/', '', $file), file_get_contents($file));
                        }
                    }
                }

                else if (is_file($desde) === true)
                {
                    $zip->addFromString(basename($desde), file_get_contents($desde));
                }
            }

            return $zip->close();
        }
    }

    return false;
}

$destino 	= "$root/admin/backup/svperu_".date("d-m-Y_H-i-s").".zip";
if($creaBU): ZipBa(realpath("$root"), $destino); endif;