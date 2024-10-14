<?php
	#REGISTRO
	$datos_registro = $datos_reg_home->detalle_registro($id_registro);	
	$detalle_nivel_a = $datos_reg_home->detalle_nivel_superior($id_registro);
	
	$na_id = isset($detalle_nivel_a[0]["id"])?$detalle_nivel_a[0]["id"]:'';
	$na_nombre = isset($detalle_nivel_a[0]["nombre"])?$detalle_nivel_a[0]["nombre"]:'';
	$na_alias = isset($detalle_nivel_a[0]["alias"])?$detalle_nivel_a[0]["alias"]:'';
	$na_tipo = isset($detalle_nivel_a[0]["idtipo"])?$detalle_nivel_a[0]["idtipo"]:'';
	
	$nombre_registro = isset($datos_registro[0]["nombre"])?$datos_registro[0]["nombre"]:'';
	
	?>
	<div class="breadcrumbs">
		<div class="container">
		  <div class="row">
			<div class="col-xs-12">
			  <ul>
				<li class="home"> <a title="Volver a la página principal" href="<?php echo URL_WEB; ?>">Inicio</a> <span>/</span> </li>
				<?php if($na_tipo==1){ ?>  
				<li><a href="<?php echo URL_WEB.$na_alias; ?>"><?php echo $na_nombre; ?></a> <span>/</span> </li>
				<?php }else if($na_tipo==2){
				  $detalle_nivel_b = $datos_reg_home->detalle_nivel_superior($na_id);
				  
					$nb_id = isset($detalle_nivel_b[0]["id"])?$detalle_nivel_b[0]["id"]:'';
					$nb_nombre = isset($detalle_nivel_b[0]["nombre"])?$detalle_nivel_b[0]["nombre"]:'';
					$nb_alias = isset($detalle_nivel_b[0]["alias"])?$detalle_nivel_b[0]["alias"]:'';						
				?>  
				<li><a href="<?php echo URL_WEB.$nb_alias; ?>"><?php echo $nb_nombre; ?></a> <span>/</span> </li>  
				<li><a href="<?php echo URL_WEB.$na_alias; ?>"><?php echo $na_nombre; ?></a> <span>/</span> </li>  
				<?php } ?>
				<li> <strong><?php echo $nombre_registro; ?></strong> </li>
				
			  </ul>
			</div>
		  </div>
		</div>
	</div>  
