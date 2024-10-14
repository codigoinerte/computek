<section class="main-container col2-left-layout">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
			<article >
            <h2 class="page-heading"> <span class="page-heading-title">Resultado de la busqueda</span> </h2>
<?php
#print_r($_POST);
include_once ("clases/class.buscador.php");
$datos_buscar = new busqueda();
$busqueda='';
$post = isset($_POST['buscar'])?$_POST['buscar']:'';
$get = $_var;

if($post!= '')
{
	$busqueda = $post;
}
else if( $get != '')
{
	$busqueda = $get;
}
#echo $busqueda;
if($busqueda!='')
{
	$contar_busqueda = $datos_buscar->contar_busqueda_productos_web($busqueda);

	$numeroRegistros = $contar_busqueda[0]['count(*)'];
    $tamPag=9; 

    if(!isset($_GET["pag"])) 
    { 
       $pagina=1; 
       $inicio=1; 
       $final=$tamPag; 
    }else{ 
       $pagina = $_GET["pag"]; 
    } 
    $limitInf=($pagina-1)*$tamPag; 

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
	$lbusqueda = $datos_buscar->busqueda_productos_web($busqueda,$limitInf, $tamPag);
	if($busqueda!='')
	{
		$array_terminos = explode(" ",$busqueda);
		echo '<div class="row margin-bottom-15"><div class="col-xs-12">';
		echo '<ul class="terminos_de_busqueda">';
			if(count($array_terminos) > 1)
			{
				for($x=0;$x<count($array_terminos);$x++)
				{
					echo '<li><a href="'.URL_WEB.$_alias."/".$array_terminos[$x].'">'.$array_terminos[$x].'</a></li>';		
				}
			}
			echo '<li><a href="'.URL_WEB.$_alias."/".$busqueda.'">'.$busqueda.'</a></li>';
		echo '</ul>';
		echo '</div></div>';
	}
	
	if($numeroRegistros > 0)
	{	
		?>
		<div class="category-products">
		  <ul class="products-grid">				
		<?php		
		foreach($lbusqueda as $item)
		{
			?>
			<div class="item col-lg-3 col-md-4 col-sm-4 col-xs-6">  
			<?php listado_item_producto($item); ?>				
			</div>	
			<?php  
		}
		?>
		 </ul>
		</div>	  
		<?php	  
	####################################################################################################################################
	#PAGINACION	
	echo '<div class="toolbar"><div class="row"><div class="col-xs-12">';
	if($numeroRegistros > 9)
	{
		echo '<nav aria-label="Page navigation">';
		echo '<div class="pager"><div class="pages"><ul class="pagination">';
		if($pagina>1) 
		{ 
		   echo '<li><a href="'.URL_WEB.$_alias.($pagina-1).'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
		} 
		for($i=$inicio;$i<=$final;$i++) 
		{ 
		   if($i==$pagina) 
		   {  
		      echo '<li class="active"><a href="#">'.$i.'<span class="sr-only">(current)</span></a></li>';
		   }
		   else
		   { 
		      echo '<li><a href="'.URL_WEB.$_alias.$i.'">'.$i.'</a></li>';
		   } 
		} 
		if($pagina<$numPags)
		{ 
		   echo '<li><a href="'.URL_WEB.$_alias.($pagina+1).'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
		} 
	    echo '</ul></div></div>';
		echo '</nav>';
	}   
	 echo '</div></div></div>'; 

####################################################################################################################################
	}
	else
	{
		echo '<div class="row margin-bottom-30"><div class="col-xs-12"><h3 align="center">NO SE ENCONTRARON RESULTADOS DE SU BUSQUEDA</h3></div></div>';
	}
}
else
{
	echo '<div class="row margin-bottom-30"><div class="col-xs-12"><h3 align="center">NO SE ENCONTRARON RESULTADOS DE SU BUSQUEDA</h3></div></div>';	
}
	?>
		</article>		
	</div>

  </div>
</div>
</section>			