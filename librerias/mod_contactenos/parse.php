<?php
require "../../admin/funciones/conecta.general.php";
include URL_ROOT."librerias/mod_contactenos/clases/class.contactenos.php";
include URL_ROOT."librerias/mod_seo/clases/class.seo.php";
include URL_ROOT_ADMIN."funciones/constantes.php";



$datos_contactenos = new contactenos();
$datos_seo = new seo();
$detalle_empresa = $datos_seo->detalle_empresa(1);

$titulo_empresa = isset($detalle_empresa[0]["titulo_seo"])?$detalle_empresa[0]["titulo_seo"]:'';
$logo_empresa = isset($detalle_empresa[0]["logo"])?$detalle_empresa[0]["logo"]:'';

$correo_empresa = isset($detalle_empresa[0]["correo"])?$detalle_empresa[0]["correo"]:'';
$telefono_empresa = isset($detalle_empresa[0]["telefono"])?$detalle_empresa[0]["telefono"]:'';
$celular_empresa = isset($detalle_empresa[0]["celular"])?$detalle_empresa[0]["celular"]:'';
$whatsapp_empresa = isset($detalle_empresa[0]["whatsapp"])?$detalle_empresa[0]["whatsapp"]:'';
$direccion_empresa = isset($detalle_empresa[0]["direccion"])?$detalle_empresa[0]["direccion"]:'';

define("INFO", "Direcci&oacute;n: $direccion_empresa <br/>Tel&eacute;fono:$telefono_empresa <br/>Celular: $celular_empresa <br>Correo: $correo_empresa <br><a style=\"color:#663;\" href=\"http://".$_SERVER['HTTP_HOST']."\">www.".$_SERVER['HTTP_HOST']."</a>");
define("FOOTER_CORREO", "Copyright &copy; ".date("Y")." ".URL_WEB);

$token = $_SESSION['token'] ;
/*CODIFICACION VARIABLES*/
$campo_nombres = "nombres".md5($token.'nombres');
$campo_correo = "correo".md5($token.'correo');
$campo_telefono = "telefono".md5($token.'telefono');
$campo_empresa = "empresa".md5($token.'empresa');
$campo_asunto = "asunto".md5($token.'asunto');
$campo_mensaje = "mensaje".md5($token.'mensaje'); 
$campo_producto= "producto".md5($token.'producto'); 

$sender_name = stripslashes(trim($_POST[$campo_nombres]));
$sender_email = stripslashes(trim($_POST[$campo_correo]));
$sender_telephone = stripslashes(trim($_POST[$campo_telefono]));
$sender_company = stripslashes(trim($_POST[$campo_empresa]));
$sender_asunto = stripslashes(trim($_POST[$campo_asunto]));
$sender_message = stripslashes(trim($_POST[$campo_mensaje]));

if($sender_name != NULL && $sender_telephone != NULL && $sender_email != NULL && $_SESSION['secure'] == md5(COD_SEG)) 
{
//echo "sn=".$sender_name."st=".$sender_telephone."se=".$sender_email."sm=".$sender_message;
        $image= URL_ROOT."/images/logo.png";
		$cid = "logo";
		
		if($sender_asunto!='')
		{
			$sender_subject=$sender_asunto;
		}
		///////////////////////////////////////////////
		/// ENVIAR  A ADMINISTRADOR DATOS DE USUARIO
		////////////////////////////////////////////// 
		$tpl = new TemplatePower(URL_ROOT."librerias/mod_contactenos/template/contacto_admin.tpl");
		$tpl->prepare();
		$tpl->assign("empresa", $sender_company);
		$tpl->assign("mensaje", $sender_message);
		$tpl->assign("name", $sender_name);
		$tpl->assign("email", $sender_email);
		$tpl->assign("telefono", $sender_telephone);
		$tpl->assign("empresa", $sender_company);
		#$tpl->assign("producto",$sender_product);
		$tpl->assign("tienda", NOMBRE_TIENDA);
		$tpl->assign("slogan", SLOGAN);
		$tpl->assign("admin", ADMINISTRADOR);		
		$tpl->assign("info", INFO);				
		$tpl->assign("footer", FOOTER_CORREO);				
		
		$respuesta1 = enviar_correo_web(ADMINISTRADOR, CORREO_ADMIN, ADMINISTRADOR, $correo_empresa, $sender_subject, $tpl->getOutputContent(), $image);		

		///////////////////////////////////////////////
		/// ENVIAR  A USUARIO MENSAJE DEL ADMINISTRADOR
		////////////////////////////////////////////// 
		$sender_subject = $sender_name." hemos recibido su solicitud.";
		$tpl2 = new TemplatePower(URL_ROOT."librerias/mod_contactenos/template/contacto_usuario.tpl" );
		$tpl2->prepare();
		$tpl2->assign("name", $sender_name);
		$tpl2->assign("tienda", NOMBRE_TIENDA);
		$tpl2->assign("slogan", SLOGAN);
		$tpl2->assign("admin", ADMINISTRADOR);		
		$tpl2->assign("info", INFO);				
		$tpl2->assign("footer", FOOTER_CORREO);		
		
		$respuesta = enviar_correo_web(ADMINISTRADOR, CORREO_ADMIN, $sender_name, $sender_email, $sender_subject, $tpl2->getOutputContent(), $image);
	
		$datos_contactenos->insertar_correo("correo", $sender_name, $sender_email, $sender_company, $sender_telephone, $sender_asunto , $sender_message);
	
	
		if($respuesta1 && $respuesta)
		{
			$ruta= URL_WEB."contactenos/1";
		}
		else
		{
			$ruta= URL_WEB."contactenos/4";
		}
		

}
else
{
	$ruta= URL_WEB."contactenos/2";
}
if($ruta!=='')	
{
	 header("Location:$ruta");
}

//print_r($_POST);

?>