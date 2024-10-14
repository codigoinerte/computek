<?php

include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."funciones/funciones.php";

$files = glob(URL_ROOT_ADMIN.'cache/*.php'); //obtenemos todos los nombres de los ficheros
$url_retorno=URL_WEB_ADMIN."?token=$get_token&msg=99";
foreach($files as $file){
    if(is_file($file))
    unlink($file); //elimino el fichero
	$url_retorno=URL_WEB_ADMIN."?token=$get_token&msg=99";
}
header("Location: $url_retorno");
?>