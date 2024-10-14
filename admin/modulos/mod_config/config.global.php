<?php
include URL_ROOT_ADMIN."modulos/$get_modulo/clases/class.$get_option.php";

$datos_config_global = new config_global();

$url_guardar = "guardar_config_global();";
$url_form_guardar = URL_WEB_ADMIN."modulos/$get_modulo/scripts/$get_option.script.php";
$url_form_eliminar = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete";
$url_form_eliminar_imagen = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen";
$url_form_eliminar_imagen_seo = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen_seo";

$url_nuevo = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&action=new";
$url_cancelar = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token";
$url_cerrar = URL_WEB_ADMIN."?token=$get_token";

$get_action='edit';
?>
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Configuraci&oacute;n global</h1>
</div>

<?php
	#BOTONES HEADER
	header_buttons($url_guardar, $get_action, $url_nuevo, $url_cerrar, $url_cancelar);

$array_imagenes_1 = $datos_config_global->config_listado_imagenes(1);
$array_imagenes_2 = $datos_config_global->config_listado_imagenes(2);
?>

<div class="bg wrapper-md" ng-controller="FormDemoCtrl">
	
	<form class="form-horizontal" method="post" action="<?php echo $url_form_guardar; ?>" enctype="multipart/form-data">        
	
		
	<div class="row">
		<div class="col-sm-6">
		  <div class="panel panel-default">
			<div class="panel-heading font-bold">Banner slider</div>
			<div class="panel-body">
			 <?php layers_config_imagen(0,$array_imagenes_1); ?>	
			</div>
		  </div>
		</div>	
		<div class="col-sm-6">
		  <div class="panel panel-default">
			<div class="panel-heading font-bold">Imagenes registros</div>
			<div class="panel-body">
			 <?php layers_config_imagen(1,$array_imagenes_2); ?>	
			</div>
		  </div>
		</div>	
		
	</div>	
		

	<?php layers_hidden($get_id, $get_modulo, $get_option, $get_action, $get_token);  ?>
	</form>	
</div>

