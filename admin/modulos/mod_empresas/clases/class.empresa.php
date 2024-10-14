<?php
class empresa
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar();  
	}
	public function detalle_empresa($id)
	{
		$lista="";
		$query="SELECT id, idtipo, empresa, ruc, idpersonal, titulo_seo, keyword_seo, descripcion_seo, favicon, isotipo, logo
				FROM mod_empresa me
				WHERE id = ? ";
		$lista = $this->data->executeQuery($query, array("$id"));
		return $lista;		
	}
	public function listado_personal()
	{
		$lista="";
		$query="SELECT id as value, CONCAT(nombres,' ',apellidos) as nombre
				FROM mod_empresa_personal ";
		$lista = $this->data->executeQuery($query);
		return $lista;		
	}
	public function insertar_info_empresa($dato, $tipo, $idregistro, $tabla, $principal=0)
	{
		$query="INSERT INTO mod_dato_info(dato, tipo_dato, idregistro, tabla, principal)
				VALUES (?,?,?,?,?)";
		$this->data->updateQuery($query,array("$dato", "$tipo", "$idregistro", "$tabla", "$principal"));	
	}
	public function actualizar_empresa($id, $empresa, $ruc, $titulo_seo, $keyword_seo, $descripcion_seo, $idpersonal)
	{
		$query="UPDATE mod_empresa SET 					
					empresa='".$empresa."',
					ruc='".$ruc."',
					titulo_seo='".$titulo_seo."',
					keyword_seo='".$keyword_seo."',
					descripcion_seo='".$descripcion_seo."',					
					idpersonal='".$idpersonal."'
					WHERE id= ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
		
	public function actualizar_logo($id, $logo='')
	{
		$query="UPDATE mod_empresa SET ";
		if($logo!=='')
		{
			$query.=" logo='".$logo."' ";
		}
		else
		{
			$query.=" logo=null ";	
		}
		$query.=" WHERE id= ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
	public function actualizar_isotipo($id, $isotipo='')
	{
		$query="UPDATE mod_empresa SET ";
		if($isotipo!=='')
		{
			$query.=" isotipo='".$isotipo."' ";
		}
		else
		{
			$query.=" isotipo=null ";
		}
		$query.=" WHERE id= ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
	public function actualizar_favicon($id, $favicon='')
	{
		$query="UPDATE mod_empresa SET ";
		if($favicon!=='')
		{
			$query.=" favicon='".$favicon."' ";
		}
		else
		{
			$query.=" favicon=null ";
		}
		$query.=" WHERE id= ? ";
		$this->data->updateQuery($query,array("$id"));	
	}
	public function eliminar_data_info($id, $tabla)
	{
		$query="DELETE FROM mod_dato_info WHERE idregistro = ? AND tabla = ? ";
		$this->data->updateQuery($query,array("$id", "$tabla"));	
	}	
}

?>