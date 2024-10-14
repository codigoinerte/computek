  <!-- end nav -->
<?php
	
$cache_file=URL_ROOT_ADMIN."cache/".md5(URL_WEB."cache_slider_home_page").".php"; 

$cache_var = '';
if(!file_exists($cache_file))
{	
	
	$listado_slider = $datos_reg_home->listar_registroxtipo(12);
	if(count($listado_slider) > 0)
	{	
	
	  $cache_var.='<div class="container">
		<div class="row">
		  <div class="col-xs-12">
			<div class="home-slider full-width">
			  <div id="rev_slider_4_wrapper" class="rev_slider_wrapper fullwidthbanner-container">
				<div id="rev_slider_4" class="rev_slider fullwidthabanner">
				  <ul>';
					 foreach($listado_slider as $item){
					  $titulo = isset($item["nombre"])?$item["nombre"]:'';
					  $descripcion = isset($item["descripcion"])? strip_tags($item["descripcion"]):'';
					  $url = isset($item["url"])?$item["url"]:'';
					  $iddestacado = isset($item["iddestacado"])?$item["iddestacado"]:0;
					  $imagen = isset($item["imagen_principal"])?URL_WEB."images/media/".$item["imagen_principal"]:'';
					  
					  if($url!==''){ $novo_link=URL_WEB.$url; }else{ $novo_link=URL_WEB.'contactenos'; }
						 
					  $full_link= ($iddestacado==1)?'style="cursor:pointer;" onclick="javascript:external_link(\''.$novo_link.'\');"':'';	
						 
						 
					$cache_var.='<li '.$full_link.' data-transition="random" data-slotamount="7" data-masterspeed="1000" data-thumb="'.$imagen.'">
						<img src="'.$imagen.'" alt="slide-img" data-bgposition="left top" data-bgfit="cover" data-bgrepeat="no-repeat" />
					  <div class="info">';
					if($titulo!=='' && $iddestacado==0)
					{  
					$cache_var.='<div class="tp-caption ExtraLargeTitle sft  tp-resizeme " data-endspeed="500" data-speed="500" data-start="1100" data-easing="Linear.easeNone" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index:2;white-space:nowrap;"><span>Super ventas</span> </div>
						<div class="tp-caption LargeTitle sfl  tp-resizeme " data-endspeed="500" data-speed="500" data-start="1300" data-easing="Linear.easeNone" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index:3;white-space:nowrap;"><span>'.$titulo.'</span> </div>';
					}
						if($descripcion!=='' && $iddestacado==0)
						{
							$cache_var.='<div class="tp-caption Title sft  tp-resizeme " data-endspeed="500" data-speed="500" data-start="1450" data-easing="Power2.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index:4;white-space:nowrap;">'.$descripcion.'</div>';
						}
						$cache_var.='<div class="tp-caption sfb  tp-resizeme " data-endspeed="500" data-speed="500" data-start="1500" data-easing="Linear.easeNone" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index:4;white-space:nowrap;">';
						 if($iddestacado==0)
						 {
							if($url!==''){ 
							$cache_var.='<a href="'.URL_WEB.$url.'" class="buy-btn">Ver m&aacute;s</a>';
							 }else{
							$cache_var.='<a href="'.URL_WEB.'contactenos" class="buy-btn">Contactenos</a>';
							 }
						 }
						$cache_var.='</div>
					  </div>
					</li>';
					 }
				  $cache_var.='</ul>
				</div>
			  </div>
			</div>
		  </div>
		</div>
	  </div>';
		
	}
	file_put_contents($cache_file, $cache_var, FILE_APPEND | LOCK_EX);
	echo $cache_var;
}
else
{
	include $cache_file ;
}
?>