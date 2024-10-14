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

/*CODIFICACION VARIABLES*/
$campo_correo = isset($_POST["email"])?$_POST["email"]:"";
$suscripcion = isset($_REQUEST["suscripcion"])?$_REQUEST["suscripcion"]:0;
$sender_email = isset($_POST["email"])?$_POST["email"]:'';
$token_cancelar = isset($_REQUEST["token"])?$_REQUEST["token"]:'';

if($suscripcion != 0) 
{

        $image= URL_ROOT."/images/logo.jpg";
		$cid = "logo";
	
		$sender_subject="Suscripcion";
		if($suscripcion==1 && $campo_correo !=='')
		{
			$listado_correos = $datos_contactenos->listar_correo($sender_email);
			$cantidad_correos = isset($listado_correos[0]["count(*)"])?$listado_correos[0]["count(*)"]:0;
			#$cantidad_correos = 0;
			
			if($cantidad_correos==0)
			{
				///////////////////////////////////////////////
				/// ENVIAR  A ADMINISTRADOR DATOS DE USUARIO
				////////////////////////////////////////////// 
				$sender_subject='Suscripcion';
				$tpl = new TemplatePower(URL_ROOT."librerias/mod_contactenos/template/contacto_admin_suscripcion.tpl");
				$tpl->prepare();
				$tpl->assign("email", $sender_email);

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
				$sender_name="Usuario";
				$link_desuscripcion=URL_WEB."librerias/mod_contactenos/parse.suscripcion.php?suscripcion=2&token=".(base64_encode($sender_email)); 
				$sender_subject = "Hemos registrado su suscripción.";
				$tpl2 = new TemplatePower(URL_ROOT."librerias/mod_contactenos/template/contacto_usuario_suscripcion.tpl" );
				$tpl2->prepare();
				
				$link = '<a href="'.$link_desuscripcion.'" style="text-decoration: none !important;padding: 7px 10px; background: #5F0001;color: #FFF; border-radius: 2px;">Si desea desuscribirse haga clic aqui</a>	';
				
				$tpl2->assign("link_desuscripcion", $link);
				$tpl2->assign("tienda", NOMBRE_TIENDA);
				$tpl2->assign("slogan", SLOGAN);
				$tpl2->assign("admin", ADMINISTRADOR);		
				$tpl2->assign("info", INFO);				
				$tpl2->assign("footer", FOOTER_CORREO);		

				$respuesta = enviar_correo_web(ADMINISTRADOR, CORREO_ADMIN, $sender_name, $sender_email, $sender_subject, $tpl2->getOutputContent(), $image);

				$datos_contactenos->insertar_correo("boletin", $sender_name, $sender_email, "", "", "" , "");


				if($respuesta1 && $respuesta)
				{
					header("Location:".URL_WEB."?suscripcion=1");
				}
				else
				{
					header("Location:".URL_WEB."?suscripcion=2");
				}
			}
			else
			{
				header("Location:".URL_WEB."?suscripcion=3");
			}
		
		}
		else if($suscripcion==2)
		{
				$sender_email=base64_decode($token_cancelar);
				$datos_contactenos->eliminar_correo("boletin", $sender_email);
			
				header("Location:".URL_WEB."?suscripcion=9");	
		}
		else
		{
			header("Location:".URL_WEB."?suscripcion=2");
		}

}
else
{
	header("Location:".URL_WEB."?suscripcion=4");
}
	

//print_r($_POST);

?>