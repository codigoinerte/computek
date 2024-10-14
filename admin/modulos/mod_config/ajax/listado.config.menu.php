<?php $url_editar = URL_WEB_ADMIN."?modulo=$get_modulo&option=$get_option&token=$get_token&action=edit&ID="; ?>

	<div class="panel panel-default">
  	<div class="panel-heading font-bold">
      Menús
    </div>
    <div class="panel-body">
      <form class="form-horizontal" method="get">        
		<div ui-jq="nestable" class="dd">
        <ol class="dd-list">
		  <?php
			$data_pmenu = $datos_menu->listado_menu(1, 1);
			if(count($data_pmenu) > 0)
			{
				foreach($data_pmenu as $item){
					
					$_item_name_menu = isset($item["nombre"])?$item["nombre"]:'';
					$_item_id_menu = isset($item["id"])?$item["id"]:0;
					$_item_orden_menu = isset($item["orden"])?$item["orden"]:0;
		  ?>	
          <li class="dd-item dd3-item" data-id="<?php echo $_item_id_menu; ?>">
              <div class="dd-handle dd3-handle">Drag</div>
			  <div class="dd3-content">
				  <?php echo $_item_name_menu; ?>
				  <div class="pull-right box-icon-menu">
					  <a style="cursor: pointer" id="<?php echo $_item_id_menu; ?>" onClick="eliminar(this.id, '<?php echo $url_eliminar; ?>')" ><i class="fa fa-times"></i></a>
					  &nbsp;
					  &nbsp;
					  <a href="<?php echo $url_editar.$_item_id_menu; ?>"><i class="fa fa-edit"></i></a>				  
				  </div>
			  </div>
			  <?php $data_pcategoria = $datos_menu->listado_menu(1, 2, $_item_id_menu);
			  		if(count($data_pcategoria) > 0){						
			  ?>
              <ol class="dd-list">
				  <?php foreach($data_pcategoria as $itemc){
					$_itemc_name_menu = isset($itemc["nombre"])?$itemc["nombre"]:'';
					$_itemc_id_menu = isset($itemc["id"])?$itemc["id"]:0;
					$_itemc_orden_menu = isset($itemc["orden"])?$itemc["orden"]:0;
				  ?>
                  <li class="dd-item dd3-item" data-id="<?php echo $_itemc_id_menu; ?>">
                      <div class="dd-handle dd3-handle">Drag</div>
					  <div class="dd3-content">
						  <?php echo $_itemc_name_menu; ?>
						  <div class="pull-right box-icon-menu">
							  <a style="cursor: pointer" id="<?php echo $_itemc_id_menu; ?>" onClick="eliminar(this.id, '<?php echo $url_eliminar; ?>')"><i class="fa fa-times"></i></a>
							  &nbsp;
							  &nbsp;
							  <a href="<?php echo $url_editar.$_itemc_id_menu; ?>"><i class="fa fa-edit"></i></a>				  
						  </div>
					  </div>
					  <?php
				  	  $data_scategoria = $datos_menu->listado_menu(1, 3, $_itemc_id_menu);
				  	  if(count($data_scategoria) > 0){
				  	  ?>
					  <ol class="dd-list">
						  <?php foreach($data_scategoria as $ritem){
							$_itemr_name_menu = isset($ritem["nombre"])?$ritem["nombre"]:'';
							$_itemr_id_menu = isset($ritem["id"])?$ritem["id"]:0;
							$_itemr_orden_menu = isset($ritem["orden"])?$ritem["orden"]:0;
						  ?>
						  <li class="dd-item dd3-item" data-id="<?php echo $_itemr_id_menu; ?>">
						  	<div class="dd-handle dd3-handle">Drag</div>
							<div class="dd3-content">
								<?php echo $_itemr_name_menu; ?>
							  <div class="pull-right box-icon-menu">
								  <a style="cursor: pointer" id="<?php echo $_itemr_id_menu; ?>" onClick="eliminar(this.id, '<?php echo $url_eliminar; ?>')"><i class="fa fa-times"></i></a>
								  &nbsp;
								  &nbsp;
								  <a href="<?php echo $url_editar.$_itemr_id_menu; ?>"><i class="fa fa-edit"></i></a>				  
							  </div>
								
							</div>						  
						  </li>	  
						  <?php } ?>
					  </ol>
					  <?php } ?>
                  </li>
				  <?php } ?>	  
              </ol>
			  
			  <?php } ?>	  
          </li>
		  <?php } ?>	
		  <?php } ?>	
        </ol>
        </div>
		  <?php
		 layers_hidden($get_id, $get_modulo, $get_option, $get_action, $get_token); 
		 layers(); 		  
		  ?>
      </form>
    </div>
 </div>	 
