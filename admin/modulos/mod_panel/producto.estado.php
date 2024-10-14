<?php
include URL_ROOT_ADMIN."modulos/mod_panel/clases/class.registro.producto.estado.php";

$datos_estado_producto = new producto_estado();

$url_guardar = "guardar_estado_producto();";

$url_form_guardar = URL_WEB_ADMIN."modulos/$get_modulo/scripts/producto.estado.script.php";
$url_form_eliminar = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete";
$url_form_eliminar_imagen = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen";
$url_form_eliminar_imagen_seo = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen_seo";

$url_nuevo = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&action=new";
$url_cancelar = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token";
$url_cerrar = URL_WEB_ADMIN."?token=$get_token";

$listado_estado = $datos_estado_producto->detalle_estado($get_id);
#print_r($listado_registro);
if(count($listado_estado) == 0)
{
	if($get_action != "new") $get_action = '';	
	$item_estado = "";
}
else
{
	$item_estado = $listado_estado[0]["estado"];
}

?>
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Estado</h1>
</div>

<?php
	#BOTONES HEADER
	header_buttons($url_guardar, $get_action, $url_nuevo, $url_cerrar, $url_cancelar);
?>

<div class="bg wrapper-md" ng-controller="FormDemoCtrl">
<?php
if($get_action == '' or $get_action == 'lista')
{
	include URL_ROOT_ADMIN."modulos/mod_panel/ajax/listado.producto.estado.php";
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
 						layers(1, "Estado", "estado", "Ingrese el estado del producto", "", $item_estado, "");
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

