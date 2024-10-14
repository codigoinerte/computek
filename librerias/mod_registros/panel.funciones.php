<?php
function mostrar_url_social($id)
{
	$datos_articulo =  new articulo();
	$array_url = $datos_articulo->listar_datosxtipoxid(8,$id);
	$url = isset($array_url[0]["url"])?$array_url[0]["url"]:'#';
	$icono = isset($array_url[0]["resumen"])?$array_url[0]["resumen"]:'';
	
	if(count($array_url) >0)
	{
		echo "<a href=\"".$url."\" target=\"_blank\">".$icono."</a>";
	}
}

function mostrar_texto_link($id,$target = 1)
{
	$datos_articulo =  new articulo();
	$array_url = $datos_articulo->listar_datosxtipoxid(8,$id);
	
	$nombre = isset($array_url[0]["titulo"])?$array_url[0]["titulo"]:'';
	$url = isset($array_url[0]["url"])?$array_url[0]["url"]:'#';
	$icono = isset($array_url[0]["resumen"])?$array_url[0]["resumen"]." ":'';
	
	if($url != "#")
	{
		if($target==1)
		{
			$target = "target=\"_blank\"";
		}
		else
		{
			$target = "target=\"_parent\"";
		}
		
		$result = "<a href=\"".$url."\" >".$icono.$nombre."</a>";
	}	
	else
	{
		$result = $icono.$nombre;		
	}
	
	echo $result;

}

function mostrar_modulo_web($id, $tipo=0)
{
	$var='';
	$datos_reg_home = new registros_home();
	$array_modulo = $datos_reg_home->listar_registroxtipoxid(11, $id);
	if(count($array_modulo) > 0)
	{
		$nombre = isset($array_modulo[0]["nombre"])?$array_modulo[0]["nombre"]:'';
		$url = isset($array_modulo[0]["url"])?$array_modulo[0]["url"]:'';
		$resumen = isset($array_modulo[0]["resumen"])?$array_modulo[0]["resumen"]:'';
		$descripcion = isset($array_modulo[0]["descripcion"])?$array_modulo[0]["descripcion"]:'';
		$imagen = isset($array_modulo[0]["imagen_principal"])?URL_WEB."images/media/".$array_modulo[0]["imagen_principal"]:'';
		
		if($tipo==0)
		{
			$var.=$descripcion;
		}
		else if($tipo==1)
		{
			
				$var.='<a href="'.(($url=='')?URL_WEB:$url).'">
					<img alt="Free Shipping" src="'.$imagen.'">
				</a>';
			
		}
		else if($tipo==2)
		{
			$listado_imagenes = $datos_reg_home->listar_registro_relacionados($id, 4);
			if(count($listado_imagenes) > 0)
			{
			
			$var.='<div class="custom-slider-inner">
          <div class="home-custom-slider">
            <div>
              <div id="carousel-example-generic'.$id.'" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">';
				  
				  $a=0;
				  foreach($listado_imagenes as $imagen)
				  {
				   $active=($a==0)?'class="active"':"";	  
                   $var.='<li '.$active.'  data-target="#carousel-example-generic'.$id.'" data-slide-to="'.$a.'"></li>';
				   $a++;
				  } 
                $var.='</ol>
                <div class="carousel-inner">';
				 
				  $b=0;
				  foreach($listado_imagenes as $imag){
					$img_nombre = isset($imag["nombre"])?$imag["nombre"]:'';
					$img_imagen = isset($imag["imagen"])?URL_WEB."images/media/".$imag["imagen"]:'';
				  	$active=($b==0)?"active":"";
                  $var.='<div class="item '.$active.' ">';
					 $var.='<div class="bg-cover" style="background: url(\''.$img_imagen.'\')">
						<img src="'.URL_WEB.'images/bg-galeria.png" alt="'.$img_nombre.'">  
					</div>  
					
					  
                    <div class="carousel-caption">
                      <h3><a><strong>'.$img_nombre.'</strong></a></h3>
                      <a target="_blank" class="link" href="'.URL_WEB.$url.'">ver m&aacute;s</a></div>
                  </div>';
				   $b++; }		                 
					
                 $var.='</div>
                <a class="left carousel-control" href="#" data-slide="prev"> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#" data-slide="next"> <span class="sr-only">Next</span> </a></div>
            </div>
          </div>
        </div>';
			
			}
		}
		else if($tipo==3)
		{
			
			   $var.='<div class="feature-box first">
				   '.$resumen.'
				  <div class="content">
					  <h3>'.$nombre.'</h3>
					  '.(strip_tags($descripcion)).'
				  </div>
			  </div>';
			
		}
		else if($tipo==4)
		{
			
			 $var.='<div class="payment-accept">';
				
				$listado_imagenes = $datos_reg_home->listar_registro_relacionados($id, 4);
				if(count($listado_imagenes) > 0)
				{
					foreach($listado_imagenes as $imag)
					{
						$img_nombre = isset($imag["nombre"])?$imag["nombre"]:'';
						$img_imagen = isset($imag["imagen"])?URL_WEB."images/media/".$imag["imagen"]:'';				
						$var.='<img src="'.$img_imagen.'" alt="'.$img_nombre.'">';				
					}
				}
			 $var.='</div>';
			
		}
		else if($tipo==5)
		{
			
			 $var.='<div class="footer-column pull-left">
			  <h4>'.$nombre.'</h4>
			  <img src="'.$imagen.'" alt="" width="100">	
			  '.$descripcion.'
			</div>';
			
		}
	}
	return  $var;
}

