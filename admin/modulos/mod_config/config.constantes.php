<?php
include URL_ROOT_ADMIN."modulos/$get_modulo/clases/class.config.constantes.php";

$datos_config_constantes = new config_constantes();
$url_form_guardar = URL_WEB_ADMIN."modulos/$get_modulo/scripts/config.constantes.script.php";
$url_form_eliminar = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete";
$url_guardar = "guardar_constante();";
$url_form_eliminar_imagen_seo = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen_seo";
$url_form_eliminar_imagen = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen";
$url_nuevo = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&action=new";
$url_cancelar = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token";
$url_cerrar = URL_WEB_ADMIN."?token=$get_token";

$listado_constantes = $datos_config_constantes->detalle_constantes($get_id);

if(count($listado_constantes) == 0)
{
	if($get_action != "new") $get_action = '';	
	$item_nombre = "";
	$item_comentarios = "";
	$item_constante = "";
	$item_valor = "";
}
else
{
	$item_nombre = $listado_constantes[0]["nombre"];
	$item_comentarios = $listado_constantes[0]["comentarios"];
	$item_constante = $listado_constantes[0]["constante"];
	$item_valor = $listado_constantes[0]["valor"];
}

?>
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Constantes</h1>
</div>

<?php
	#BOTONES HEADER
	header_buttons($url_guardar, $get_action, $url_nuevo, $url_cerrar, $url_cancelar);
?>

<div class="bg wrapper-md" ng-controller="FormDemoCtrl">
<?php
if($get_action == '' or $get_action == 'lista')
{
	include URL_ROOT_ADMIN."modulos/$get_modulo/ajax/listado.config.constantes.php";
}
else if($get_action=='edit' or $get_action=='new')
{
?>	
      <form class="form-horizontal" method="post" action="<?php echo $url_form_guardar; ?>" enctype="multipart/form-data">        
		       
		<div>
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#block-1" aria-controls="block-1" role="tab" data-toggle="tab">Resumen</a></li>						
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="block-1">
				
			<!---==============================================================--->

			  <div class="panel panel-default panel-form">
				<div class="bg-info panel-heading font-bold ">
				  Detalle
				</div>
				<div class="panel-body" >
					<?php
 						layers(1, "Nombre", "nombre", "Ingrese el nombre del valor", "", $item_nombre, "");
 						layers(1, "Comentario", "comentario", "Ingrese un comentario sobre la constante", "", $item_comentarios, "");
 						layers(1, "Constante", "constante", "Ingrese la constante en mayusculas y sin espacios", "", $item_constante, "");
 						layers(1, "Valor", "valor", "Ingrese el valor de la consante", "", $item_valor, "");
 		
 						layers_hidden($get_id, $get_modulo, $get_option, $get_action, $get_token); 
					?> 							
				</div>
			  </div>

			<!---==============================================================--->
			</div>			
			  
		  </div>

		</div> 
		  
		  
      </form>
	 	
<!--SEGUNDO BLOQUE-->
<?php
}
?>
	
 	 
	
</div>

