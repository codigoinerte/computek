  <footer class="footer">
    <div class="newsletter-wrap">
      <div class="container">
		<?php
		$respuesta = isset($_GET["suscripcion"])?$_GET["suscripcion"]:0;
		if($respuesta==1)
		{
			$mensaje ="Gracias por suscribirse a nuestro Newsletter";	
		}
		else if($respuesta==2)
		{
			$mensaje="Ah ocurrido un error vuelva a intentarlo mas tarde";	
		}
		else if($respuesta==3)
		{			
			$mensaje ="Usted ya esta suscrito a nuestro Newsletter";
		}
		else if($respuesta==4)
		{
			$mensaje="Debe completar todos los campos requeridos para suscribirse";
		}
		else if($respuesta== 9)
		{
			$mensaje="Usted se ah desuscrito de nuestro Newsletter";	
		}
		else
		{
			$mensaje="Ah ocurrido un error vuelva a intentarlo mas tarde";	
		}  
		if($respuesta > 0)
		{
			?>
		  	<div class="alert alert-info alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong><?php echo $mensaje; ?></strong>
				</div>
		  	<?php
		}
		?>  
        <div class="row">
          <div class="col-xs-12">
            <div class="newsletter">
              <form action="<?php echo URL_WEB."librerias/mod_contactenos/parse.suscripcion.php"?>" method="post">
                <div>
                  <h4><span>Boletin</span></h4>
                  <input type="text" placeholder="Ingrese su correo para recibir ultimas ofertas" class="input-text" title="Ingrese su correo para recibir ultimas ofertas" name="email">
				  <input type="hidden" name="suscripcion" value="1"> 
                  <button class="subscribe" title="Subscribete" type="submit"><span>Subscribete</span></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--newsletter-->
 <?php	