function modulo_mapa($id)
{
	$datos_reg_home = new registros_home();
	$array_modulo = $datos_reg_home->listar_registroxtipoxid(11, $id);
	$descripcion = isset($array_modulo[0]["descripcion"])?$array_modulo[0]["descripcion"]:'';
	
	return strip_tags($descripcion,"<iframe>");	
}
function contacto_empresa($tipo_dato, $tipo=0, $tabla='mod_empresa', $idregistro=1)
{
	$var='';
	$datos_registro = new registros_home();
	$detalle_info = $datos_registro-> info_empresa($tabla, $tipo_dato, $idregistro, 1);	
	if(count($detalle_info) > 0)
	{
		$icono = isset($detalle_info[0]["icono"])?$detalle_info[0]["icono"]:'';
		$dato = isset($detalle_info[0]["dato"])?$detalle_info[0]["dato"]:'';

		if($tipo_dato==4) #Whatsapp
		{
			if($tipo==1)
			{
							
				$var.='<div class="info-contacto">
					'.$icono.'
					<span>
						<a href="https://wa.me/51'.$dato.'">'.$dato.'</a>
					</span>	
				</div>';				
				
			}
			else if($tipo==2)
			{
				
				$var.='<div class="phone-footer">
				 '.$icono.' '.$dato.'
				</div>';	
				
			}
			else
			{
				$var.='<div class="info-contacto-whatsapp">
					<a target="_blank" href="https://wa.me/51'.$dato.'">'.$icono.' '.$dato.'</a>						
				</div>';								
			}
		}
		else if($tipo_dato==5) #Direccion
		{
			if($tipo==1)
			{
				
				$var.='<address>'.$icono.' '.$dato.'</address>';
				
			}
			else
			{
			$var.='<div class="info-contacto direccion">
						'.$icono.'
						<span>
							<a href="https://wa.me/51'.$dato.'">'.$dato.'</a>
						</span>	
					</div>';			
			}
		}
		else if($tipo_dato==2) #Celular
		{
			$var.='<div class="phone-footer">'.$icono.' '.$dato.'</div>';
			
		}
		else if($tipo_dato==6) #Facebook
		{
			$var.='<li class="fb"><a href="'.$dato.'"></a></li>';
		}
		else if($tipo_dato==7) #Twitter
		{
			$var.='<li class="tw"><a href="'.$dato.'"></a></li>';
		}
		else if($tipo_dato==8) #Instagram
		{
			$var.='<li class="instagram"><a href="'.$dato.'"></a></li>';
		}
		else if($tipo_dato==9) #Skype
		{
			$var.='<li class="skype"><a href="'.$dato.'"></a></li>';
		}
		

	}
	return $var;
}
function contacto_empresa_listado($tipo_dato)
{
	$datos_registro = new registros_home();
	$detalle_info = $datos_registro-> info_empresa("mod_empresa", $tipo_dato, 1);		
	$var='';
	if($detalle_info > 0)
	{
		$titulo = isset($detalle_info[0]["nombre"])?$detalle_info[0]["nombre"]:'';
		$icono = isset($detalle_info[0]["icono"])?$detalle_info[0]["icono"]:'';
		
		$var.='<h4>'.$icono." ".$titulo.'</h4>';
		$var.='<ol>';
			foreach($detalle_info as $item)
			{
				$icono = isset($item["icono"])?$item["icono"]:'';
				$dato = isset($item["dato"])?$item["dato"]:'';

				$var.='<li>'.$dato.'</li>';
			}
		$var.='</ol>';		
	}
	return $var;
}
function listado_item_producto($item)
{
	$item_id = isset($item["id"])?$item["id"]:'';
	$item_producto = isset($item["nombre"])?$item["nombre"]:'';
	$item_imagen = isset($item["imagen_principal"])?$item["imagen_principal"]:'';
	$item_imagen_destacada = isset($item["imagen_destacada"])?$item["imagen_destacada"]:'';
	
	if($item_imagen_destacada=='')
	{
		if($item_imagen!=='' && file_exists(URL_ROOT."images/media/th/".$item_imagen))
		{
			$item_imagen_destacada=URL_WEB."images/media/th/".$item_imagen;	
		}
		else
		{
			$item_imagen_destacada=URL_WEB."images/media/".$item_imagen;	
		}
		
		
	}
	else
	{
		$item_imagen_destacada=URL_WEB."images/media/th/".$item_imagen_destacada;
	}
	
	$item_idtipo = isset($item["idtipo"])?URL_WEB.$item["idtipo"]:0;
	$item_alias = isset($item["alias"])?URL_WEB.$item["alias"]:'';

	$item_precio = isset($item["precio"])?$item["precio"]:0;
	$item_precio_first = isset($item["precio"])?$item["precio"]:0;
	$item_descuento = isset($item["descuento"])?$item["descuento"]:0;
	
	$item_stock = isset($item["stock"])?$item["stock"]:0;
	$item_marca = isset($item["marca"])?$item["marca"]:"";
	$item_estado = isset($item["estado"])?$item["estado"]:"";

	if($item_descuento>0)
	{
		$item_precio=$item_precio-(($item_precio*$item_descuento)/100);
	}	
	?>
	<div class="item-inner">
	  <div class="item-img">
		<div class="item-img-info">
			<a class="product-image" title="<?php echo $item_producto; ?>" style="cursor: pointer;"  data-fancybox data-type="iframe" data-src="<?php echo URL_WEB."vista.rapida.php?alias=".$item["alias"]; ?>" href="javascript:;">									
				<img alt="<?php echo $item_producto; ?>" class="bg-contain" style="background: url('<?php echo $item_imagen_destacada; ?>')" src="<?php echo URL_WEB."images/bg-producto.png" ?>">									
			</a>
		  <?php if($item_descuento > 0){ ?>	
		  <div class="sale-label sale-top-left"><?php echo $item_descuento." %"; ?></div>
		  <?php } ?>	
		  <?php if($item_estado!==''){ ?>	
		  <div class="new-label new-top-right"><?php echo $item_estado; ?></div>
		  <?php } ?>	
		  <div class="box-hover">
			<ul class="add-to-links">
			  <li><a class="link-quickview" style="cursor: pointer;"  data-fancybox data-type="iframe" data-src="<?php echo URL_WEB."vista.rapida.php?alias=".$item["alias"]; ?>" href="javascript:;">Vista rapida</a></li>			  
			</ul>
		  </div>
		</div>
	  </div>
	  <div class="item-info">
		<div class="info-inner">
		  <div class="item-title">
			  <a title="<?php echo $item_producto; ?>" style="cursor: pointer;"  data-fancybox data-type="iframe" data-src="<?php echo URL_WEB."vista.rapida.php?alias=".$item["alias"]; ?>" href="javascript:;"> <?php echo $item_producto; ?> </a>
		  </div>
		  <div class="item-content">
			 <div class="text-center">
			 	<?php
				if($item_stock > 0)
				{
					?>
				 	<span class="badge stock"><i class="fa fa-check" aria-hidden="true"></i> En stock</span>
				 	<?php
				}
				else
				{
					?>
				 	<span class="badge out-stock"><i class="fa fa-times" aria-hidden="true"></i> Sin stock</span>
				 	<?php
				}
				?>
			 </div> 	
			<?php if($item_precio > 0 || $item_idtipo==3){ ?>  
			<div class="rating">
			  <div class="ratings">
				<div class="rating-box">
				  <div style="width:80%" class="rating"></div>
				</div>
				<p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
			  </div>
			</div>
			  
			<div class="item-price">
			  <div class="price-box">
				  <?php if($item_descuento == 0){ ?>
				  <span class="regular-price">
					  <span class="price">S/. <?php echo redondear_precio($item_precio); ?></span>
				  </span>
				  <?php }else{ ?>
				  <div class="price-box">
					  <p class="old-price"><span class="price-label">Precio regular:</span> <span class="price"><?php echo "S/ ".(redondear_precio($item_precio_first)); ?> </span> </p>
					  <p class="special-price"><span class="price-label">Promoci&oacute;n</span> <span class="price"><?php echo "S/ ".(redondear_precio($item_precio)); ?> </span> </p>
					</div>
				  <?php } ?>
			  </div>
			</div>
			<?php } ?>  
			<div class="action">									
				<a href="<?php echo $item_alias; ?>" class="button btn-cart">Leer m&aacute;s</a>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	<?php
}
function sanitizeOutput($buffer) {
    $search = array(
        '/\>[^\S ]+/s',     // Quitamos espacios en blanco después de las etiquetas, excepto los espacios en sí
        '/[^\S ]+\</s',     // Quitamos espacios en blanco antes de las etiquetas, excepto los espacios en sí
        '/(\s)+/s',         // Acortamos los espacios en blanco
        '/<!--(.|\s)*?-->/' // Quitamos los comentarios HTML
    );
 
    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );
 
    $output = preg_replace($search, $replace, $buffer);
 
    return $output;
}
function redondear_precio($precio)
{
	return round($precio, 2);
}
function add3dots($string, $limit)
{
  $repl='...';	
  if(strlen($string) > $limit) 
  {
    return substr($string, 0, $limit) . $repl; 
  }
  else 
  {
    return $string;
  }	
}
function paginacion($numeroRegistros, $pag='')
{
	//tamaño de la pagina 
	$tamPag=8; 
	//pagina actual si no esta definida y limites 
	if($pag=='') 
	{ 
	   $pagina=1; 
	   $inicio=1; 
	   $final=$tamPag; 
	}else{ 
	   $pagina =$pag; 
	} 
	//calculo del limite inferior 
	$limitInf=($pagina-1)*$tamPag; 
	//calculo del numero de paginas 
	$numPags=ceil($numeroRegistros/$tamPag); 
	if(!isset($pagina)) 
	{ 
	   $pagina=1; 
	   $inicio=1; 
	   $final=$tamPag; 
	}else{ 
	   $seccionActual=intval(($pagina-1)/$tamPag);
	   $Prod_Actual=ceil(($pagina-1)/$tamPag);  
	   $inicio=($seccionActual*$tamPag)+1; 
	   $inicio_prod=($Prod_Actual*$tamPag)+1; 
	   if($pagina<$numPags) 
	   { 
		  $final=$inicio+$tamPag-1;
		  $final_prod=$inicio+$tamPag-1;
	   }else{ 
		  $final=$numPags;
		  $final_prod=$numeroRegistros;
	   } 
	   if ($final>$numPags){ 
		  $final=$numPags; 
	   } 
	}
	
	return array($tamPag, $limitInf, $pagina, $numPags, $numeroRegistros, $inicio, $final);
}
function compartir_producto_whatsapp($link="")
{
	$datos_registro = new registros_home();
	$detalle_info = $datos_registro-> info_empresa('mod_empresa', 4, 1, 1);	
	$dato = isset($detalle_info[0]["dato"])?$detalle_info[0]["dato"]:'';
	$var='';
	$link_whatsapp = "https://wa.me/51".$dato."?text=Deseo consultar acerca del siguiente producto. ".URL_WEB.$link;
	
	$var='<a target="_blank" href="'.$link_whatsapp.'" class="btn btn-whatsapp pull-left"><i class="fa fa-whatsapp" aria-hidden="true"></i> COMPRAR AHORA</a>';
	return $var;
	
}
function insertar_estadisticas($id_registro=0)
{	
	  setlocale(LC_TIME,"es_PE.UTF-8");
	  $datos_registro = new registros_home();
      $ip = "";
       if(isset($_SERVER))
       {
           if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
           {
               $ip=$_SERVER['HTTP_CLIENT_IP'];
            }
            elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else
            {
                $ip=$_SERVER['REMOTE_ADDR'];
            }
       }
       else
       {
            if ( getenv( 'HTTP_CLIENT_IP' ) )
            {
                $ip = getenv( 'HTTP_CLIENT_IP' );
            }
            elseif( getenv( 'HTTP_X_FORWARDED_FOR' ) )
            {
                $ip = getenv( 'HTTP_X_FORWARDED_FOR' );
            }
            else
            {
                $ip = getenv( 'REMOTE_ADDR' );
            }
       }  
        // En algunos casos muy raros la ip es devuelta repetida dos veces separada por coma 
       if(strstr($ip,','))
       {
            $ip = array_shift(explode(',',$ip));
       }
	    $array_cantidad = $datos_registro->contar_cantidad_login_admin($ip);
		$cantidad = isset($array_cantidad[0]["cantidad"])?$array_cantidad[0]["cantidad"]:0;
		
		if($cantidad==0)
		{
			#print $geoplugin = unserialize( file_get_contents('https://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']) );
			$meta = $otros = $geoplugin_currencyConverter = $geoplugin_currencySymbol_UTF8 = $geoplugin_currencySymbol = $geoplugin_currencyCode = $geoplugin_timezone = $geoplugin_continentName = $geoplugin_continentCode = $geoplugin_countryName = $geoplugin_countryCode = $geoplugin_city = $geoplugin_regionCode = $geoplugin_latitude = $geoplugin_longitude ='';

			$fecha_ahora = date("Y-m-d G:i:s");	

			$runfile = 'http://www.geoplugin.net/php.gp?ip=' . $ip;
			#$runfile = "https://geoipinfo.org/?ip=$ip";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $runfile);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			$content = curl_exec ($ch);
			curl_close ($ch); 

			if($content!=='')
			{
				$serialize=$content;
				$meta = unserialize($serialize);

				$geoplugin_currencyConverter = isset($meta["geoplugin_currencyConverter"])?$meta["geoplugin_currencyConverter"]:'';
				$geoplugin_currencySymbol_UTF8 = isset($meta["geoplugin_currencySymbol_UTF8"])?$meta["geoplugin_currencySymbol_UTF8"]:'';
				$geoplugin_currencySymbol = isset($meta["geoplugin_currencySymbol"])?$meta["geoplugin_currencySymbol"]:'';
				$geoplugin_currencyCode = isset($meta["geoplugin_currencyCode"])?$meta["geoplugin_currencyCode"]:'';
				$geoplugin_timezone = isset($meta["geoplugin_timezone"])?$meta["geoplugin_timezone"]:'';
				$geoplugin_continentName = isset($meta["geoplugin_continentName"])?$meta["geoplugin_continentName"]:'';
				$geoplugin_continentCode = isset($meta["geoplugin_continentCode"])?$meta["geoplugin_continentCode"]:'';
				$geoplugin_countryName = isset($meta["geoplugin_countryName"])?$meta["geoplugin_countryName"]:'';
				$geoplugin_countryCode = isset($meta["geoplugin_countryCode"])?$meta["geoplugin_countryCode"]:'';
				$geoplugin_city = isset($meta["geoplugin_city"])?$meta["geoplugin_city"]:'';
				$geoplugin_regionCode = isset($meta["geoplugin_regionCode"])?$meta["geoplugin_regionCode"]:'';
				$geoplugin_latitude = isset($meta["geoplugin_latitude"])?$meta["geoplugin_latitude"]:'';
				$geoplugin_longitude = isset($meta["geoplugin_longitude"])?$meta["geoplugin_longitude"]:'';
			}

			#$datos_registro->insertar_visita($ip, $id_registro, $latitud, $longitud, $fecha_ahora, $serialize);
			$datos_registro->insertar_visita($ip, $id_registro, $geoplugin_currencyConverter, $geoplugin_currencySymbol_UTF8, $geoplugin_currencySymbol, $geoplugin_currencyCode, $geoplugin_timezone, $geoplugin_continentName, $geoplugin_continentCode, $geoplugin_countryName, $geoplugin_countryCode, $geoplugin_city, $geoplugin_regionCode, $geoplugin_latitude, $geoplugin_longitude, $fecha_ahora, $otros);
		}
		else
		{
			$datos_registro->eliminar_visitasxip($ip);
		}
}
function is_bot($user_agent) {
 
    $botRegexPattern = "(googlebot\/|Googlebot\-Mobile|Googlebot\-Image|Google favicon|Mediapartners\-Google|bingbot|slurp|java|wget|curl|Commons\-HttpClient|Python\-urllib|libwww|httpunit|nutch|phpcrawl|msnbot|jyxobot|FAST\-WebCrawler|FAST Enterprise Crawler|biglotron|teoma|convera|seekbot|gigablast|exabot|ngbot|ia_archiver|GingerCrawler|webmon |httrack|webcrawler|grub\.org|UsineNouvelleCrawler|antibot|netresearchserver|speedy|fluffy|bibnum\.bnf|findlink|msrbot|panscient|yacybot|AISearchBot|IOI|ips\-agent|tagoobot|MJ12bot|dotbot|woriobot|yanga|buzzbot|mlbot|yandexbot|purebot|Linguee Bot|Voyager|CyberPatrol|voilabot|baiduspider|citeseerxbot|spbot|twengabot|postrank|turnitinbot|scribdbot|page2rss|sitebot|linkdex|Adidxbot|blekkobot|ezooms|dotbot|Mail\.RU_Bot|discobot|heritrix|findthatfile|europarchive\.org|NerdByNature\.Bot|sistrix crawler|ahrefsbot|Aboundex|domaincrawler|wbsearchbot|summify|ccbot|edisterbot|seznambot|ec2linkfinder|gslfbot|aihitbot|intelium_bot|facebookexternalhit|yeti|RetrevoPageAnalyzer|lb\-spider|sogou|lssbot|careerbot|wotbox|wocbot|ichiro|DuckDuckBot|lssrocketcrawler|drupact|webcompanycrawler|acoonbot|openindexspider|gnam gnam spider|web\-archive\-net\.com\.bot|backlinkcrawler|coccoc|integromedb|content crawler spider|toplistbot|seokicks\-robot|it2media\-domain\-crawler|ip\-web\-crawler\.com|siteexplorer\.info|elisabot|proximic|changedetection|blexbot|arabot|WeSEE:Search|niki\-bot|CrystalSemanticsBot|rogerbot|360Spider|psbot|InterfaxScanBot|Lipperhey SEO Service|CC Metadata Scaper|g00g1e\.net|GrapeshotCrawler|urlappendbot|brainobot|fr\-crawler|binlar|SimpleCrawler|Livelapbot|Twitterbot|cXensebot|smtbot|bnf\.fr_bot|A6\-Indexer|ADmantX|Facebot|Twitterbot|OrangeBot|memorybot|AdvBot|MegaIndex|SemanticScholarBot|ltx71|nerdybot|xovibot|BUbiNG|Qwantify|archive\.org_bot|Applebot|TweetmemeBot|crawler4j|findxbot|SemrushBot|yoozBot|lipperhey|y!j\-asr|Domain Re\-Animator Bot|AddThis|YisouSpider|BLEXBot|YandexBot|SurdotlyBot|AwarioRssBot|FeedlyBot|Barkrowler|Gluten Free Crawler|Cliqzbot)";
 
 
    return preg_match("/{$botRegexPattern}/", $user_agent);
 
}
?>
