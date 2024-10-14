<script>
var URL_WEB_ADMIN = '<?php echo URL_WEB_ADMIN; ?>';
</script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/jquery.js"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/bootstrap.js"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/ui-load.js"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/ui-jp.config.js"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/ui-jp.js"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/ui-nav.js"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/ui-toggle.js"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/ui-client.js"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/jquery.fancybox.min.js"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/bootstrap-notify.min.js" type="text/javascript"></script>

<script src="<?php echo URL_WEB_ADMIN; ?>js/chart.js/core/popper.min.js" type="text/javascript"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/chart.js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/chart.js/plugins/chartjs.min.js"></script>
<script src="<?php echo URL_WEB_ADMIN; ?>js/chart.js/plugins/bootstrap-notify.js"></script>

<script type="text/javascript" src="<?php echo URL_WEB_ADMIN; ?>js/maps/zepto.min.js"></script>
<script type="text/javascript" src="<?php echo URL_WEB_ADMIN; ?>js/maps/zepto.adapter.js"></script>
<script type="text/javascript" src="<?php echo URL_WEB_ADMIN; ?>js/maps/jhere.js"></script>
<script type="text/javascript" src="<?php echo URL_WEB_ADMIN; ?>js/maps/clustering.js"></script>	

<script>
function tog(id1,id2)
{
	$("#"+id1).hide();
	$("#"+id2).show();
}
</script>
<?php if($get_option=='' && $SisID!=''){ ?>
	<!--   Core JS Files   -->
	
<script src="<?php echo URL_WEB_ADMIN; ?>js/chart.js/black-dashboard.js?v=1.0.0" type="text/javascript"></script>

	<!--  Google Maps Plugin    
	<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
	-->
	<script>
		    gradientChartOptionsConfigurationWithTooltipGreen = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.0)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 50,
            suggestedMax: 125,
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }],

        xAxes: [{
          barPercentage: 1.6,
          gridLines: {
            drawBorder: false,
            color: 'rgba(0,242,195,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }]
      }
    };
	</script>
	<?php include(URL_ROOT_ADMIN."modulos/mod_estadisticas/estadisticas.usuarios.home.php"); ?>
<?php } ?>

<?php
if($get_msg!=='')
{
	if($get_msg==1)
	{
		$mensaje="El registro fue guardado exitosamente";
		$icon ="fa fa-check";
	}
	else if($get_msg==2)
	{
		$mensaje="El registro fue eliminado exitosamente";
		$icon ="fa fa-check";
	}
	else if($get_msg==3)
	{
		$mensaje="La imagen fue eliminada exitosamente";
		$icon ="fa fa-check";
	}
	else if($get_msg==4)
	{
		$mensaje="El backup fue generado exitosamente";
		$icon ="fa fa-check";
	}	
	else if($get_msg==5)
	{
		$mensaje="El backup fue eliminado exitosamente";
		$icon ="fa fa-check";
	}		
	else if($get_msg==99)
	{
		$mensaje="La cache fue eliminada exitosamente";
		$icon ="fa fa-check";
	}
	
	?>
	<script>
		//$.notify("<?php echo $get_msg; ?>");
		
$.notify({
	// options
	icon: '<?php echo $icon; ?>',
	//title: 'Bootstrap notify',
	message: '<?php echo $mensaje; ?>',
	//url: 'https://github.com/mouse0270/bootstrap-notify',
	target: '_blank'
},{
	// settings
	element: 'body',
	position: null,
	type: "success",
	allow_dismiss: true,
	newest_on_top: false,
	showProgressbar: false,
	placement: {
		from: "top",
		align: "right"
	},
	offset: 20,
	spacing: 10,
	z_index: 1031,
	delay: 5000,
	timer: 1000,
	url_target: '_blank',
	mouse_over: null,
	animate: {
		enter: 'animated fadeInDown',
		exit: 'animated fadeOutUp'
	},
	onShow: null,
	onShown: null,
	onClose: null,
	onClosed: null,
	icon_type: 'class',
	template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0} " role="alert">' +
		'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
		'<span data-notify="icon"></span> ' +
		'<span data-notify="message">{2}</span>' +
		'<div class="progress" data-notify="progressbar">' +
			'<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
		'</div>' +
		'<a href="{3}" target="{4}" data-notify="url"></a>' +
	'</div>' 
});		
	</script>

