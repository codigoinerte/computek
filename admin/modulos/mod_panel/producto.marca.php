<?php
include URL_ROOT_ADMIN."modulos/mod_panel/clases/class.registro.marca.php";

$datos_marca = new marca();
$url_form_guardar = URL_WEB_ADMIN."modulos/$get_modulo/scripts/producto.marca.script.php";

$url_guardar = "guardar_marca_producto();";

$url_form_eliminar = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete";
$url_form_eliminar_imagen = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen";
$url_form_eliminar_imagen_seo = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen_seo";

$url_nuevo = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&action=new";
$url_cancelar = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token";
$url_cerrar = URL_WEB_ADMIN."?token=$get_token";

$listado_marca = $datos_marca->detalle_marca($get_id);
#print_r($listado_registro);
if(count($listado_marca) == 0)
{
	if($get_action != "new") $get_action = '';	
	$item_marca = "";
	$item_imagen = "";
}
else
{
	$item_marca = $listado_marca[0]["marca"];
	$item_imagen = $listado_marca[0]["imagen"];
}

?>
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Marca</h1>
</div>

<?php
	#BOTONES HEADER
	header_buttons($url_guardar, $get_action, $url_nuevo, $url_cerrar, $url_cancelar);
?>

<div class="bg wrapper-md" ng-controller="FormDemoCtrl">
<?php
if($get_action == '' or $get_action == 'lista')
{
	include URL_ROOT_ADMIN."modulos/mod_panel/ajax/listado.producto.marca.php";
}
else if($get_action=='edit' or $get_action=='new')
{
?>	
      <form class="form-horizontal" method="post" action="<?php echo $url_form_guardar; ?>" enctype="multipart/form-data">        
		       
		<div>
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#block-1" aria-controls="block-1" role="tab" data-toggle="tab">Resumen</a></li>			
			<li role="presentation"><a href="#block-2" aria-controls="block-2" role="tab" data-toggle="tab">Im&aacute;gen</a></li>			
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
 						layers(1, "Marca", "marca", "Ingrese el nombre de la marca", "", $item_marca, "");
 						layers_hidden($get_id, $get_modulo, $get_option, $get_action, $get_token); 
					?> 							
				</div>
			  </div>

			<!---==============================================================--->
			</div>
			<div role="tabpanel" class="tab-pane" id="block-2">
			<!---==============================================================--->
				<div class="panel panel-default panel-form">
					<div class="bg-info panel-heading font-bold ">
					  Im&aacute;genes
					</div>
					<div class="panel-body">
					 	<?php layers(5, "Im&aacute;gen", "imagen", "Ingrese la imagen de la marca", ""); ?>
					 	<br>
						<div class="galeria-registro">
						<?php 	 						
						if($item_imagen!=='' && isset($item_imagen))					
						{	$url_form_eliminar_imagen = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&cod_eli_confirm=$get_id&action=delete_imagen";
							$url_imagen = URL_WEB."images/media/".$item_imagen;
							?>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
								<div class="item-imagen">
									<span class="bg-danger link"
									onClick="javascript:eliminar(<?php echo $get_id; ?>, '<?php echo $url_form_eliminar_imagen; ?>')"	  
									><i class="fa fa-times" aria-hidden="true"></i></span>
									<a data-fancybox="gallery" href="<?php echo $url_imagen; ?>" class="bg bg-cover" style="background-image: url(<?php echo $url_imagen; ?>)">
									<img src="<?php echo URL_WEB_ADMIN."images/bg-galeria.png"; ?>" alt="">
									</a>					
								</div>
							</div>
							<?php
						}
						?>
						</div>
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

