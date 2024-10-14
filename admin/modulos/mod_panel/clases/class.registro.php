<?php
class registro
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar();  
	}
	public function registro_detalle($idregistro)
	{
		$lista="";
		$query="SELECT mar.id, mar.nombre, mar.url, mar.imagen, mar.resumen, mar.descripcion, mar.idtipo, mar.idestado, mar.iddestacado, mar.orden,
				ca.alias, ca.tipo_pagina, ca.id_pagina, cp.nombre as nombre_pagina, ru.usuario as usuario,
				CONCAT(mep.nombres,' ',mep.apellidos) as nombre_personal, mar.fecha_creacion, mar.fecha_modificacion, mrp.precio, mrp.descuento, mrp.idmoneda,
				mrp.stock, mrp.idmarca, mrp.estado_producto,
				(
					SELECT mar1.imagen
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion rr ON rr.id2 = mar1.id
					WHERE mar1.idtipo = 10 AND rr.id1 = mar.id
				) as seo_imagen,
				(
					SELECT mar1.descripcion
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion rr ON rr.id2 = mar1.id
					WHERE mar1.idtipo = 10 AND rr.id1 = mar.id
				) as seo_descripcion,
				(
					SELECT mar1.resumen
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion rr ON rr.id2 = mar1.id
					WHERE mar1.idtipo = 10 AND rr.id1 = mar.id
				) as seo_keywords ,
				(
					SELECT mar1.nombre
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion rr ON rr.id2 = mar1.id
					WHERE mar1.idtipo = 10 AND rr.id1 = mar.id
				) as so_titulo,
				(
					SELECT mar1.id
					FROM mod_panel_registro mar1
					LEFT JOIN mod_panel_registro_relacion rr ON rr.id2 = mar1.id
					WHERE mar1.idtipo = 10 AND rr.id1 = mar.id
				) as seo_id
				
				FROM mod_panel_registro mar
				LEFT JOIN mod_com_alias ca ON ca.id_registro = mar.id
				LEFT JOIN mod_com_pagina cp ON cp.id = ca.id_pagina
				LEFT JOIN mod_registro_usuarios ru ON ru.id = mar.idusuario
				LEFT JOIN mod_empresa_personal mep ON mep.id =ru.idpersonal
				LEFT JOIN mod_panel_registro_precio mrp ON mrp.idprincipal = mar.id
				WHERE mar.id = ? ";
		$lista = $this->data->executeQuery($query, array("$idregistro"));
		return $lista;			
	}
	
	public function listar_registroxnivel($id,$tipo)
	{
		$lista="";
		$query="SELECT rr.id1
				FROM mod_panel_registro_relacion rr
				LEFT JOIN mod_panel_registro mar ON mar.id = rr.id1
				WHERE id2 = ? AND mar.idtipo= ?";
		$lista = $this->data->executeQuery($query, array("$id","$tipo"));
		return $lista;			
	}
	public function listar_registro_relacionxtipo($idpadre, $idtipo)
	{
		$lista="";
		$query="SELECT mar.id, mar.id as value, mar.nombre, mar.url, mar.resumen, mar.idtipo, mar.idestado, mar.iddestacado, mar.orden, mar.imagen
				FROM mod_panel_registro mar
				LEFT JOIN mod_panel_registro_relacion mrr ON mrr.id2= mar.id
				WHERE mrr.id1 = ? AND mar.idtipo = ?
				ORDER BY mar.orden ASC, mar.fecha_creacion ASC ";
		$lista = $this->data->executeQuery($query, array("$idpadre","$idtipo"));
		return $lista;					
	}
	public function listar_relacion_padre($id)
	{
		$lista="";
		$query="SELECT count(*) as cantidad FROM mod_panel_registro_relacion WHERE id1 = ? ";
		$lista = $this->data->executeQuery($query, array("$id"));
		return $lista;					

	}
	public function listar_relacion_hijo($id)
	{
		$lista="";
		$query="SELECT count(*) as cantidad FROM mod_panel_registro_relacion WHERE id2 = ? ";
		$lista = $this->data->executeQuery($query, array("$id"));
		return $lista;					
	}
	
	public function listar_registro_tipo($idtipo, $tipo_pagina=0)
	{	
		#CATEGORIA PRODUCTO
		$query0="(
					SELECT n.nombre
					FROM mod_panel_registro n
					LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id1 = n.id
					WHERE mrr1.id2 = mar.id AND n.idtipo = 1
				 ) as categoria ";
		
		#SUBCATEGORIA PRODUCTO
		$query1="(
					SELECT n.nombre
					FROM mod_panel_registro n
					LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id1 = n.id
					WHERE mrr1.id2 = mar.id AND n.idtipo = 2
				 ) as subcategoria ";
		
		
		$lista="";
		$query ="SELECT mar.id,mar.id as value, mar.nombre, mar.url, mar.resumen, mar.idtipo, mar.idestado, mar.iddestacado, mar.orden,
				 ca.alias, ca.tipo_pagina, cp.nombre as nombre_pagina, ru.usuario, me.estado,
				 CONCAT(mep.nombres,' ',mep.apellidos) as nombre_personal, mar.fecha_creacion, mar.fecha_modificacion "; 
				 if($idtipo==2)
				 {
					 #SI ES SUBCATEGORIA => CATEGORIA
					 $query.=",".$query0;
				 }
				 else if($idtipo==3)
				 {	
					 #SI ES REGISTRO => CATEGORIA, SUBCATEGORIA
					 $query.=",
					 IF(
					    (
							SELECT count(*)
							FROM mod_panel_registro n
							LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id1 = n.id
							WHERE mrr1.id2 = mar.id AND n.idtipo = 2
						)  > 0,
						(
							SELECT
								CONCAT(
								(
									SELECT na.nombre
									FROM mod_panel_registro na
									LEFT JOIN mod_panel_registro_relacion mrr1a ON mrr1a.id1 = na.id
									WHERE mrr1a.id2 = n.id AND na.idtipo = 1
								)
								,' / ', n.nombre) 
							FROM mod_panel_registro n
							LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id1 = n.id
							WHERE mrr1.id2 = mar.id AND n.idtipo = 2
						),
						
						(
							SELECT n.nombre
							FROM mod_panel_registro n
							LEFT JOIN mod_panel_registro_relacion mrr1 ON mrr1.id1 = n.id
							WHERE mrr1.id2 = mar.id AND n.idtipo = 1
						)
						
					   ) as categoria";
				 }
		$query.=" FROM mod_panel_registro mar
				 LEFT JOIN mod_com_alias ca ON ca.id_registro = mar.id
				 LEFT JOIN mod_com_pagina cp ON cp.id = ca.id_pagina
				 LEFT JOIN mod_registro_usuarios ru ON ru.id = mar.idusuario
				 LEFT JOIN mod_empresa_personal mep ON mep.id = ru.idpersonal
				 LEFT JOIN mod_config_estado me ON me.id = mar.idestado
				 WHERE mar.idtipo = ? ";
		if($tipo_pagina > 0)
		{
			$query.=" AND ca.tipo_pagina = $tipo_pagina ";	
		}		
			
		$query.=" ORDER BY mar.orden ASC, mar.fecha_creacion ASC ";	
		#echo $query;
		$lista = $this->data->executeQuery($query, array("$idtipo"));
		return $lista;							
	}
	public function listar_alias($alias)
	{
		$lista="";
		$query="SELECT count(*) as cant
				FROM mod_com_alias
				WHERE alias = ? ";
		$lista = $this->data->executeQuery($query, array("$alias"));
		return $lista;									
	}
	public function listar_aliasxidpagina($id)
	{
		$lista="";
		$query="SELECT id_pagina, alias, tipo_pagina FROM mod_com_alias WHERE id_registro = ? ";
		$lista = $this->data->executeQuery($query, array("$id"));
		return $lista;
	}
	public function insertar_registro($nombre, $url="", $imagen, $resumen="", $descripcion="", $orden=0, $idtipo, $idestado=1, $idusuario=0, $iddestacado=0, $fecha_creacion= "0000-00-00", $fecha_modificacion= "0000-00-00")
	{
		$query="INSERT INTO mod_panel_registro( nombre, url, imagen, resumen, descripcion, orden, idtipo, idestado, idusuario, iddestacado, fecha_creacion, fecha_modificacion)
				VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
		$this->data->updateQuery($query,array("$nombre", "$url", "$imagen", "$resumen", "$descripcion", "$orden", "$idtipo", "$idestado", "$idusuario", "$iddestacado", "$fecha_creacion", "$fecha_modificacion"));
		
		$lista="";
		$query="SELECT MAX(id) as id FROM mod_panel_registro";
		$lista = $this->data->executeQuery($query);
		return $lista;			
	}
	public function insertar_relacion($id1,$id2)
	{
		$query="INSERT INTO mod_panel_registro_relacion(id1, id2) VALUES (?,?) ";
		$this->data->updateQuery($query,array("$id1", "$id2"));
	}
	public function insertar_alias($idregistro, $idpagina, $alias, $tipo_pagina)
	{
		$query="INSERT INTO mod_com_alias(id_registro, id_pagina, alias, tipo_pagina) VALUES (?,?,?,?) ";
		$this->data->updateQuery($query,array("$idregistro", "$idpagina", "$alias", "$tipo_pagina"));	
	}
	public function actualizar_registro($id, $nombre='', $url='',$imagen='',$resumen='',$descripcion='',$orden=0,$idestado=0,$iddestacado=0,$fecha_modificacion='0000-00-00')
	{
		$query="UPDATE mod_panel_registro SET ";
		if($nombre!==''){ $query.="nombre='".$nombre."'	";	}				
		if($url!==''){ $query.=",url='".$url."' ";	}
		if($imagen!==''){ $query.=",imagen='".$imagen."' ";	}
		if($resumen!==''){ $query.=",resumen='".$resumen."' ";	}
		if($descripcion!==''){ $query.=",descripcion='".$descripcion."' ";	}
		if($orden!==0){ $query.=",orden='".$orden."' ";	}		
		if($idestado!==0){ $query.=",idestado='".$idestado."' ";	}
		if($iddestacado!==0){ $query.=",iddestacado='".$iddestacado."' ";	}
		if($fecha_modificacion!=='0000-00-00'){ $query.=",fecha_modificacion='".$fecha_modificacion."' ";	}						
		$query.=" WHERE id= ? ";
		#echo $query;
		#exit();
		$this->data->updateQuery($query,array("$id"));	
	}
	public function actualizar_imagen($id,$imagen='')
	{
		$query="UPDATE mod_panel_registro SET ";
		if($imagen!==''){ $query.=" imagen='".$imagen."' ";	}
		else{	$query.=" imagen=NULL ";	}
		$query.=" WHERE id= ? ";
		$this->data->updateQuery($query,array("$id"));	
		
		$query="SELECT id1 as id FROM mod_panel_registro_relacion WHERE id2 = ? ";
		$lista = $this->data->executeQuery($query,array("$id"));
		return $lista;
	}
	public function actualizar_relacionxnivel($id,$id1)
	{
		$query="UPDATE mod_panel_registro_relacion SET id1='".$id1."' WHERE id2 = ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
	public function actualizar_alias($id, $alias='', $idpagina=0)
	{
		$query="UPDATE mod_com_alias SET ";
		if($alias!==''){ $query.="alias='".$alias."'"; }				
		if($idpagina!==0){ $query.=",id_pagina='".$idpagina."'"; }												
		$query.="WHERE `id_registro`= ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
	
	function eliminar_registro($id)
	{
		$query="DELETE FROM mod_panel_registro WHERE id = ?";
		$this->data->updateQuery($query,array("$id"));						
	}
	function eliminar_relacion($id)
	{
		$query="DELETE FROM `mod_panel_registro_relacion` WHERE id1= ? ";
		$this->data->updateQuery($query,array("$id"));					
	}
	function eliminar_relacion_hijo($id)
	{
		$query="DELETE FROM `mod_panel_registro_relacion` WHERE id2= ? ";
		$this->data->updateQuery($query,array("$id"));					
	}
	
	function eliminar_allrelacion($id)
	{
		$query="DELETE mar FROM mod_panel_registro mar 
				LEFT JOIN mod_panel_registros_relacion mrr ON mrr.id2 = mar.id
				WHERE mrr.id1 = ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
	function eliminar_alias ($id)
	{
		$query="DELETE FROM `mod_com_alias` WHERE id_registro = ? ";
		$this->data->updateQuery($query,array("$id"));					
	}
	function eliminar_imagen($id)
	{
		$query="DELETE FROM mod_panel_registro WHERE id = ?";
		$this->data->updateQuery($query,array("$id"));
		
		$query="SELECT id1 as id FROM mod_panel_registro_relacion WHERE id2 = ? ";
		$lista = $this->data->executeQuery($query,array("$id"));
		
		$query="DELETE FROM `mod_panel_registro_relacion` WHERE id2 = ? ";
		$this->data->updateQuery($query,array("$id"));	
		
		return $lista;
	}
	##################################################################
	function  listado_iconos()
	{
		$lista="";
		$query="SELECT id, icon FROM mod_config_icons";
		$lista = $this->data->executeQuery($query);
		return $lista;
		
	}
	##################################################################
	public function listar_precio_producto($id)
	{
		$lista="";
		$query="SELECT `id`, `nombre`, `precio`, `descuento`, `idmoneda`, `idprincipal`
				FROM `mod_panel_registro_precio`
				WHERE idprincipal = ? ";
		$lista = $this->data->executeQuery($query, array("$id"));
		return $lista;
	}
	public function insertar_precio_producto($nombre="", $precio=0, $descuento=0, $idmoneda=1, $idprincipal=0, $stock=0, $idmarca=0, $estado_producto=0)
	{
		$query="INSERT INTO mod_panel_registro_precio(nombre, precio, descuento, idmoneda, idprincipal, stock, idmarca, estado_producto)
				VALUES (?,?,?,?,?,?,?,?)";
		$this->data->updateQuery($query,array("$nombre", "$precio", "$descuento", "$idmoneda", "$idprincipal", "$stock", "$idmarca", "$estado_producto"));	
	}
	public function actualizar_precio_producto($id, $nombre="", $precio=0, $descuento=0, $idmoneda=0, $stock=0, $idmarca=0, $estado_producto=0)
	{
		$query="UPDATE mod_panel_registro_precio
				SET nombre='".$nombre."',
					precio='".$precio."',
					descuento='".$descuento."',
					idmoneda='".$idmoneda."',
					stock='".$stock."',
					idmarca='".$idmarca."',
					estado_producto='".$estado_producto."'
				WHERE idprincipal= ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
}

?>