<?php
	
if (!isset($_SESSION['error_imagen'])) {  
  $errores_imagen =array();
} else {
  $errores_imagen = $_SESSION['error_imagen'];
}	
	
if(count($errores_imagen) > 0)
{
	foreach($errores_imagen as $item)
	{
		
	
	$icon="fa fa-exclamation";
	$nombre_imagen = isset($item["imagen"])?$item["imagen"]:'';
	$error  = isset($item["error"])?$item["error"]:0; 
	if($error==1)
	{
		$mensaje="La imagen excede el tamaño requerido";
	}
	else
	{
		$mensaje="La imagen no pudo ser guardada, intente luego";
	}
		if($error>0)
		{
	?>
	<script>
		//$.notify("<?php echo $get_msg; ?>");
		
$.notify({
	// options
	icon: '<?php echo $icon; ?>',
	//title: 'Bootstrap notify',
	message: '<?php echo $mensaje; ?>',
	//url: 'https://github.com/mouse0270/bootstrap-notify',
	target: '_blank'
},{
	// settings
	element: 'body',
	position: null,
	type: "warning",
	allow_dismiss: true,
	newest_on_top: false,
	showProgressbar: false,
	placement: {
		from: "top",
		align: "right"
	},
	offset: 20,
	spacing: 10,
	z_index: 1031,
	delay: 5000,
	timer: 5000,
	url_target: '_blank',
	mouse_over: null,
	animate: {
		enter: 'animated fadeInDown',
		exit: 'animated fadeOutUp'
	},
	onShow: null,
	onShown: null,
	onClose: null,
	onClosed: null,
	icon_type: 'class',
	template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0} " role="alert">' +
		'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
		'<span data-notify="icon"></span> ' +
		'<span data-notify="message">{2}</span>' +
		'<div class="progress" data-notify="progressbar">' +
			'<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
		'</div>' +
		'<a href="{3}" target="{4}" data-notify="url"></a>' +
	'</div>' 
});		
</script>
	<?php
		}
	}
}
		
	unset($_SESSION['error_imagen']);	
	unset($errores_imagen);	
}
#ob_end_flush();
?>
<script>
var data = [
<?php
$cache_file = URL_ROOT_ADMIN."cache/".md5(URL_WEB."ubicacion_mapa_footer").".php"; 
$cache_var = '';
if(!file_exists($cache_file))
{
    $fecha_actual = date("Y-m-d");
    $fecha_consulta = date("Y-m-d",strtotime($fecha_actual."- 3 days")); 
    
	$datos_estadisticas = new estadisticas();	
	$listado_ubicaciones = $datos_estadisticas->listar_posicion_visitas($fecha_consulta);		  
	if(count($listado_ubicaciones)>0)
	{
	  foreach($listado_ubicaciones as $item)
	  {
		  $longitud=isset($item["longitud"])?$item["longitud"]:'';
		  $latitud=isset($item["latitud"])?$item["latitud"]:'';
		  $cache_var.='
						{
							"longitude":'.$longitud.',
							"latitude":'.$latitud.'
						}, ';	
	  }
	}
	file_put_contents($cache_file, $cache_var, FILE_APPEND | LOCK_EX);
	echo $cache_var;		
}
else
{
	include $cache_file;
}	
?>	  
];
</script>


<script type="text/javascript">
jQuery(window).on('load', function(){
    //Set default credentials
    //$.jHERE.defaultCredentials('1220G0MOv2PBLjLq6tex', '0MM0Lr7hPyqfv3GiPmBOyg');

    jQuery('#map').jHERE({enable: ['behavior', 'zoombar', 'scalebar', 'typeselector','contextmenu'], center: [-12.1508672,-77.0948595], zoom: 5});
    jQuery('#map').jHERE('cluster', data);
});
</script>

 