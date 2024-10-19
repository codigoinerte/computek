<?php
function icreate($filename)
{
  $isize = getimagesize($filename);
  if ($isize['mime']=='image/jpeg')
    return imagecreatefromjpeg($filename);
  elseif ($isize['mime']=='image/png')
    return imagecreatefrompng($filename);
  /* Add as many formats as you can */
}
function resizeAspectW($image, $width)
{
  $aspect = imagesx($image) / imagesy($image);
  $height = $width / $aspect;
  $new = imageCreateTrueColor($width, $height);

  imagecopyresampled($new, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
  return $new;
}
function resizeAspectH($image, $height)
{
  $aspect = imagesx($image) / imagesy($image);
  $width = $height * $aspect;
  $new = imageCreateTrueColor($width, $height);

  imagecopyresampled($new, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
  return $new;
}
function resizeCrop($image, $width, $height, $displ='center')
{
  /* Original dimensions */
  $origw = imagesx($image);
  $origh = imagesy($image);

  $ratiow = $width / $origw;
  $ratioh = $height / $origh;
  $ratio = max($ratioh, $ratiow); /* This time we want the bigger image */

  $neww = $origw * $ratio;
  $newh = $origh * $ratio;

  $cropw = $neww-$width;
  /* if ($cropw) */
  /*   $cropw/=2; */
  $croph = $newh-$height;
  /* if ($croph) */
  /*   $croph/=2; */

  if ($displ=='center')
    $displ=0.5;
  elseif ($displ=='min')
    $displ=0;
  elseif ($displ=='max')
    $displ=1;

  $new = imageCreateTrueColor($width, $height);

  imagecopyresampled($new, $image, -$cropw*$displ, -$croph*$displ, 0, 0, $width+$cropw, $height+$croph, $origw, $origh);
  return $new;
}
function shapeSpace_disk_usage() {
	
	$disktotal = disk_total_space ('/');
	$diskfree  = disk_free_space  ('/');
	$diskuse   = round (100 - (($diskfree / $disktotal) * 100)) .'%';
	
	return $diskuse;
	
}
function is_bot($user_agent) {
 
    $botRegexPattern = "(googlebot\/|Googlebot\-Mobile|Googlebot\-Image|Google favicon|Mediapartners\-Google|bingbot|slurp|java|wget|curl|Commons\-HttpClient|Python\-urllib|libwww|httpunit|nutch|phpcrawl|msnbot|jyxobot|FAST\-WebCrawler|FAST Enterprise Crawler|biglotron|teoma|convera|seekbot|gigablast|exabot|ngbot|ia_archiver|GingerCrawler|webmon |httrack|webcrawler|grub\.org|UsineNouvelleCrawler|antibot|netresearchserver|speedy|fluffy|bibnum\.bnf|findlink|msrbot|panscient|yacybot|AISearchBot|IOI|ips\-agent|tagoobot|MJ12bot|dotbot|woriobot|yanga|buzzbot|mlbot|yandexbot|purebot|Linguee Bot|Voyager|CyberPatrol|voilabot|baiduspider|citeseerxbot|spbot|twengabot|postrank|turnitinbot|scribdbot|page2rss|sitebot|linkdex|Adidxbot|blekkobot|ezooms|dotbot|Mail\.RU_Bot|discobot|heritrix|findthatfile|europarchive\.org|NerdByNature\.Bot|sistrix crawler|ahrefsbot|Aboundex|domaincrawler|wbsearchbot|summify|ccbot|edisterbot|seznambot|ec2linkfinder|gslfbot|aihitbot|intelium_bot|facebookexternalhit|yeti|RetrevoPageAnalyzer|lb\-spider|sogou|lssbot|careerbot|wotbox|wocbot|ichiro|DuckDuckBot|lssrocketcrawler|drupact|webcompanycrawler|acoonbot|openindexspider|gnam gnam spider|web\-archive\-net\.com\.bot|backlinkcrawler|coccoc|integromedb|content crawler spider|toplistbot|seokicks\-robot|it2media\-domain\-crawler|ip\-web\-crawler\.com|siteexplorer\.info|elisabot|proximic|changedetection|blexbot|arabot|WeSEE:Search|niki\-bot|CrystalSemanticsBot|rogerbot|360Spider|psbot|InterfaxScanBot|Lipperhey SEO Service|CC Metadata Scaper|g00g1e\.net|GrapeshotCrawler|urlappendbot|brainobot|fr\-crawler|binlar|SimpleCrawler|Livelapbot|Twitterbot|cXensebot|smtbot|bnf\.fr_bot|A6\-Indexer|ADmantX|Facebot|Twitterbot|OrangeBot|memorybot|AdvBot|MegaIndex|SemanticScholarBot|ltx71|nerdybot|xovibot|BUbiNG|Qwantify|archive\.org_bot|Applebot|TweetmemeBot|crawler4j|findxbot|SemrushBot|yoozBot|lipperhey|y!j\-asr|Domain Re\-Animator Bot|AddThis|YisouSpider|BLEXBot|YandexBot|SurdotlyBot|AwarioRssBot|FeedlyBot|Barkrowler|Gluten Free Crawler|Cliqzbot)";
 
 
    return preg_match("/{$botRegexPattern}/", $user_agent);
 
}
function estadisticas_admin($idusuario=0)
{		  
	 $datos_estadisticas = new estadisticas();
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
	   	
	   $fecha_ahora = date("Y-m-d G:i:s");
	
	   $array_cantidad = $datos_estadisticas->cantidad_visita_admin($ip);
	   $cantidad = isset($array_cantidad[0]["cantidad"])?$array_cantidad[0]["cantidad"]:0;
	   if($cantidad>0)
	   {
		   $datos_estadisticas->eliminar_visitas_admin($ip);
	   }
	   $datos_estadisticas->insertar_visitas_admin($ip,$idusuario,$fecha_ahora);
	   	
}
function layers($tipo=0, $nombre='', $name='', $tooltip='', $array_data=array(),$val_inpt='', $onclick='')
{
	if($nombre!='' or $name!='')
	{
		?>
		<div class="form-group">
			  <label class="col-sm-2 control-label">
				 <span data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip; ?>">
				  <?php echo $nombre ?>&nbsp;
				  <i class="fa fa-info-circle"></i> 
				 </span>
			  </label>
			  <div class="col-sm-10">
				<?php if($tipo==1){ ?>
				<input type="text" class="form-control" name="<?php echo $name ?>" id="<?php echo $name ?>" value="<?php echo $val_inpt; ?>" <?php echo ($onclick!=='')?$onclick:''; ?>>
				<?php } else if($tipo==2){ ?>
				<select name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="form-control" <?php echo ($onclick!=='')?$onclick:''; ?>>
					<option value="">-Seleccione una opcion-</option>
					<?php if(count($array_data) > 0){
					foreach($array_data as $item){						
						$value = isset($item["value"])?$item["value"]:'';
						$nombre = isset($item["nombre"])?$item["nombre"]:'';
					?>
					<option value="<?php echo $value; ?>" <?php echo($val_inpt==$value)?'selected':''; ?>><?php echo $nombre; ?></option>
					<?php }} ?>
				</select>				  
				<?php }else if($tipo==3){ ?>  
				  <textarea style="height: 500px" name="<?php echo $name ?>" class="form-control ckeditor" id="<?php echo $name ?>"><?php echo $val_inpt; ?></textarea>
				<?php }else if($tipo==4){ ?>  
				    
				<div class="input-group">
					<label class="input-group-btn">
						<span class="btn btn-primary">
							Seleccionar <input type="file" name="<?php echo $name ?>[]" id="<?php echo $name ?>" accept="image/*" style="display: none;" multiple <?php echo ($onclick!=='')?$onclick:''; ?>>
						</span>
					</label>
					<input type="text" class="form-control" readonly>
				</div>						
											  
				<?php }else if($tipo==5){ ?> 
				  
				  <div class="input-group">
					<label class="input-group-btn">
						<span class="btn btn-primary">
							Seleccionar <input type="file" name="<?php echo $name ?>[]" id="<?php echo $name ?>" accept="image/*" style="display: none;" <?php echo ($onclick!=='')?$onclick:''; ?>>
						</span>
					</label>
					<input type="text" class="form-control" readonly>
				</div>						
				
				<?php }else if($tipo==6){ ?> 
				<input type="date" id="<?php echo $name; ?>" name="<?php echo $name; ?>" class="form-control" value="<?php echo $val_inpt; ?>">
				<?php }else if($tipo==7){ ?>  
				 
				  <div class="input-group">
					  <input type="text" class="form-control" name="<?php echo $name; ?>" id="<?php echo $name; ?>">					  
					  <div class="input-group-btn" style="min-width: 190px;">
						<select name="selectable" id="selectable" class="form-control">
							<option value="">-Seleccione una opcion-</option>
							<?php if(count($array_data) > 0){
							foreach($array_data as $item){						
								$value = isset($item["value"])?$item["value"]:'';
								$nombre = isset($item["nombre"])?$item["nombre"]:'';
							?>
							<option value="<?php echo $value; ?>" <?php echo($val_inpt==$value)?'selected':''; ?>><?php echo $nombre; ?></option>
							<?php }} ?>
						</select>
						
					  </div><!-- /btn-group -->
					  <div class="input-group-btn">
						  <button class="btn btn-default" type="button" <?php echo ($onclick!=='')?$onclick:''; ?>>A&ntilde;adir</button>  
					  </div>
					</div>
				  
				<?php }else if($tipo==8){ ?>  
				
									
					<div class="input-group" id="show_hide_password">
					  <input class="form-control" type="password" name="<?php echo $nombre; ?>" id="<?php echo $nombre; ?>" value="<?php echo $val_inpt; ?>">
					  <a href="" class="input-group-addon">
						<i class="fa fa-eye-slash" aria-hidden="true"></i>
					  </a>
					</div>
				  
				
				<?php }else if($tipo==10){ ?>  
				  <div class="input-group">
					<label class="input-group-btn">
						<span class="btn btn-primary">
							Seleccionar <input type="file" name="<?php echo $name ?>[]" id="<?php echo $name ?>" accept="image/*" style="display: none;" <?php echo ($onclick!=='')?$onclick:''; ?>>
						</span>
					</label>
					<input type="text" class="form-control" readonly>
				</div>						
				<?php }else if($tipo==11){ ?>  
				 <input min="0" type="number" step="0.01" class="form-control" name="<?php echo $name ?>" id="<?php echo $name ?>" value="<?php echo $val_inpt; ?>" <?php echo ($onclick!=='')?$onclick:''; ?>> 
				<?php }else if($tipo==12){ ?>  
				  <input min="0" type="number" class="form-control" name="<?php echo $name ?>" id="<?php echo $name ?>" value="<?php echo $val_inpt; ?>" <?php echo ($onclick!=='')?$onclick:''; ?>>  
				<?php }else if($tipo==13){ ?>  
				  <select name="destacado" id="destacado" class="form-control">
					<option value="1" <?php echo($val_inpt==1)?'selected':''; ?>>si</option>							
					<option value="0" <?php echo($val_inpt==0)?'selected':''; ?>>no</option>							
				  </select>
				<?php }else if($tipo==14){ ?>  
				  <select name="idmoneda" id="idmoneda" class="form-control">
					<option value="1" <?php echo($val_inpt==1)?'selected':''; ?>>Soles</option>												
				  </select>
				<?php }else if($tipo==15){ ?>
				<input type="text" class="form-control" name="<?php echo $name ?>" id="<?php echo $name ?>" value='<?php echo $val_inpt; ?>' <?php echo ($onclick!=='')?$onclick:''; ?>>
				<?php }else if($tipo==16){ ?>				  
				<textarea name="<?php echo $name ?>" id="<?php echo $name ?>" class="form-control" cols="30" rows="10" <?php echo ($onclick!=='')?$onclick:''; ?>><?php echo $val_inpt; ?></textarea>
				<?php } ?>  
			  </div>
		</div>
		<div class="line line-dashed b-b line-lg pull-in"></div>
		<?php			
	}
}
function layers_registro($usuario='', $nombres='', $fecha_creacion='', $fecha_modificacion='')
{
	
		?>
		<div class="form-group">
          <label class="col-lg-2 control-label">
			 <span data-toggle="tooltip" data-placement="top" title="Nombre de usuario">
			  Usuario&nbsp;
			  <i class="fa fa-info-circle"></i> 
			 </span>
		  </label>
          <div class="col-lg-10">
            <p class="form-control-static"><?php echo $usuario; ?></p>
          </div>
        </div>


		<div class="form-group">
          <label class="col-lg-2 control-label">
			<span data-toggle="tooltip" data-placement="top" title="Nombres y apellidos del usuario">
			  Nombres y apellidos&nbsp;
			  <i class="fa fa-info-circle"></i> 
			 </span>
		  </label>
          <div class="col-lg-10">
            <p class="form-control-static"><?php echo $nombres; ?></p>
          </div>
        </div>

		<div class="form-group">
          <label class="col-lg-2 control-label">
			<span data-toggle="tooltip" data-placement="top" title="Fecha de creación del registro">
			  Fecha de creaci&oacute;n&nbsp;
			  <i class="fa fa-info-circle"></i> 
			</span>
		  </label>
          <div class="col-lg-10">
            <p class="form-control-static"><?php echo $fecha_creacion; ?></p>
          </div>
        </div>

		<div class="form-group">
          <label class="col-lg-2 control-label">
			  <span data-toggle="tooltip" data-placement="top" title="Fecha de modificación del registro">
			  Fecha de modificaci&oacute;n
			  <i class="fa fa-info-circle"></i> 
			 </span>
		  </label>
          <div class="col-lg-10">
            <p class="form-control-static"><?php echo $fecha_modificacion; ?></p>
          </div>
        </div>
		<?php
	
}
function layers_config_imagen($num=0, $array=array())
{
	$item_idtipo = isset($array[0]["idtipo"])?$array[0]["idtipo"]:0;
	if($item_idtipo==0)
	{
		if($num==0)
		{	#SLIDER
			$item_idtipo=1;
		}
		else
		{	#OTROS REGISTROS
			$item_idtipo=2;
		}
	}
	$item_alto = isset($array[0]["alto"])?$array[0]["alto"]:'';
	$item_ancho = isset($array[0]["ancho"])?$array[0]["ancho"]:'';
	$item_calidad = isset($array[0]["calidad"])?$array[0]["calidad"]:'';
	$item_cuadrado = isset($array[0]["cuadrado"])?$array[0]["cuadrado"]:0;
	$item_ratio = isset($array[0]["ratio"])?$array[0]["ratio"]:0;
	?>
				<div class="row">		
					<label class="col-sm-4 control-label">
						<span data-toggle="tooltip" data-placement="top" title="Ingrese el alto en pixeles de la imagen">
							Altura&nbsp;
							<i class="fa fa-info-circle"></i> 
						</span>							
					</label>					
					<div class="col-sm-8">
						<div class="input-group">
						  <input type="number" class="form-control" value="<?php echo $item_alto; ?>" name="imagenes[<?php echo $num; ?>][alto]" id="alto_<?php echo $num; ?>" placeholder="Alto imagen px" <?php echo ($item_cuadrado==1 || $item_ratio==1)?'disabled':''; ?>>
						  <input type="hidden" value="<?php echo $item_idtipo; ?>" name="imagenes[<?php echo $num; ?>][idtipo]">
						  <span class="input-group-addon">px</span>
						</div>					
					</div>
				</div>
				<div class="line line-dashed b-b line-lg pull-in"></div>
				<div class="row">
					<label class="col-sm-4 control-label">
						<span data-toggle="tooltip" data-placement="top" title="Ingrese el ancho en pixeles de la imagen">
							Ancho&nbsp;
							<i class="fa fa-info-circle"></i> 
						</span>							
					</label>					
					<div class="col-sm-8">
						<div class="input-group">						  
						  <input type="number" class="form-control" value="<?php echo $item_ancho; ?>" name="imagenes[<?php echo $num; ?>][ancho]" id="ancho_<?php echo $num; ?>" placeholder="Ancho imagen px">
						  <span class="input-group-addon">px</span>
						</div>					
					</div>					
				</div>  	
				<div class="line line-dashed b-b line-lg pull-in"></div>
				<div class="row">										
				  <label class="col-sm-4 control-label">
					<span data-toggle="tooltip" data-placement="top" title="Ingrese la calidad de la imagen, recomendada 5">
						Calidad&nbsp;
						<i class="fa fa-info-circle"></i> 
					</span>							
				  </label>
				  <div class="col-sm-8">
						<input class="form-control" type="number" min="1" max="10" step="1" value="<?php echo $item_calidad; ?>" name="imagenes[<?php echo $num; ?>][calidad]" id="calidad_imagenes" >
				  </div>										
				</div>
				<div class="line line-dashed b-b line-lg pull-in"></div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label class="col-sm-4 control-label">
								<span data-toggle="tooltip" data-placement="top" title="Restringe el tamaño de las imagenes a un cuadrado segun el valor del ancho ingresado">
									Cuadrado&nbsp;
									<i class="fa fa-info-circle"></i> 
								</span>							
							</label>
							<div class="col-sm-8">								
								<select name="imagenes[<?php echo $num; ?>][cuadrado]" onChange="javascript:restringir(this.value,'alto_<?php echo $num; ?>')" class="form-control">
									<option value="0" <?php ($item_cuadrado==0)?'selected':''; ?>>No</option>
									<option value="1" <?php ($item_cuadrado==1)?'selected':''; ?>>Si</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="line line-dashed b-b line-lg pull-in"></div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label class="col-sm-4 control-label">
								<span data-toggle="tooltip" data-placement="top" title="Mantiene las proporciones de la imagen">
									Ratio&nbsp;
									<i class="fa fa-info-circle"></i> 
								</span>							
							</label>
							<div class="col-sm-8">								
								<select name="imagenes[<?php echo $num; ?>][ratio]"  onChange="javascript:restringir(this.value,'alto_<?php echo $num; ?>')" class="form-control">
									<option value="0" <?php echo ($item_ratio==0)?'selected':''; ?>>No</option>
									<option value="1" <?php echo ($item_ratio==1)?'selected':''; ?>>Si</option>
								</select>
							</div>
						</div>
					</div>
				</div>

	<?php
}
function layers_action($url='')
{
	?>
		<div class="form-group">
          <div class="col-sm-10 col-sm-offset-2">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
			<a href="<?php echo $url; ?>" class="btn btn-default">Cancelar</a>
          </div>
        </div>
	<?php
	
}
function layers_hidden($get_id='', $get_modulo='', $get_option='', $get_action='', $get_token='')
{
	?>
		  <input type="hidden" name="ID" value="<?php echo $get_id; ?>">
		  <input type="hidden" name="modulo" value="<?php echo $get_modulo; ?>">
		  <input type="hidden" name="option" value="<?php echo $get_option; ?>">		  
		  <input type="hidden" name="action" value="<?php echo $get_action; ?>">		  
		  <input type="hidden" name="token" value="<?php echo $get_token; ?>">
	
	<?php 
}
function header_buttons($onclick="", $get_action="", $url_nuevo="", $url_cerrar="", $url_cancelar="", $url_generar="")
{
	?>
	<div class="bg b-b wrapper-sm" style="padding-left: 20px !important; padding-right:20px !important">
	<?php
	if($get_action=='list' or $get_action=='')
	{
	?>	
	  <?php if($url_generar!==''){ ?>	 	
	  <a style="cursor: pointer;" onClick="javascript:<?php echo $url_generar; ?>" class="btn m-b-xs btn-sm btn-primary btn-addon"><i class="fa fa-plus"></i>Generar</a>
	  <?php } ?>			
	  <?php if($url_nuevo!==''){ ?>	
	  <a href="<?php echo $url_nuevo; ?>" class="btn m-b-xs btn-sm btn-primary btn-addon"><i class="fa fa-plus"></i>Nuevo</a>
	  <?php } ?>	
	  <?php if($url_cancelar!==''){ ?>	
	  <a href="<?php echo $url_cerrar; ?>" class="btn m-b-xs btn-sm btn-danger btn-addon"><i class="fa fa-times"></i>Cerrar</a>  	
	  <?php } ?>		
	<?php
	}
	else if($get_action=='edit' or $get_action=='new')
	{
	?>
	  <a style="cursor: pointer;" onClick="javascript:<?php echo $onclick; ?>" class="btn m-b-xs btn-sm btn-success btn-addon"><i class="fa fa-save"></i>Guardar</a>
	  <a href="<?php echo $url_cancelar; ?>" class="btn m-b-xs btn-sm btn-danger btn-addon"><i class="fa fa-times"></i>Cancelar</a>  	
	
	<?php
	}
	?>
	</div>	
	<?php	
}
function fecha_local()
{
	#setlocale(LC_ALL, 'es_PE'); 
	return date("Y-m-d");
}
function uniqidReal($lenght = 13) {
    // uniqid gives 13 chars, but you could adjust it to your needs.
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($lenght / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
    } else {
        throw new Exception("no cryptographically secure random function available");
    }
    return substr(bin2hex($bytes), 0, $lenght);
}
function formatearFechaEnEspanol($fecha, $incluirHora = false) {
    // Arrays de traducción
    $dias = ['Sunday' => 'domingo', 'Monday' => 'lunes', 'Tuesday' => 'martes', 'Wednesday' => 'miércoles', 'Thursday' => 'jueves', 'Friday' => 'viernes', 'Saturday' => 'sábado'];
    $meses = ['January' => 'enero', 'February' => 'febrero', 'March' => 'marzo', 'April' => 'abril', 'May' => 'mayo', 'June' => 'junio', 'July' => 'julio', 'August' => 'agosto', 'September' => 'septiembre', 'October' => 'octubre', 'November' => 'noviembre', 'December' => 'diciembre'];

    // Crear objeto DateTime a partir de la fecha proporcionada
    $fechaObj = new DateTime($fecha);

    // Obtener componentes de la fecha
    $dia_semana = $dias[$fechaObj->format('l')];
    $dia = $fechaObj->format('d');
    $mes = $meses[$fechaObj->format('F')];
    $anio = $fechaObj->format('Y');

    // Formatear fecha sin hora
    $fecha_formateada = "$dia_semana, $dia de $mes de $anio";

    // Si se debe incluir la hora
    if ($incluirHora) {
        $hora = $fechaObj->format('g:i:s A'); // Formato de 12 horas con AM/PM
        $fecha_formateada .= " $hora";
    }

    return $fecha_formateada;
}
function fecha_castellano ($fecha='')
{
	//Establecer la información del localismo.
	
	$fecha_castellano = "";
	if($fecha!=='' || $fecha!=='0000-00-00')
	{	#setlocale(LC_ALL, 'es_PE'); 
		$fecha_castellano = formatearFechaEnEspanol($fecha);
	}
	return $fecha_castellano;
}
function fecha_castellano_completa ($fecha='')
{
	//Establecer la información del localismo.
	
	$fecha_castellano = "";
	if($fecha!=='' || $fecha!=='0000-00-00')
	{	#setlocale(LC_ALL, 'es_PE'); 
		$fecha_castellano = formatearFechaEnEspanol($fecha, true);
	}
	return $fecha_castellano;
}

function upload_files($size_imagen, $array_files = [], $ruta = "", $idpadre = 0, $tipo=0)
{	
	$datos_registro = new registro();
	$datos_general= new config_general();
	
	$detalle_imagen = $datos_general->config_listado_imagenes(2);
	
	$item_alto = isset($detalle_imagen[0]["alto"])?$detalle_imagen[0]["alto"]:'';
	$item_ancho = isset($detalle_imagen[0]["ancho"])?$detalle_imagen[0]["ancho"]:'';
	$item_calidad = isset($detalle_imagen[0]["calidad"])?$detalle_imagen[0]["calidad"]:5;
	$item_cuadrado = isset($detalle_imagen[0]["cuadrado"])?$detalle_imagen[0]["cuadrado"]:0;
	$item_ratio = isset($detalle_imagen[0]["ratio"])?$detalle_imagen[0]["ratio"]:0;

	if(count($array_files) == 0 || $ruta == "") return;
	
	$_SESSION['error_imagen'] = array();
	$array_error=array();
	
	$allowedExts = array("gif", "jpeg", "jpg", "png");		
	$total = count($array_files['name']);
	
	$num=0;
	if($total > 0 && ($array_files['error'][0])==0)
	{			
		for($i=0;$i<$total;$i++ )
		{			 
				$tmpFilePath = isset($array_files['tmp_name'][$i])?$array_files['tmp_name'][$i]:'';
				$name_imagen = isset($array_files["name"][$i])?$array_files["name"][$i]:'';
				$isize_imagen = isset($array_files["size"][$i])?$array_files["size"][$i]:0;			
				if($tmpFilePath!=="" && ($isize_imagen < $size_imagen) &&  ($isize_imagen > 0))
				{					
					$temp = explode(".", $array_files["name"][$i]);
					$newfilename = trim(str_replace (" ","",uniqid().uniqidReal().PHP_EOL)). '.' . end($temp);
					$newFilePath = $ruta. $newfilename;				

					if(move_uploaded_file($tmpFilePath, $newFilePath))
					{					
						if($tipo==0)
						{
							//Handle other code here
							$array_imagen = $datos_registro->insertar_registro($newfilename, $newfilename, $newfilename, "", "", 0, 4, 1, 0, 0, fecha_local(), fecha_local());
							$id_imagen = isset($array_imagen[0]["id"])?$array_imagen[0]["id"]:0;
							if($id_imagen!==0)
							{
								if($idpadre > 0)
								$datos_registro->insertar_relacion($idpadre,$id_imagen);
							}
							###################################################################

							$imgh = icreate($newFilePath);

							if($item_cuadrado == 1)
							{
								$imgr = resizeCrop($imgh, $item_ancho, $item_ancho, "0.$item_calidad");
							}
							else if ($item_ratio==1)
							{
								$imgr = resizeAspectW($imgh, $item_ancho);
							}
							else
							{
								$imgr = resizeCrop($imgh, $item_ancho, $item_alto, "0.$item_calidad");
							}

							$directorio_final = $ruta."th/";
							if (!file_exists($directorio_final)){  mkdir($directorio_final, 0777, true); } 

							imagejpeg($imgr,$directorio_final.$newfilename);


						}
						else
						{
							if($idpadre > 0)
							$datos_registro->actualizar_imagen($idpadre,$newfilename);
						}

					}
					else
					{

						$array_error = array(
							"imagen" => $array_files["name"][$i],
							"error" => 2
						);
						array_push($_SESSION['error_imagen'], $array_error);
					}
					#echo "nivel 1";
				}
				else
				{			
					#echo "nivel 2";
					$array_error = array(
						"imagen" => $array_files["name"][$i],
						"error" => 1
					);	
					array_push($_SESSION['error_imagen'], $array_error);
				}
			$num++;
		 }
	}
}

function upload_files_slider($size_imagen, $array_files = [], $ruta = "", $idpadre = 0, $tipo=0)
{	
	$datos_registro = new registro();
	$datos_general= new config_general();
	
	$detalle_imagen = $datos_general->config_listado_imagenes(1);
	
	$item_alto = isset($detalle_imagen[0]["alto"])?$detalle_imagen[0]["alto"]:'';
	$item_ancho = isset($detalle_imagen[0]["ancho"])?$detalle_imagen[0]["ancho"]:'';
	$item_calidad = isset($detalle_imagen[0]["calidad"])?$detalle_imagen[0]["calidad"]:5;
	$item_cuadrado = isset($detalle_imagen[0]["cuadrado"])?$detalle_imagen[0]["cuadrado"]:0;
	$item_ratio = isset($detalle_imagen[0]["ratio"])?$detalle_imagen[0]["ratio"]:0;

	if(count($array_files) == 0 || $ruta == "") return;	
			
	$_SESSION['error_imagen'] = array();
	$array_error=array();
	
	$allowedExts = array("gif", "jpeg", "jpg", "png");		
	$total = count($array_files['name']);	
	#print_r($array_files);
	#exit();
	if($total > 0 && ($array_files['error'][0])==0)
	{
		for( $i=0 ; $i < $total ; $i++ )
		{		
				$name_imagen = isset($array_files["name"][$i])?$array_files["name"][$i]:'';
				$tmpFilePath = isset($array_files['tmp_name'][$i])?$array_files['tmp_name'][$i]:'';
				if($tmpFilePath != "" && ($array_files["size"][$i] < $size_imagen))
				{
					$temp = explode(".", $array_files["name"][$i]);
					$newfilename = trim(str_replace (" ","",uniqid().uniqidReal().PHP_EOL)). '.' . end($temp);
					$newFilePath = $ruta. $newfilename;

					if(move_uploaded_file($tmpFilePath, $newFilePath))
					{					

						//Handle other code here
						$array_imagen = $datos_registro->insertar_registro($newfilename, $newfilename, $newfilename, "", "", 0, 4, 1, 0, 0, fecha_local(), fecha_local());
						$id_imagen = isset($array_imagen[0]["id"])?$array_imagen[0]["id"]:0;
						if($id_imagen!==0)
						{
							if($idpadre > 0)
							$datos_registro->insertar_relacion($idpadre,$id_imagen);
						}
						###################################################################

						$imgh = icreate($newFilePath);

						if($item_cuadrado == 1)
						{
							$imgr = resizeCrop($imgh, $item_ancho, $item_ancho, "0.$item_calidad");
						}
						else if ($item_ratio==1)
						{
							$imgr = resizeAspectW($imgh, $item_ancho);
						}
						else
						{
							$imgr = resizeCrop($imgh, $item_ancho, $item_alto, "0.$item_calidad");
						}

						$directorio_final = $ruta."slider/";
						if (!file_exists($directorio_final)){  mkdir($directorio_final, 0777, true); } 

						imagejpeg($imgr,$directorio_final.$newfilename);

					}
					else
					{
						$array_error = array(
							"imagen" => "$name_imagen",
							"error" => 2,
						);
						array_push($_SESSION['error_imagen'], $array_error);
					}
				}
				else
				{
					$array_error = array(
						"imagen" => "$name_imagen",
						"error" => 1,
					);
					array_push($_SESSION['error_imagen'], $array_error);
				}

		 }
	}
}

function imagen_seo_box($imagen='', $item_id = 0, $ruta_eliminar = "")
{	if($item_id == 0 || $ruta_eliminar == "") return;
	if($imagen!=='' && file_exists(URL_ROOT."images/media/".$imagen) && isset($imagen))
	{
		$imagen = URL_WEB."images/media/$imagen";
		print(file_exists(URL_ROOT."images/media/".$imagen));
	?>
	<div class="galeria-registro">
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
			<div class="item-imagen">
				<span class="bg-danger link" 
				onClick="javascript:eliminar(<?php echo $item_id; ?>, '<?php echo $ruta_eliminar; ?>')"	  
				><i class="fa fa-times" aria-hidden="true"></i></span>
				<a data-fancybox="gallery" href="<?php echo $imagen; ?>" class="bg bg-cover" style="background-image: url(<?php echo $imagen; ?>)">
				<img src="<?php echo URL_WEB."admin/images/bg-galeria.png"; ?>" alt="">
				</a>				
			</div>
		</div>			
	</div>	
	<?php
	}
}
function listado_registro_galeria($array=[], $ruta = "", $ruta_admin = "", $ruta_eliminar = "")
{
	if(count($array) > 0)
	{
		?>
		<div class="galeria-registro">
			<?php
				$num=0;
				foreach($array as $item)
				{
					$item_id = isset($item["id"])?$item["id"]:0;
					$item_nombre = isset($item["nombre"])?$item["nombre"]:'';
					$item_url = isset($item["url"])?$item["url"]:'';
					$item_imagen = isset($item["imagen"])?$item["imagen"]:'';
					$item_orden = isset($item["orden"])?$item["orden"]:'';
					$item_destacado = isset($item["iddestacado"])?$item["iddestacado"]:'0';
					
					$url_imagen = $ruta.$item_imagen;
					?>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
						<div class="item-imagen">
							<span class="bg-danger link" 
							onClick="javascript:eliminar(<?php echo $item_id; ?>, '<?php echo $ruta_eliminar; ?>')"	  
							><i class="fa fa-times" aria-hidden="true"></i></span>
							<a data-fancybox="gallery" href="<?php echo $url_imagen; ?>" class="bg bg-cover" style="background-image: url(<?php echo $url_imagen; ?>)">
							<img src="<?php echo $ruta_admin."images/bg-galeria.png"; ?>" alt="">
							</a>
							<div class="input-group m-b">
							  <span class="input-group-addon">
								<input value="1" type="checkbox" name="galeria[<?php echo $num; ?>][destacado]" title="Destacado" <?php echo ($item_destacado==1)?'checked':''; ?>>
							  </span>
							  <input value="<?php echo $item_nombre; ?>" type="text" class="form-control" name="galeria[<?php echo $num; ?>][nombre]" placeholder="Nombre">
							  <input value="<?php echo $item_orden; ?>" type="number" class="form-control" name="galeria[<?php echo $num; ?>][orden]" placeholder="Orden">	
							  <input value="<?php echo $item_url; ?>" type="text" class="form-control" name="galeria[<?php echo $num; ?>][url]" placeholder="Url">	
							  <input value="<?php echo $item_id; ?>" type="hidden" name="galeria[<?php echo $num; ?>][id]">	
							</div>
						</div>
					</div>
					<?php
					$num++;
				}
			?>
		</div>
		<?php
	}
}
function listado_info($listado_info_contacto)
{
	?>
		<div id="block_info">
		<?php 
		if(count($listado_info_contacto) > 0)
		{
			$cant=0;
			foreach($listado_info_contacto as $item)
			{
				$_item_dato= isset($item["dato"])?$item["dato"]:'';
				$_item_iddato= isset($item["tipo_dato"])?$item["tipo_dato"]:'';
				$_item_ndato= isset($item["nombre"])?$item["nombre"]:'';
				$_item_principal= isset($item["principal"])?$item["principal"]:0;
				?>
				<div id="dat_info_<?php echo $cant; ?>">
				<div class="form-group">
					  <label class="col-sm-2 control-label">
						 <span data-toggle="tooltip" data-placement="top" title="Ingrese el nombre del usuario">
						  <?php echo $_item_ndato; ?>&nbsp;
						  <i class="fa fa-info-circle"></i> 
						 </span>
					  </label>
					  <div class="col-sm-10">

						<div class="input-group">
						  <input type="text" class="form-control" name="data[<?php echo $cant; ?>][value]" id="data[<?php echo $cant; ?>][value]" value="<?php echo $_item_dato; ?>">
						  <span class="input-group-btn">
							<label class="form-control" data-toggle="tooltip" data-placement="left" title="Seleccione info principal">
								<input type="checkbox" name="data[<?php echo $cant; ?>][principal]" id="data[<?php echo $cant; ?>][principal]" value="1" <?php echo ($_item_principal==1)?'checked':''; ?>>
							</label>										  										
						  </span>
						  <span class="input-group-btn">
							<button class="btn btn-danger" type="button" onClick="javascript:eliminar_data_info('dat_info_<?php echo $cant; ?>')"><i class="fa fa-times" aria-hidden="true"></i></button>
						  </span>
						</div>

						<input type="hidden" name="data[<?php echo $cant; ?>][idtipo]" id="data[<?php echo $cant; ?>][idtipo]" value="<?php echo $_item_iddato; ?>">
					  </div>
				</div>
				<div class="line line-dashed b-b line-lg pull-in"></div>
				</div>
				<?php
			$cant++;	
			}

		}
		?>
		</div>  
		<input type="hidden" name="num_datos" id="num_datos" value="<?php echo count($listado_info_contacto); ?>" >
	<?php
}

/**
@abstract Archivo de backup automatico de ficheros de sitios alojados
@param $directorio contiene la ruta de los ficheros
@version creacion 1.0
**/
function ZipBa($desde, $destino){
    if (extension_loaded('zip') === true) {
        if (file_exists($desde) === true) {
            $zip = new ZipArchive();

            if ($zip->open($destino, ZIPARCHIVE::CREATE) === true){
                $desde = realpath($desde);

                if (is_dir($desde) === true)
				{
                    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($desde), RecursiveIteratorIterator::SELF_FIRST);
																									
          			foreach ($files as $file)
					{	
						$file = realpath($file);
						
						if (!strpos($file, 'systembk'))
						{							
							if (is_dir($file) === true)
							{
								$zip->addEmptyDir(str_replace($desde . '/', '', $file . '/'));
							}
							else if (is_file($file) === true)
							{
								$zip->addFromString(str_replace($desde . '/', '', $file), file_get_contents($file));
							}
						}

                    }
                }

                else if (is_file($desde) === true)
                {
                    $zip->addFromString(basename($desde), file_get_contents($desde));
                }
            }

            return $zip->close();
        }
    }

    return false;
}
   function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}

