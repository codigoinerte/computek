<?php
class config_mail
{
	public function __construct()
	{
		$this->data = new Conecta();
		$this->data->conectar();  
	}
	public function detalle_mail($id)
	{
		$lista="";
		$query="SELECT mcc.id, mcc.tipo_correo, mcc.nombre, mcc.correo, mcc.empresa, mcc.telefono, mcc.asunto, mcc.mensaje, mcc.atencion, mcc.idusuario, mep.id as idpersonal
				FROM mod_config_correos mcc
				LEFT JOIN mod_registro_usuarios mru ON mru.id = mcc.idusuario
				LEFT JOIN mod_empresa_personal mep ON mep.id = mru.idpersonal
				WHERE mcc.id = ? ";
		$lista = $this->data->executeQuery($query, array("$id"));
		return $lista;			
	}
	
	public function listado_tipo_atencion()
	{
		$lista="";
		$query="SELECT id as value, tipo as nombre FROM mod_config_correos_atencion WHERE 1 ";
		$lista = $this->data->executeQuery($query);
		return $lista;			
	}
	
	public function listado_mail()
	{
		$lista="";
		$query="SELECT mcc.id, mcc.tipo_correo, mcc.nombre, mcc.correo, mcc.empresa, mcc.telefono, mcc.asunto, mcc.mensaje, mca.tipo, mcc.idusuario, mcc.fecha, CONCAT(mep.nombres,' ',mep.apellidos) as usuario
		FROM mod_config_correos mcc
		LEFT JOIN mod_registro_usuarios mru ON mru.id = mcc.idusuario
		LEFT JOIN mod_empresa_personal mep ON mep.id = mru.idpersonal
		LEFT JOIN mod_config_correos_atencion mca ON mca.id = mcc.atencion";
		$lista = $this->data->executeQuery($query);
		return $lista;			
	}
	public function actualizar_mail($id, $atencion,$idusuario=null)
	{		
		$query="UPDATE mod_config_correos SET
							atencion='".$atencion."',
							idusuario='".$idusuario."'
							WHERE id=? ";		
		$this->data->updateQuery($query,array("$id"));	
	
	}
	
}
?>