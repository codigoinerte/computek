<?php
include URL_ROOT_ADMIN."modulos/$get_modulo/clases/class.empresa.php";

$url_form_guardar = URL_WEB_ADMIN."modulos/$get_modulo/scripts/empresas.script.php";
$url_guardar = "guardar_empresa_sistema();";
$url_nuevo = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&action=new";
$url_cancelar = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token";
$url_cerrar = URL_WEB_ADMIN."?token=$get_token";

$get_id=1;
$get_action='edit';
$datos_empresa = new empresa();
$listado_registro = $datos_empresa->detalle_empresa($get_id);
if(count($listado_registro) == 0)
{
	$item_idtipo = 0;
	$item_empresa = "";
	$item_ruc = "";
	$item_idpersonal = 0;
	
	$item_seo_titulo = "";
	$item_seo_keyword = "";
	$item_seo_descripcion = "";
	
	$item_favicon="";
	$item_isotipo="";
	$item_logotipo="";
	
}
else
{
	$item_idtipo = $listado_registro[0]["idtipo"];
	$item_empresa = $listado_registro[0]["empresa"];
	$item_ruc = $listado_registro[0]["ruc"];
	$item_idpersonal = $listado_registro[0]["idpersonal"];
	
	$item_seo_titulo = $listado_registro[0]["titulo_seo"];
	$item_seo_keyword = $listado_registro[0]["keyword_seo"];
	$item_seo_descripcion = $listado_registro[0]["descripcion_seo"];
	
	$item_favicon=$listado_registro[0]["favicon"];
	$item_isotipo=$listado_registro[0]["isotipo"];
	$item_logotipo=$listado_registro[0]["logo"];
	
}

$listado_personal = $datos_empresa->listado_personal();
$listado_tipo_info = $datos_general->listado_dato_tipo_info();
$listado_info_contacto = $datos_general->detalle_dato_info($get_id,'mod_empresa');
?>
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Empresa sistema</h1>
</div>

<?php
	#BOTONES HEADER
	header_buttons($url_guardar, $get_action, $url_nuevo, $url_cerrar, $url_cancelar);
?>

<div class="bg wrapper-md" ng-controller="FormDemoCtrl">

      <form class="form-horizontal" method="post" action="<?php echo $url_form_guardar; ?>" enctype="multipart/form-data">        
		       
		<div>
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#block-1" aria-controls="block-1" role="tab" data-toggle="tab">Detalle</a></li>
			<li role="presentation"><a href="#block-2" aria-controls="block-2" role="tab" data-toggle="tab">Seo Sistema</a></li>
			<li role="presentation"><a href="#block-3" aria-controls="block-3" role="tab" data-toggle="tab">Imagen Sistema</a></li>
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
 						
						layers(1, "Empresa", "empresa", "Ingrese el nombre de la empresa", "", $item_empresa);
 						layers(1, "RUC", "ruc", "Ingrese el ruc de la empresa", "", $item_ruc); 
						layers(2, "Reprensentante", "representante", "Seleccione el personal representante oficial de la empresa", $listado_personal, $item_idpersonal); 
						layers_hidden($get_id, $get_modulo, $get_option, $get_action, $get_token); 

					?> 							
				</div>
				<div class="bg-info panel-heading font-bold ">
				  informaci&oacute; de empresa
				</div>
				<div class="panel-body" >
			  	<?php	
 						$ruta=URL_WEB_ADMIN."modulos/mod_config/ajax/ajax.usuarios.info.php?token=$get_token";	
 						$onclick1 = 'onclick="javascript:cargar_datos_info(selectable,\'block_info\',\''.$ruta.'\');"';
						layers(7, "Info contacto", "tipo_info", "Seleccione el tipo de informacion de contacto que desea registrar", $listado_tipo_info,"", $onclick1); 
						listado_info($listado_info_contacto);
				?>
					
				</div>
  
				  
			  </div>

			<!---==============================================================--->
			</div>
			<div role="tabpanel" class="tab-pane" id="block-2">
				
			<!---==============================================================--->  
				<div class="panel panel-default panel-form">
					<div class="bg-info panel-heading font-bold ">
					  SEO
					</div>
					<div class="panel-body" >	
						<?php
						layers(1, "SEO Titulo", "titulo_seo", "Ingrese el titulo del seo de la empresa", "", $item_seo_titulo);
						layers(1, "SEO Keywords", "keywords_seo", "Ingrese las palabras clave de la empresa", "", $item_seo_keyword);
						layers(1, "SEO Descripción", "descripcion_seo", "Ingrese la descripcion de la empresa", "", $item_seo_descripcion);
						?>
					</div>	
				</div>	
			<!---==============================================================--->
			</div>
			<div role="tabpanel" class="tab-pane" id="block-3">  
			<!---==============================================================--->  
				<div class="panel panel-default panel-form">
					<div class="bg-info panel-heading font-bold ">
					  Logo
					</div>
					<div class="panel-body" >	
						<?php layers(5, "Im&aacute;gen", "logo", "Ingrese el logo de la empresa", ""); ?>
					 	<br>
						<div class="galeria-registro">
						<?php 						
						if($item_logotipo!=='' && isset($item_logotipo))					
						{	$url_form_eliminar_imagen = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&cod_eli_confirm=1&action=delete_imagen_logo";
							$url_imagen = URL_WEB_ADMIN."images/sistema/".$item_logotipo;
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
					<div class="bg-info panel-heading font-bold ">
					  Isotipo
					</div>
					<div class="panel-body" >	
						<?php layers(5, "Im&aacute;gen", "isotipo", "Ingrese el isotipo de la empresa", ""); ?>
					 	<br>
						<div class="galeria-registro">
						<?php 						
						if($item_isotipo !=='' && isset($item_isotipo))					
						{	$url_form_eliminar_imagen = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&cod_eli_confirm=1&action=delete_imagen_isotipo";
							$url_imagen = URL_WEB_ADMIN."images/sistema/".$item_isotipo;
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
					<div class="bg-info panel-heading font-bold ">
					  Favicon
					</div>
					<div class="panel-body" >	
						<?php layers(5, "Im&aacute;gen", "favicon", "Ingrese el favicon de la empresa", ""); ?>
					 	<br>
						<div class="galeria-registro">
						<?php 						
						if($item_favicon !=='' && isset($item_favicon))					
						{	$url_form_eliminar_imagen = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&cod_eli_confirm=1&action=delete_imagen_favicon";
							$url_imagen = URL_WEB_ADMIN."images/sistema/".$item_favicon;
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

 	 
	
</div>