function backupDatabaseTables($dbHost,$dbUsername,$dbPassword,$dbName,$tables = '*'){
    //connect & select the database
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
	$return="";
    //get all of the tables
    if($tables == '*'){
        $tables = array();
        $result = $db->query("SHOW TABLES");
        while($row = $result->fetch_row()){
            $tables[] = $row[0];
        }
    }else{
        $tables = is_array($tables)?$tables:explode(',',$tables);
    }

    //loop through the tables
    foreach($tables as $table){
        $result = $db->query("SELECT * FROM $table");
        $numColumns = $result->field_count;

        $return.= "DROP TABLE IF EXISTS $table;";

        $result2 = $db->query("SHOW CREATE TABLE $table");
        $row2 = $result2->fetch_row();

        $return .= "\n\n".$row2[1].";\n\n";

        for($i = 0; $i < $numColumns; $i++){
            while($row = $result->fetch_row()){
                $return .= "INSERT INTO $table VALUES(";
                for($j=0; $j < $numColumns; $j++){
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return .= '"'.$row[$j].'"' ; } else { $return .= '""'; }
                    if ($j < ($numColumns-1)) { $return.= ','; }
                }
                $return .= ");\n";
            }
        }

        $return .= "\n\n\n";
    }

    //save file
	$backup_file_name='db-backup-'.time().'.sql';
    $handle = fopen($backup_file_name,'w+');
    fwrite($handle,$return);
    fclose($handle);
	
	$ruta_sql = realpath($backup_file_name);
	
	#$root = $_SERVER["DOCUMENT_ROOT"];	
	$nombre 	= URL_ROOT."admin/systembk/svperu_".date("d-m-Y_H-i-s").".zip";
	$directorio 	= URL_ROOT."/admin/systembk/";
	//busca todos los ficheros que sean .zip
	$files 		= glob($directorio . '*.zip');	
	//Verifica la cantidad de ficheros y si es que hay que borrar y cual.
	if( $files !== false )
	{
		$cant = count( $files );
		if($cant>0)
		{
			//ya hay 5 respaldos así que hay que eliminar antes de pder seguir
			//genera un array para tomar el archivo más antiguo de los que se encuentran
			array_multisort(
			array_map( 'filemtime', $files ),
			SORT_NUMERIC,
			SORT_DESC,
			$files
			);
			
			$ruta_zip = $files[0];
		}
		else
		{
			$ruta_zip = "";
		}
	}
	else
	{
		$ruta_zip = "";
	}
	
	$zip = new ZipArchive();
	if($ruta_zip!=='')
	{
		if($zip->open($ruta_zip)===true)
		{
			$zip->addFile($ruta_sql,$backup_file_name);
			$zip->close(); 
			unlink($ruta_sql);
		}
		else
		{
			return false;
		}
	}
	else
	{
		$salida_zip = $directorio."svperu_".date("d-m-Y_H-i-s").".zip";
		if($zip->open($salida_zip,ZIPARCHIVE::CREATE)===true)
		{
			$zip->addFile($ruta_sql,$backup_file_name); 
			$zip->close(); 
			unlink($ruta_sql);
		}
		else
		{
			return false;
		}		
	}
	
}
function delete_image_registros($ruta)
{
	if(file_exists($ruta))
	{
		unlink($ruta);
	}
}
?>