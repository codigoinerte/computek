<?php
include(URL_ROOT_ADMIN."clases/class.menu.php");
$datos_menu = new menu();
/*
TIPOS:
1: MENU
2: SUBMENU
3: REGISTRO
*/
$listado_menu = $datos_menu->listado_menu(1,1,0,0,$SisID);
?>
		<!-- nav -->
          <nav ui-nav class="navi clearfix">
            <ul class="nav">
              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span>Men&uacute; de navegaci&oacute;n</span>
              </li>
              <li>
                <a href="<?php echo (URL_WEB_ADMIN."?token=$get_token"); ?>" class="auto">      
                  <i class="glyphicon glyphicon-stats icon text-primary-dker"></i>
				  <!---<b class="label bg-info pull-right">Nsadasd</b>--->
                  <span class="font-bold">Dashboard</span>
                </a>                
              </li>
              <li>
                <a href="<?php echo (URL_WEB_ADMIN."?modulo=mod_config&option=config.mail&token=$get_token"); ?>">
				  <?php if(CANTIDAD_MAIL_PENDIENTES>0){ ?>	
                  <b class="badge bg-info pull-right">
					  <?php echo CANTIDAD_MAIL_PENDIENTES; ?>
				  </b>
				  <?php } ?>	
                  <i class="glyphicon glyphicon-envelope icon text-info-lter"></i>
                  <span class="font-bold">Email</span>
                </a>
              </li>
              <li class="line dk"></li>

              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                <span>Components</span>
              </li>
			  <?php if(count($listado_menu) > 0){ ?>
				<?php foreach($listado_menu as $item){
				$_id_menu = isset($item["id"])?$item["id"]:0;
				$_nom_menu = isset($item["nombre"])?$item["nombre"]:'';				
				?>
              <li>
                <a href class="auto">      
                  <span class="pull-right text-muted">
                    <i class="fa fa-fw fa-angle-right text"></i>
                    <i class="fa fa-fw fa-angle-down text-active"></i>
                  </span>
                  <!--<b class="badge bg-info pull-right">3</b>-->
                  <i class="glyphicon glyphicon-th"></i>
                  <span><?php echo $_nom_menu; ?></span>
                </a>
				<?php
					$array_subnivel = $datos_menu->listado_menu(1,2,$_id_menu,0,$SisID);
				  	if(count($array_subnivel)>0)
					{
				  ?>  
                <ul class="nav nav-sub dk">
                  <?php foreach($array_subnivel as $sitem){
					$_sid = isset($sitem["id"])?$sitem["id"]:0;
					$_snombre= isset($sitem["nombre"])?$sitem["nombre"]:'';
					$_sruta = isset($sitem["ruta"])?$sitem["ruta"]:'';  
					?>
                  <li>
                    <a href="<?php echo (URL_WEB_ADMIN.$_sruta."&token=$get_token"); ?>">
                      <span><?php echo $_snombre; ?></span>
                    </a>
                  </li>
                  <?php } ?>      
                </ul>
				  <?php
					}
				?>		
              </li>
			  	<?php } ?>	
			  <?php } ?>	
              <li class="line dk hidden-folded"></li>

              <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">          
                <span>Tu equipo</span>
              </li>  
              <li>
                <a href="<?php echo $url_perfil_usuario; ?>">
                  <i class="icon-user icon text-success-lter"></i>
                  <b class="badge bg-success pull-right">30%</b>
                  <span>Perfil</span>
                </a>
              </li>
              <li>
                <a href>
                  <i class="icon-question icon"></i>
                  <span>Documentos</span>
                </a>
              </li>
            </ul>
          </nav>
        <!-- nav -->
