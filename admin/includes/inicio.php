<?php if($get_action=='' && $get_option==''){ ?>
<div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
    app.settings.asideFolded = true; 
    app.settings.asideDock = true;
  ">	
	<style>
	thead, tbody { display: block; }
	tbody {
		height: 450px;       /* Just for the demo          */
		overflow-y: auto;    /* Trigger vertical scroll    */
		overflow-x: hidden;  /* Hide the horizontal scroll */
	}
	tbody::-webkit-scrollbar-track
	{
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
		border-radius: 10px;
		background-color: #27293d;
	}	
	tbody::-webkit-scrollbar
	{
		width: 12px;
		background-color: #27293d;
	}	
	tbody::-webkit-scrollbar-thumb
	{
		border-radius: 10px;
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
		background-color: #555;
	}	
	</style>
  <div class="col">
	<div>
		<div class="chart-box card card-chart ">
			<div class="col-xs-12">
				<div class="card" style="margin-top: 30px;margin-bottom: 0px;">
					  <div class="card-header">
						  <div class="row">
							  <div class="col-sm-6 text-left">
								  <h5 class="card-category">Total Visitas</h5>
								  <h3 class="card-title"><i class="icon-users"></i> <?php echo $total_visitas; ?></h3>
							  </div>
							  <div class="col-sm-6 text-right">
							  <!---------------------->
								<div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
								
								  <label class="btn btn-sm btn-primary btn-simple" id="1">
									<input type="radio" class="d-none d-sm-none" name="options">
									<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Semanal</span>
									<span class="d-block d-sm-none">
									  <i class="tim-icons icon-gift-2"></i>
									</span>
								  </label>
								  <label class="btn btn-sm btn-primary btn-simple" id="2">
									<input type="radio" class="d-none" name="options">
									<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">A&ntilde;o</span>
									<span class="d-block d-sm-none">
									  <i class="tim-icons icon-tap-02"></i>
									</span>
								  </label>																		
								  <!---	
								  <label class="btn btn-sm btn-primary btn-simple active" id="0">
									<input type="radio" name="options" checked>
									<span class="d-none d-sm-block d-md-block d-lg-block d-xl-block">Mapa</span>
									<span class="d-block d-sm-none">
									  <i class="tim-icons icon-single-02"></i>
									</span>
								  </label>
								  --->	
								</div>
							  <!---------------------->
							  </div>
						  </div>		  

					  </div>
					  <div class="card-body">
						<div class="chart-area">			  
						  <canvas height="300px" id="chartBig1"></canvas>	
						</div>
					  </div>
				</div>	
			</div>
		</div>  
	</div>
	<div>
		<div class="chart-box card card-chart ">
			<div class="col-xs-12 col-sm-12">
				
				<div id="map" style="height: 300px"></div>
				
			</div>  
		</div>  
	</div>  
	<div>
		<div class="chart-box card card-chart">
			<div class="">
				<!---primer bloque--->
				<div class="col-xs-12 col-sm-12 col-md-7">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-sm-12 text-left">
									<h5 class="card-category">&Uacute;ltimas visitas</h5>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive ps">
								<!------------------------------->
									<?php
										$listado_visitas =$datos_estadisticas->listar_visitas();
									?>		 
									<table class="table tablesorter" id="">
									<thead class=" text-primary">
									  <tr>										
										<th class="col-xs-3" colspan="2">
										  Registro
										</th>
										<th>
										  Continente
										</th>
										<th>
										  Pais
										</th>
										<th>
										  Ciudad	
										</th>
										<th>
										  Fecha
										</th>
									  </tr>
									</thead>
									<tbody>
									  <?php if(count($listado_visitas)>0)
										{ 
											foreach($listado_visitas as $item){
											  $item_registro = isset($item["registro"])?$item["registro"]:'';
											  $item_continente = isset($item["continente"])?$item["continente"]:'';
											  $item_pais = isset($item["pais"])?$item["pais"]:'';
											  $item_ciudad = isset($item["ciudad"])?$item["ciudad"]:'';
											  $item_fecha = isset($item["fecha"])?fecha_castellano_completa($item["fecha"]):'';
											  ?>  
											<tr>
											<td><span class="icon-table"><i class="fa fa-cloud" aria-hidden="true"></i></span></td>
											<td><?php echo $item_registro; ?></td>
											<td><?php echo $item_continente; ?></td>
											<td><?php echo $item_pais; ?></td>
											<td><?php echo $item_ciudad; ?></td>
											<td><?php echo $item_fecha; ?></td>
											</tr>	
											<?php }
										} ?>	
									</tbody>
									</table>					
								<!------------------------------->
							</div>
						</div>
					</div>
				</div>		
				<!---end primer bloque--->
				<!---segundo bloque--->
				<div class="col-xs-12 col-sm-12 col-md-5">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-sm-12 text-left">
									<h5 class="card-category">P&aacute;ginas mas visitadas</h5>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive ps">
								<!------------------------------->
									<?php
										$listado_visitas =$datos_estadisticas->listar_visitas_registros();
									?>		 
									<table class="table tablesorter" id="">
									<thead class=" text-primary">
									  <tr>										
										<th colspan="2">
										  P&aacute;gina
										</th>
										<th width="150">
										  Cant. visitantes
										</th>
									  </tr>
									</thead>
									<tbody>
									  <?php if(count($listado_visitas)>0)
										{ 
											foreach($listado_visitas as $item)
											{
											  $item_registro = isset($item["registro"])?$item["registro"]:'';
											  $item_cantidad = isset($item["cantidad"])?$item["cantidad"]:'';
												if($item_registro!=='')
												{
											  	?>  
												<tr>
												<td><span class="icon-table"><i class="fa fa-file-o" aria-hidden="true"></i></span></td>
												<td><?php echo $item_registro; ?></td>
												<td><?php echo $item_cantidad; ?></td>
												</tr>	
												<?php
												}
											}
										} ?>	
									</tbody>
									</table>					
								<!------------------------------->
							</div>
						</div>
					</div>
				</div>		
				<!---end segundo bloque--->
			</div>
		</div>  
	</div> 
	  
	<!--------------->
	<!--------------->
	  
  </div>
	
  <!-- / main -->
  <!---	
  <div class="col w-md bg-black dk bg-auto">
    <div class="wrapper">
      <div class="m-b-sm text-md">Usuarios</div>
	<?php
	if(count($listado_usuarios) > 0)
	{
		#<i class="on b-white bottom"></i>
		#<i class="off b-white bottom"></i>
		#<i class="busy b-white bottom"></i>
		#<i class="away b-white bottom"></i>
	?>
	
      <ul class="list-group no-bg no-borders pull-in">
  		<?php foreach($listado_usuarios as $item){
		  $user_nombre = isset($item["nombre_usuario"])?$item["nombre_usuario"]:'';
		  $user_tipo = isset($item["tipo"])?$item["tipo"]:'';
		  $user_actividad = isset($item["actividad"])?$item["actividad"]:0;
		  $user_idestado = isset($item["idestado"])?$item["idestado"]:0;
		  $user_imagen = isset($item["imagen"])?URL_WEB_ADMIN."images/".$item["imagen"]:URL_WEB_ADMIN."images/user.png";
			if($user_idestado==1)
			{
				$estado = '<i class="on b-white bottom"></i>';	
			}
			else
			{
				$estado = '<i class="off b-white bottom"></i>';
			}
		?>
        <li class="list-group-item">
          <a herf class="pull-left thumb-sm avatar m-r">
			<div class="bg-cover img-circle" style="background: url(<?php echo $user_imagen; ?>);background-color: #ddd;"> 
				<img src="<?php echo URL_WEB_ADMIN."images/bg-image-user.png"; ?>"  class="img-circle" alt="<?php echo $user_nombre; ?>">
			</div>			  
           <?php echo $estado; ?>
          </a>
          <div class="clear">
            <div><a href><?php echo $user_nombre; ?></a></div>
            <small class="text-muted"><?php echo $user_tipo; ?></small>
          </div>
        </li>
		<?php } ?>
      </ul>
	<?php  
	}
	?>		
    </div>
  </div>
  ---->
</div>
<?php } ?>