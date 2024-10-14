<?php
#if(!defined("COD_SEG")) die( "Acceso Restringido" );
class busqueda
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar(); 
	}
	
	public function contar_busqueda_productos_web($busqueda)
	{
		$query="SELECT count(*)
				FROM mod_panel_registro mar 
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				WHERE mar.idestado = 1  AND mar.idtipo=3 AND mca.tipo_pagina = 2 AND ( ";
		$array_palabras = explode(" ",$busqueda);
		if(count($array_palabras) > 0)
		{		
			for($x=0;$x<count($array_palabras);$x++)
			{			
				$query.="  mar.nombre LIKE '%".$array_palabras[$x]."%' OR  mar.descripcion LIKE '%".$array_palabras[$x]."%' OR  mar.resumen LIKE '%".$array_palabras[$x]."%' OR ";
			}
		}
		$query.="  mar.nombre LIKE '%".$busqueda."%' OR  mar.descripcion LIKE '%".$busqueda."%' ) ";
		$lista = $this->data->executeQuery($query);
		return $lista;
	}
	
	public function busqueda_productos_web($busqueda, $reg_inicio, $reg_mostrar)
	{
		
		$query="SELECT mar.nombre, mar.url, mar.imagen, mar.resumen, mar.descripcion,
				mar.orden, mar.idtipo, mar.idestado, mar.iddestacado, mar.fecha_creacion, mca.alias,
				marp.precio, marp.descuento, marp.idmoneda, mca.alias, marp.stock, mrm.marca, mre.estado, 
				(
					SELECT mar1.imagen
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id2 = mar1.id
					WHERE mrr1.id1 = mar.id AND mar1.idtipo = 4 AND mar.iddestacado=1
					LIMIT 0,1
				) as imagen_principal
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2 = mar.id
				LEFT JOIN mod_com_alias mca ON mca.id_registro = mar.id
				LEFT JOIN mod_panel_registro_precio marp ON marp.idprincipal = mar.id	
				LEFT JOIN mod_panel_registro_marca mrm ON mrm.id = marp.idmarca
				LEFT JOIN mod_panel_registro_producto_estado mre ON mre.id = marp.estado_producto
				WHERE mar.idestado = 1 AND mar.idtipo=3 AND mca.tipo_pagina=2 AND ( ";
		$array_palabras = explode(" ",$busqueda);
		if(count($array_palabras) >0)
		{	
			for($x=0;$x<count($array_palabras);$x++)
			{
				$query.=" mar.nombre LIKE '%".$array_palabras[$x]."%' OR mar.descripcion LIKE '%".$array_palabras[$x]."%' OR mar.resumen LIKE '%".$array_palabras[$x]."%' OR ";
			}
		}
		$query.=" mar.nombre LIKE '%".$busqueda."%' OR mar.descripcion LIKE '%".$busqueda."%' OR mar.resumen LIKE '%".$busqueda."%' )";
		$query.="ORDER BY mar.fecha_creacion ASC
				 LIMIT $reg_inicio, $reg_mostrar;";
		#echo $query;
		$lista = $this->data->executeQuery($query);
		return $lista;
	}

}

?>