<?php
include URL_ROOT_ADMIN."modulos/$get_modulo/clases/class.config.mail.php";
include URL_ROOT_ADMIN."modulos/mod_empresas/clases/class.empresa.php";

$datos_empresa = new empresa();
$datos_mail = new config_mail();

$url_form_guardar  = URL_WEB_ADMIN."modulos/$get_modulo/scripts/config.mail.script.php";
$url_form_eliminar = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete";
$url_form_eliminar_imagen = $url_form_guardar ."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen";
$url_guardar = "guardar_mail();";
$url_nuevo = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&action=new";
$url_cancelar = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token";
$url_cerrar = URL_WEB_ADMIN."?token=$get_token";

$detalle_correo = $datos_mail->detalle_mail($get_id);
if(count($detalle_correo) == 0)
{
	if($get_action != "new") $get_action = '';	
	
	$item_tipo_correo = "";
	$item_nombre = "";
	$item_correo = "";
	$item_empresa = "";
	$item_telefono = "";
	$item_asunto = "";
	$item_mensaje = "";
	$item_atencion = 2;
	$item_idpersonal = "";
	
}
else
{
	$item_tipo_correo = $detalle_correo[0]["tipo_correo"];
	$item_nombre = $detalle_correo[0]["nombre"];
	$item_correo = $detalle_correo[0]["correo"];
	$item_empresa = $detalle_correo[0]["empresa"];
	$item_telefono = $detalle_correo[0]["telefono"];
	$item_asunto = $detalle_correo[0]["asunto"];
	$item_mensaje = $detalle_correo[0]["mensaje"];
	$item_atencion = $detalle_correo[0]["atencion"];
	$item_idpersonal = $detalle_correo[0]["idpersonal"];

}
$listado_tipo_atencion = $datos_mail->listado_tipo_atencion();
$listado_personal = $datos_empresa->listado_personal();

?>
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Registro correos recibidos</h1>
</div>

<?php
	#BOTONES HEADER
	header_buttons($url_guardar, $get_action, $url_nuevo, $url_cerrar, $url_cancelar);
?>

<div class="wrapper-md" ng-controller="FormDemoCtrl">
<?php
if($get_action == '' or $get_action == 'lista')
{
	include URL_ROOT_ADMIN."modulos/$get_modulo/ajax/listado.config.mail.php";
}
else if($get_action=='edit' or $get_action=='new')
{
?>	
	
  <div class="col-xs-12 col-md-12">
  <div class="panel panel-default">
  	<div class="panel-heading font-bold">
      Detalle
    </div>
    <div class="panel-body">
      <form class="form-horizontal" method="post" action="<?php echo $url_form_guardar ; ?>">        
		<?php
		
		 layers(1, "Nombre", "nombre", "Ingrese el nombre", "", $item_nombre); 
		 layers(1, "Tipo de correo", "tipo_correo", "Ingrese el tipo del correo", "", $item_tipo_correo); 
		 layers(2, "Atenci&oacute;n", "atencion", "Seleccione el tipo de atenci&oacute;n", $listado_tipo_atencion, $item_atencion); 
		 layers(2, "Personal", "idpersonal", "Seleccione el personal de la atención", $listado_personal, $item_idpersonal); 
		 layers(1, "Correo", "correo", "Ingrese el correo", "", $item_correo); 
		 layers(1, "Empresa", "empresa", "Ingrese el nombre de la empresa", "", $item_empresa); 
		 layers(1, "Telefono", "telefono", "Ingrese el telefono", "", $item_telefono); 
		 layers(1, "Asunto", "asunto", "Ingrese el asunto del correo", "", $item_asunto); 
		 layers(16, "Mensaje", "mensaje", "Ingrese el mensaje del correo", "", $item_mensaje); 
		 
		 layers_hidden($get_id, $get_modulo, $get_option, $get_action, $get_token); 
 		#layers_action($url_cancelar);
		?>        
		  
      </form>
    </div>
 </div>
 </div> 	 	
<!--SEGUNDO BLOQUE-->
<?php
}
?>
	
 	 
	
</div>

