<?php
include "../../../funciones/conecta.general.php";
include URL_ROOT_ADMIN."funciones/definition.php";
include URL_ROOT_ADMIN."funciones/funciones.php";
include URL_ROOT_ADMIN."modulos/mod_config/clases/class.config.usuarios.php";
$datos_usuario = new config_usuarios();
$datos_general = new config_general();

$idtipo = isset($_POST["idtipo"])?$_POST["idtipo"]:0;
$cant = isset($_POST["canti"])?$_POST["canti"]:0;
$valor_info = isset($_POST["valor_tipo"])?$_POST["valor_tipo"]:'';

$detalle_tipo = $datos_general->detalle_tipo_info($idtipo);
$nombre_tipo = isset($detalle_tipo[0]["nombre"])?$detalle_tipo[0]["nombre"]:'';
?>

<div id="dat_info_<?php echo $cant; ?>">
<div class="form-group">
	  <label class="col-sm-2 control-label">
		 <span data-toggle="tooltip" data-placement="top" title="Ingrese el nombre del usuario">
		  <?php echo $nombre_tipo; ?>&nbsp;
		  <i class="fa fa-info-circle"></i> 
		 </span>
	  </label>
	  <div class="col-sm-10">
		
		<div class="input-group">
		  <input type="text" class="form-control" name="data[<?php echo $cant; ?>][value]" id="data[<?php echo $cant; ?>][value]" value="<?php echo $valor_info; ?>">
		  <span class="input-group-btn">
			<label class="form-control" data-toggle="tooltip" data-placement="left" title="Seleccione info principal">
				<input type="checkbox" name="data[<?php echo $cant; ?>][principal]" id="data[<?php echo $cant; ?>][principal]" value="1">
			</label>										  										
		  </span>			
		  <span class="input-group-btn">
			<button class="btn btn-danger" type="button" onClick="javascript:eliminar_data_info('dat_info_<?php echo $cant; ?>')"><i class="fa fa-times" aria-hidden="true"></i></button>
		  </span>
		</div> 
		<input type="hidden" name="data[<?php echo $cant; ?>][idtipo]" id="data[<?php echo $cant; ?>][idtipo]" value="<?php echo $idtipo; ?>">
	  </div>
</div>
<div class="line line-dashed b-b line-lg pull-in"></div>
</div>