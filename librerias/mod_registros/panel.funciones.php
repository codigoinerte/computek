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
			$var.='<h1 class="relative mb-5 pb-2 text-lg font-semibold text-black after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-16 after:bg-primary-300 after:content-[\'\']">
                	'.$nombre.'
				</h1>
				<p class="leading-6 color-gray-6">'.(strip_tags($descripcion)).'</p>
              <div class="mt-5 flex gap-3">
                <a class="h-10" href="#">
                  <img
                    class="h-full"
                    src="'.$imagen.'"
                    alt="Compustore" />
                </a>
              </div>';										
		}
		else if($tipo == 2){
			$var.= strip_tags($descripcion);
		}else if($tipo == 3){
			$var.='<p class="leading-6">'.(strip_tags($descripcion)).'</p>
                <div class="mt-2 flex gap-3">
                  <a class="h-10" href="#">
                    <img
                      class="h-full"
                      src="'.$imagen.'"
                      alt="Compustore" />
                  </a>
                </div>';
		}else if($tipo== 4){
			$var.='<div class="col-span-12 overflow-hidden rounded-lg shadow-md md:col-span-4">
					<img class="h-full w-full" src="'.$imagen.'" alt="banner" />
				</div>';
		}else if($tipo== 5){
			$var.='<h2 class="text-base font-semibold text-default-600">'.$nombre.'</h2>
					<p class="text-default-400">'.$resumen.'</p>';
		}else if($tipo== 6){
			$var.='    <div class="container mx-auto my-10 px-4 sm:px-8 xl:px-4">
						<div
							class="flex flex-col items-center justify-center gap-5 rounded-lg bg-primary-500 px-4 py-10 text-white lg:flex-row lg:gap-0">
							<div
							class="relative flex items-center gap-5 lg:mr-10 lg:pr-10 lg:after:absolute lg:after:right-0 lg:after:h-10 lg:after:w-[2px] lg:after:bg-primary-300 lg:after:content-[\'\']">
							<svg
								class="h-16 w-16 text-white"
								stroke="currentColor"
								fill="currentColor"
								stroke-width="0"
								viewBox="0 0 640 512"
								height="200px"
								width="200px"
								xmlns="http://www.w3.org/2000/svg">
								<path
								d="M112 0C85.5 0 64 21.5 64 48V96H16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 272c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 48c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 240c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 208c8.8 0 16 7.2 16 16s-7.2 16-16 16H64V416c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H112zM544 237.3V256H416V160h50.7L544 237.3zM160 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm272 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0z"></path>
							</svg>
							<p class="text-2xl font-bold uppercase">'.$nombre.'</p>
							</div>
							<p class="text-center text-lg">
								'.(strip_tags($descripcion)).'
							</p>
						</div>
						</div>';
		}
		/*
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
		*/
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
							
				$var.='<a href="https://wa.me/51'.$dato.'">'.$dato.'</a>';
				
			}
			else if($tipo==2)
			{
				
				$var.= $dato;	
				
			}
			else
			{
				$var.='<a target="_blank" href="https://wa.me/51'.$dato.'">
					<svg 
						xmlns="http://www.w3.org/2000/svg" 
						
						width="16"
						height="16"
						fill="currentColor"
						class="h-6 w-6"
						viewBox="0 0 448 512">
						<path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                  	</svg> <span>'.$dato.'</span></a>';
			}
		}
		else if($tipo_dato==5) #Direccion
		{
			if($tipo==1)
			{
				
				$var.='<address>'.$dato.'</address>';
				
			}
			else
			{
				$var.='<a href="https://wa.me/51'.$dato.'">'.$dato.'</a>';
			}
		}
		else if($tipo_dato==11) #Correo
		{		
			if($tipo == 1){
				$var.='<a href="mailto:'.$dato.'">'.$dato.'</a>';
			}else{
				$var.='<a class="transition-all duration-300 color-gray-6 hover:text-black" href="mailto:'.$dato.'">'.$dato.'</a>';
			}
		}
		else if($tipo_dato==12) #Horario
		{
			$var.=$dato;
		}
		else if($tipo_dato==2) #Celular
		{
			$var.=$dato;
			
		}
		else if($tipo_dato==6) #Facebook
		{
			$var.= $dato;
		}
		else if($tipo_dato==7) #Twitter
		{
			$var.= $dato;
		}
		else if($tipo_dato==8) #Instagram
		{
			$var.= $dato;
		}
		else if($tipo_dato==9) #Skype
		{
			$var.= $dato;
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
function listado_item_producto($item, $tipo = 1)
{
	$item_id = isset($item["id"])?$item["id"]:'';
	$item_producto = isset($item["nombre"])?$item["nombre"]:'';
	$item_imagen = isset($item["imagen_principal"])?$item["imagen_principal"]:'';
	$item_imagen_destacada = isset($item["imagen_destacada"])?$item["imagen_destacada"]:'';
	
	if($item_imagen_destacada=='' && ( $item_imagen!=='' && file_exists(URL_ROOT."images/media/th/".$item_imagen) ))
	{
		$item_imagen_destacada=URL_WEB."images/media/th/".$item_imagen;
	}
	else if($item_imagen_destacada!='' && file_exists(URL_ROOT."images/media/th/".$item_imagen_destacada))
	{
		$item_imagen_destacada=URL_WEB."images/media/th/".$item_imagen_destacada;
	}else{
		$item_imagen_destacada=URL_WEB."images/no-image.png";
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

	$clases = '';
	if($tipo == 1){
		$clases = 'relative flex h-full flex-col overflow-hidden rounded-lg bg-white shadow-lg hover:shadow-xl';
	}else{
		$clases = 'relative flex h-full flex-col overflow-hidden rounded-lg bg-gray shadow-lg hover:shadow-xl swipper-card';
	}
	?>
	<div class="<?php echo $clases; ?>">
		<a href="<?php echo $item_alias; ?>" class="block h-[270px]">
			<img class="h-full w-full object-contain" src="<?php echo $item_imagen_destacada; ?>" alt="<?php echo $item_producto; ?>" />
		</a>
		<div class="mt-2 px-5">
			<div class="border-t border-slate-300">
				<div class="rater my-2" data-rater="5"></div>
				<a href="<?php echo $item_alias; ?>" class="my-2 line-clamp-2 text-default-600 transition-all duration-300 hover:text-primary-500">
					<?php echo $item_producto; ?>
				</a>
				<span class="mb-2 inline-block text-base font-bold text-primary-500">
					<?php if($item_descuento == 0){ ?>
					<span class="regular-price">
						<span class="price">S/. <?php echo redondear_precio($item_precio); ?></span>
					</span>
					<?php }else{ ?>
					<div class="price-box flex gap-3 justify-center align-center">
						
						<span class="text-xl font-bold text-primary-500 sm:items-center">S/ <?php echo redondear_precio($item_precio); ?></span>
						<span class="line-through dark font-sm mt-1">S/ <?php echo redondear_precio($item_precio_first); ?></span>
						
					</div>
					<?php } ?>					
				</span>
			</div>
			<div>
				<?php
					if($item_stock > 0)
					{
						?>
						<span class="pointer-events-none inline-block rounded-md bg-green-500 px-2 mb-1 text-white">
							En stock
						</span>
						<?php
					}
					else
					{
						?>
						<span class="pointer-events-none inline-block rounded-md bg-orange-300 px-2 mb-1 text-white">
							Sin stock
						</span>
						<?php
					}
				?>
			</div>
		</div>
		<a href="<?php echo $item_alias; ?>" class="mx-5 mb-5 mt-auto w-fit rounded-md bg-primary-500 px-3 py-2 uppercase text-white transition-all duration-300 hover:bg-primary-600">
			Leer m&aacute;s
		</a>
		<?php if($item_estado!==''){ ?>				
			<span class="pointer-events-none absolute left-4 top-4 rounded-md bg-primary-500 px-2 text-white">
				<?php echo $item_estado; ?>
			</span>
		<?php } ?>
		<?php if($item_descuento > 0){ ?>	
			<span class="pointer-events-none absolute right-4 top-4 rounded-md bg-red-400 px-2 text-white">
				<?php echo $item_descuento." %"; ?>
			</span>
		<?php } ?>
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
	
	$var='<a target="_blank" href="'.$link_whatsapp.'" class="btn btn-whatsapp pull-left font-bold text-default-600"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="h-6 w-6" viewBox="0 0 448 512"> <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path> </svg> Comprar ahora</a>';
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
