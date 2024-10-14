<?php
include URL_ROOT_ADMIN."modulos/mod_config/clases/class.config.usuarios.php";
include URL_ROOT_ADMIN."modulos/mod_config/clases/class.menu.principal.php";
include URL_ROOT_ADMIN."funciones/general.php";

$url_form_guardar = URL_WEB_ADMIN."modulos/$get_modulo/scripts/config.usuario.script.php";
$url_form_eliminar = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete";
$url_form_eliminar_imagen = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen";
$url_nuevo = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&action=new";
$url_cancelar = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token";
$url_cerrar = URL_WEB_ADMIN."?token=$get_token";

$url_guardar = "guardar_usuario();";
$datos_usuario= new config_usuarios();

$listado_usuario = $datos_usuario->detalle_usuario($get_id);
if(count($listado_usuario) == 0)
{
	if($get_action != "new") $get_action = '';	
	$item_usuario = "";
	$item_idempresa = 0;
	$item_pass = "";
	$item_nombres = "";
	$item_apellidos = "";
	$item_correo = "";
	$item_tipo_usuario = 0;
	$item_fecha_nacimiento = "0000-00-00";
	$item_idestado = 1;
	$item_idusuario = 0;
	$item_imagen = "";
	
	$listado_usuario_permisos= array();
}
else
{
	$item_usuario = $listado_usuario[0]["usuario"];
	$item_idempresa = $listado_usuario[0]["idempresa"];
	$item_pass = $listado_usuario[0]["pass"];
	$item_nombres = $listado_usuario[0]["nombres"];
	$item_apellidos = $listado_usuario[0]["apellidos"];
	$item_correo = $listado_usuario[0]["correo"];
	$item_tipo_usuario = $listado_usuario[0]["idtipo_usuario"];
	$item_fecha_nacimiento = $listado_usuario[0]["fecha_nacimiento"];
	$item_idestado = $listado_usuario[0]["idestado"];
	$item_idusuario = $listado_usuario[0]["idusuario"];
	$item_imagen = $listado_usuario[0]["imagen"];
	
	$listado_usuario_permisos = $datos_usuario->listar_permisos($item_idusuario);
	if(count($listado_usuario_permisos) > 0)
	{
		$listado_usuario_permisos = explode(",", $listado_usuario_permisos[0]["idmenu"]);
	}
	
}

$listado_tipo_usuario = $datos_usuario->listar_tipo_usuario();
$listado_info_contacto = $datos_general->detalle_dato_info($get_id,'mod_empresa_personal');
$listado_tipo_info = $datos_general->listado_dato_tipo_info();
$listado_usuario_estado = $datos_usuario->listar_usuario_estado();

#print_r($listado_usuario_permisos);
?>
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Registro Usuarios</h1>
</div>
<?php
	header_buttons($url_guardar, $get_action, $url_nuevo, $url_cerrar, $url_cancelar);
