<?php
include URL_ROOT_ADMIN."modulos/mod_config/clases/class.config.permisos.php";
include URL_ROOT_ADMIN."modulos/mod_config/clases/class.menu.principal.php";
include URL_ROOT_ADMIN."funciones/general.php";

$url_form_guardar = URL_WEB_ADMIN."modulos/$get_modulo/scripts/config.permisos.script.php";
$url_form_eliminar = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete";
$url_form_eliminar_imagen = $url_form_guardar."?modulo=$get_modulo&option=$get_option&token=$get_token&action=delete_imagen";
$url_nuevo = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&action=new";
$url_cancelar = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token";
$url_cerrar = URL_WEB_ADMIN."?token=$get_token";

$url_guardar = "guardar_permiso();";
$datos_permisos= new config_permisos();

$listado_permisos = $datos_permisos->detalle_permisos($get_id);
if(count($listado_permisos) == 0)
{
	if($get_action != "new") $get_action = '';	
	$item_tipo = "";
}
else
{
	$item_tipo = $listado_permisos[0]["tipo"];
}
/*
$listado_tipo_usuario = $datos_usuario->listar_tipo_usuario();
$listado_info_contacto = $datos_general->detalle_dato_info($get_id,'mod_empresa_personal');
$listado_tipo_info = $datos_general->listado_dato_tipo_info();
$listado_usuario_estado = $datos_usuario->listar_usuario_estado();
*/
$listado_usuario_permisos = $datos_permisos->listado_permisosxid($get_id, 1);
if(count($listado_usuario_permisos) > 0)
{
	$listado_usuario_permisos = explode(",", $listado_usuario_permisos[0]["idmenu"]);
}
?>
<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Registro permisos</h1>
</div>
<?php
	header_buttons($url_guardar, $get_action, $url_nuevo, $url_cerrar, $url_cancelar);
?>
<div class="wrapper-md" ng-controller="FormDemoCtrl">
<?php
if($get_action == '' or $get_action == 'lista')
{
	include URL_ROOT_ADMIN."modulos/mod_config/ajax/listado.config.permisos.php";
}
else if($get_action=='edit' or $get_action=='new')
{
?>	
	
  <form class="form-horizontal" method="post" action="<?php echo $url_form_guardar; ?>" enctype="multipart/form-data">        
		<div>
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#block-1" aria-controls="block-1" role="tab" data-toggle="tab">Detalle</a></li>
			<li role="presentation"><a href="#block-2" aria-controls="block-2" role="tab" data-toggle="tab">Permiso</a></li>
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
 						
						layers(1, "Tipo", "tipo", "Ingrese el nombre del tipo de permisos", "", $item_tipo); 						
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
					 Permisos
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

