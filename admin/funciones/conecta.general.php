<?php
#error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
#ob_start('ob_gzhandler');
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
ini_set('memory_limit', '-1');
ini_set('date.timezone', 'America/LIma');
header('Content-Type: text/html; charset=UTF-8');
setlocale(LC_ALL, 'es_PE.UTF-8');
session_set_cookie_params(0); 
session_start();

$url_root= substr($_SERVER['SCRIPT_FILENAME'], 0, -strlen($_SERVER['PHP_SELF']))."/";;
$url_root_admin = $url_root."admin/";
$dir="";
if($_SERVER["SERVER_NAME"] == "localhost")
{
	$path = (strtoupper(substr(PHP_OS, 0, 3)) === "WIN") ? "\\" : "/";
	$replace = explode($path, dirname(__file__));
	$dir = $replace[count($replace)-3]."/";
	$url_root=substr($_SERVER['SCRIPT_FILENAME'], 0, -strlen($_SERVER['PHP_SELF']))."/$dir";#$url_root_admin.$dir;
	$url_root_admin= $url_root."admin/";
}

$url_web_admin = "http" . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST']."/".$dir."admin/";
$url_web = "http" . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST']."/".$dir;

define("URL_ROOT_ADMIN",$url_root_admin);
define("URL_ROOT",$url_root);
define("COD_SEG",(md5($_SERVER['HTTP_HOST'])));
define("URL_WEB_ADMIN",$url_web_admin);
define("URL_WEB",$url_web);
define("URL_AMIGABLE",true);

$fecha_ahora= date("Y-m-d"); 
include URL_ROOT_ADMIN."/clases/class.conecta.php";
include URL_ROOT_ADMIN."/clases/class.definition.php";
include URL_ROOT_ADMIN."/clases/class.TemplatePower.inc.php";
include URL_ROOT_ADMIN."/clases/class.phpmailer.php";
include URL_ROOT_ADMIN."/clases/class.smtp.php";

$datos_definition = new definition();
include ("funciones.general.php");
?>