?>
<div class="wrapper-md" ng-controller="FormDemoCtrl">
<?php
if($get_action == '' or $get_action == 'lista')
{
	include URL_ROOT_ADMIN."modulos/mod_config/ajax/listado.config.usuarios.php";
}
else if($get_action=='edit' or $get_action=='new')
{
?>	
	
  <form class="form-horizontal" method="post" action="<?php echo $url_form_guardar; ?>" enctype="multipart/form-data">        
		<div>
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#block-1" aria-controls="block-1" role="tab" data-toggle="tab">Informaci&oacute;n de contacto</a></li>
			<li role="presentation"><a href="#block-2" aria-controls="block-2" role="tab" data-toggle="tab">Foto de perfil</a></li>
			<li role="presentation"><a href="#block-3" aria-controls="block-3" role="tab" data-toggle="tab">Acceso</a></li>
			<li role="presentation"><a href="#block-4" aria-controls="block-4" role="tab" data-toggle="tab">Permiso</a></li>
		  </ul>

		  <!-- Tab panes -->
		  <div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="block-1">
				
			<!---==============================================================--->

			  <div class="panel panel-default panel-form">
				<div class="bg-info panel-heading font-bold ">
				  Datos personales
				</div>
				<div class="panel-body" >
					<?php
 						#$onclick1 = 'onkeyup="javascript:titulo_registro(this, \'alias\' );javascript:titulo_registro_seo(this.value, \'titulo_seo\');"';
 						#$onclick2 = 'onclick="javascript:cargar_categoria(this.value,\'subcategoria\',\''.URL_WEB_ADMIN.'\',\''.$idsubcategoria.'\');"';	
 
						layers(1, "Nombre", "nombre", "Ingrese el nombre del usuario", "", $item_nombres);
 						layers(1, "Apellidos", "apellidos", "Ingrese el apellido del usuario", "", $item_apellidos); 
 						layers(1, "Correo", "correo", "Ingrese el correo del usuario, este servira para recuperar su contraseña", "", $item_correo); 
 						layers(6, "Fecha de nacimiento", "fecha_nacimiento", "Seleccione la fecha de nacimiento del usuario", "", $item_fecha_nacimiento); 
						layers(2, "Estado", "estado", "Seleccione el estado del usuario", $listado_usuario_estado, $item_idestado); 

						#layers_action($url_cancelar);
					?> 							
				</div>
				<div class="bg-info panel-heading font-bold ">
				  informaci&oacute; de contacto
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
			  <?php layers_hidden($get_id, $get_modulo, $get_option, $get_action, $get_token);  ?>
			<!---==============================================================--->
			</div>
			<div role="tabpanel" class="tab-pane" id="block-2">
			<!---==============================================================--->
				<div class="panel panel-default panel-form">
					<div class="bg-info panel-heading font-bold ">
					  Im&aacute;genes
					</div>
					<div class="panel-body">
					 <?php layers(5, "Im&aacute;genes", "imagenes", "Ingrese imagenes", ""); ?>
					 <br>
						
					<div class="galeria-registro">
						<?php 						
						if($item_imagen!=='' && isset($item_imagen))					
						{	
							$url_imagen = URL_WEB_ADMIN."images/".$item_imagen;
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
			<div role="tabpanel" class="tab-pane" id="block-3">
			<!---==============================================================--->
			
				
			  <div class="panel panel-default panel-form">
				<div class="bg-info panel-heading font-bold ">
				  Acceso web
				</div>
				<div class="panel-body">
					
					<?php layers(1, "Usuario", "usuario", "Ingrese el nombre de usuario usado para el login", "", $item_usuario); ?>
					<?php layers(8, "password", "password", "Ingrese la contraseña usado para el login", "", ""); ?>
					 
				</div>
			  </div>

			<!---==============================================================--->					
			</div>
			<div role="tabpanel" class="tab-pane" id="block-4">
			<!---==============================================================--->
				<div class="panel panel-default panel-form">
					<div class="bg-info panel-heading font-bold ">
					 Permiso
					</div>
					<div class="panel-body">						
						<?php layers(2, "Tipo usuario", "tipo_usuario", "Seleccione el tipo de usuario", $listado_tipo_usuario, $item_tipo_usuario);  ?>
					</div>
					
					<div class="bg-info panel-heading font-bold ">
					 Permiso personalizado
					</div>
					<div class="panel-body">
					 <?php ####################################################################### ?>
					 <div class="dd permisos_box">
							<ul>
							  <?php
 								$num_menu = 0;
								$data_pmenu = $datos_menu->listado_menu(1, 1,0,0,$SisID);
								if(count($data_pmenu) > 0)
								{	
									foreach($data_pmenu as $item)
									{
										$num_menu++;
										$_item_name_menu = isset($item["nombre"])?$item["nombre"]:'';
										$_item_id_menu = isset($item["id"])?$item["id"]:0;
										$_item_orden_menu = isset($item["orden"])?$item["orden"]:0;
							  ?>	
							  <li>	
								  
									<label class="input-group">
									  <span class="input-group-addon">
										<input type="checkbox" name="menu[<?php echo $num_menu; ?>][id]" value="<?php echo $_item_id_menu; ?>"
											   <?php if(in_array($_item_id_menu, $listado_usuario_permisos)){ echo "checked"; } ?>>
									  </span>
										<div class="form-control"><?php echo $_item_name_menu; ?></div>
									</label><!-- /input-group -->
								  								  
								  <?php $data_pcategoria = $datos_menu->listado_menu(1, 2, $_item_id_menu,0,$SisID);
										if(count($data_pcategoria) > 0)
										{						
								  ?>
										  <ol class="dd-list">
											  <?php foreach($data_pcategoria as $itemc)
								  				{
													$num_menu++;
													$_itemc_name_menu = isset($itemc["nombre"])?$itemc["nombre"]:'';
													$_itemc_id_menu = isset($itemc["id"])?$itemc["id"]:0;
													$_itemc_orden_menu = isset($itemc["orden"])?$itemc["orden"]:0;
											  ?>
											  <li class="dd-item dd3-item">
													<label class="input-group">
													  <span class="input-group-addon">
														<input type="checkbox"  name="menu[<?php echo $num_menu; ?>][id]" value="<?php echo $_itemc_id_menu; ?>"
															   <?php if(in_array($_itemc_id_menu, $listado_usuario_permisos)){ echo "checked"; } ?> >
													  </span>
													  <div class="form-control"><?php echo $_itemc_name_menu; ?></div>
													</label><!-- /input-group -->  																				  												  
												  <?php
												  $data_scategoria = $datos_menu->listado_menu(1, 3, $_itemc_id_menu,0,$SisID);
												  if(count($data_scategoria) > 0){
												  ?>
												  <ol class="dd-list">
													  <?php foreach($data_scategoria as $ritem)
												  		{
													  	$num_menu++;
														$_itemr_name_menu = isset($ritem["nombre"])?$ritem["nombre"]:'';
														$_itemr_id_menu = isset($ritem["id"])?$ritem["id"]:0;
														$_itemr_orden_menu = isset($ritem["orden"])?$ritem["orden"]:0;
													  ?>
													  <li class="dd-item dd3-item" data-id="<?php echo $_itemr_id_menu; ?>">												
														<label class="input-group">
														  <span class="input-group-addon">
															<input type="checkbox"  name="menu[<?php echo $num_menu; ?>][id]" value="<?php echo $_itemr_id_menu; ?>" 
																   <?php if(in_array($_itemr_id_menu, $listado_usuario_permisos)){ echo "checked"; } ?> >
														  </span>
														  <div class="form-control"><?php echo $_itemr_name_menu; ?></div>
														</label><!-- /input-group -->  																				  
													  </li>	  
													  <?php  } ?>
												  </ol>
												  <?php } ?>
											  </li>
											  <?php  } ?>	  
										  </ol>

								  <?php } ?>	  
							  </li>
							  <?php  } ?>	
							  <?php } ?>	
							</ul>
							</div>						
					 <?php ####################################################################### ?>
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

