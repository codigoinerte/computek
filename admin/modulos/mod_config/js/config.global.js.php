<script>
	function guardar_config_global()
	{
		document.forms[0].submit();
		return true;			
	}
	function restringir(valor, id)
	{
		if(valor==1)
		{
			$("#"+id).attr("disabled","disabled");
			$("#"+id).val(0);
		}
		else
		{
			$("#"+id).removeAttr("disabled");
		}
	}
</script>