$cache_file=URL_ROOT_ADMIN."cache/".md5(URL_WEB."cache_footer_web".$_alias).".php"; 
$cache_var='';
if(!file_exists($cache_file))
{
	
  $cache_var.='   
    <div class="footer-middle">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-12">';
            $cache_var.=mostrar_modulo_web(100, 5);
          $cache_var.='   </div>          
          <div class="col-md-3 col-sm-6">
            <div class="footer-column pull-left">
              <h4>Informaci&oacute;n</h4>
			  <ul class="links">';
				 $listado_informacion = $datos_reg_home->listar_registro_relacionados(110, 3);
				 if(count($listado_informacion) > 0)
				 {
					 foreach($listado_informacion as $item)
					 {
						 $item_nombre = isset($item["nombre"])?$item["nombre"]:'';
						 $item_alias = isset($item["alias"])?URL_WEB.$item["alias"]:'';
						
				  		 $cache_var.='<li><a href="'.$item_alias.'" title="'.$item_nombre.'">'.$item_nombre.'</a></li>';
				  		
					 }
				 }
				
                $cache_var.='<li><a href="'.URL_WEB.'sobre-nosotros" title="Sobre nosotros">Sobre nosotros</a></li>
                <li><a href="'.URL_WEB.'contactenos" title="Sobre nosotros">Contactenos</a></li>';
                
              $cache_var.='</ul>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <h4>Contactenos</h4>
            <div class="contacts-info">';
              $cache_var.=contacto_empresa(5, 1);	
              $cache_var.=contacto_empresa(4, 2); 
              $cache_var.=contacto_empresa(2, 0); 
            $cache_var.='</div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <div class="social">
              <ul>';                                
				$cache_var.=contacto_empresa(6);  
				$cache_var.=contacto_empresa(7);  
				$cache_var.=contacto_empresa(8);  
				$cache_var.=contacto_empresa(9);  				  
              $cache_var.='</ul>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6">';
				$cache_var.=mostrar_modulo_web(95, 4);
         $cache_var.='</div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-5 col-xs-12 coppyright"> &copy; '.(date("Y")).'. Todos los derechos reservados.</div>          
        </div>
      </div>
    </div>
  </footer>
  <!-- End Footer --> 
</div>

<!-- mobile menu -->
<div id="mobile-menu">
  <ul>
	  
    <li>
      <div class="mm-search">
       <form action="'.URL_WEB.'buscador" method="post">
		<input id="search" type="text" name="buscar" placeholder="Ingrese su busqueda..." class="searchbox" maxlength="128">
		<button type="submit" title="Search" class="search-btn-bg">
			<span><i class="fa fa-search"></i></span>
		</button>
	</form>
      </div>
    </li>';
		
		$active1=$active2=$active3=$active5=$active6=$active7=$active8=$active99="";
		if($_alias=='index')
		{
		$active1='active';		
		}
		else if($_alias=='sobre-nosotros')
		{
		$active2='active';
		}
		else if($_alias=='contactenos')
		{
		$active99='active';
		}
			
		$cache_var.='<li><a href="'.URL_WEB.'" class="'.$active1.'"><span>Inicio</span></a></li>
		<li><a href="'.URL_WEB.'sobre-nosotros" class="'.$active2.'"><span>Nosotros</span></a></li>';
		$listado_menu = $datos_reg_home->listar_categoriasxpagina(2);
		if(count($listado_menu) > 0)
		{
			foreach($listado_menu as $item)
			{
				$item_nombre = isset($item["nombre"])?$item["nombre"]:'';
				$item_alias = isset($item["alias"])?URL_WEB.$item["alias"]:'';
			
				$cache_var.='<li><a href="'.$item_alias.'" class="'.(($item["alias"]==$_alias)?'active':'').'"><span>'.$item_nombre.'</span></a></li>';
			}
		} 				
		$cache_var.='<li><a href="'.URL_WEB.'contactenos" class="'.$active99.'"><span>Contactenos</span></a></li>';	
  $cache_var.='</ul>
  </div>';
	
	file_put_contents($cache_file, $cache_var, FILE_APPEND | LOCK_EX);
	echo $cache_var;	
}
else
{
	include $cache_file ;
}
?>
<!-- JavaScript --> 
<script src="<?php echo URL_WEB; ?>js/jquery.min.js"></script> 
<script src="<?php echo URL_WEB; ?>js/bootstrap.min.js"></script> 
<script src="<?php echo URL_WEB; ?>js/revslider.js"></script> 
<script src="<?php echo URL_WEB; ?>js/common.js"></script> 
<script src="<?php echo URL_WEB; ?>js/owl.carousel.min.js"></script> 
<script src="<?php echo URL_WEB; ?>js/jquery.mobile-menu.min.js"></script> 
<script src="<?php echo URL_WEB; ?>js/countdown.js"></script> 
<script src="<?php echo URL_WEB; ?>js/cloud-zoom.js"></script> 
<script src="<?php echo URL_WEB; ?>js/jquery.fancybox.min.js"></script> 
<script src="<?php echo URL_WEB; ?>js/responsiveslides.min.js"></script> 
<script>
jQuery(document).ready(function() {
jQuery('#rev_slider_4').show().revolution({
dottedOverlay: 'none',
delay: 5000,
startwidth: 1140,
startheight: 530,
hideThumbs: 200,
thumbWidth: 200,
thumbHeight: 50,
thumbAmount: 2,
navigationType: 'thumb',
navigationArrows: 'solo',
navigationStyle: 'round',
touchenabled: 'on',
onHoverStop: 'on',
swipe_velocity: 0.7,
swipe_min_touches: 1,
swipe_max_touches: 1,
drag_block_vertical: false,
spinner: 'spinner0',
keyboardNavigation: 'off',
navigationHAlign: 'center',
navigationVAlign: 'bottom',
navigationHOffset: 0,
navigationVOffset: 20,
soloArrowLeftHalign: 'left',
soloArrowLeftValign: 'center',
soloArrowLeftHOffset: 20,
soloArrowLeftVOffset: 0,
soloArrowRightHalign: 'right',
soloArrowRightValign: 'center',
soloArrowRightHOffset: 20,
soloArrowRightVOffset: 0,
shadow: 0,
fullWidth: 'on',
fullScreen: 'off',
stopLoop: 'off',
stopAfterLoops: -1,
stopAtSlide: -1,
shuffle: 'off',
autoHeight: 'off',
forceFullWidth: 'on',
fullScreenAlignForce: 'off',
minFullScreenHeight: 0,
hideNavDelayOnMobile: 1500,
hideThumbsOnMobile: 'off',
hideBulletsOnMobile: 'off',
hideArrowsOnMobile: 'off',
hideThumbsUnderResolution: 0,
hideSliderAtLimit: 0,
hideCaptionAtLimit: 0,
hideAllCaptionAtLilmit: 0,
startWithSlide: 0,
fullScreenOffsetContainer: ''
});
});
</script> 
<!-- Hot Deals Timer 1--> 
<script>
var dthen1 = new Date("12/25/17 11:59:00 PM");
	start = "08/04/15 03:02:11 AM";
	start_date = Date.parse(start);
	var dnow1 = new Date(start_date);
	if (CountStepper > 0)
	ddiff = new Date((dnow1) - (dthen1));
	else
	ddiff = new Date((dthen1) - (dnow1));
	gsecs1 = Math.floor(ddiff.valueOf() / 1000);
	
	var iid1 = "countbox_1";
	CountBack_slider(gsecs1, "countbox_1", 1);
</script>
<script>
$(".rslides").responsiveSlides({
  auto: true,            
  speed: 500,            
  timeout: 4000,          
  pager: false,           
  nav: false,             
  random: false,          
  pause: false,           
  pauseControls: true,    
  prevText: "Previous",   
  nextText: "Next",       
  maxwidth: "",           
  navContainer: "",       
  manualControls: "",     
  namespace: "rslides",   
  before: function(){},   
  after: function(){}     
});
</script>
<!--Start of Tawk.to Script
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5cb62c57d6e05b735b42edd4/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
End of Tawk.to Script-->
	  
<script>
function load_quick_view(id)		  
{
   $.fancybox({
        width: 400,
        height: 400,
        autoSize: false,
        href: '<?php echo URL_WEB; ?>librerias/mod_registros/vista.rapida.php?id='+id,
        type: 'ajax'
    });
}
function external_link(link)
{
 window.location.href = link;
}
</script>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v3.3'
    });
  };

  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="2137249206515009"
  theme_color="#0085ff"
  logged_in_greeting="Hola! buen día, deseas recibir mayor información de nuestros productos?"
  logged_out_greeting="Hola! buen día, deseas recibir mayor información de nuestros productos?">
</div>	  
</body>
</html>