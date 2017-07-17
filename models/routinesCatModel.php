<?php 
	class routinesCatModel
	{
		function _ConsultarTiposRutina()
		{
			$query = '
						SELECT 
						tipru.id,
						tipru.nb_tiporutina,
						tipru.desc_tiporutina,
						usu.nb_nombre,
						usu.nb_apellidos
						from sgtiposrutina tipru
						LEFT JOIN sgusuarios usu
						ON tipru.id_usuarioregistro = usu.id
						where tipru.sn_activo=1
			    	';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAll($query);
			return $response;
		}

		function _ConsultarTipoRutinaPorId($id)
		{
			$query = 'SELECT * from sgtiposrutina where id=?';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetRowOneParam($query,$id);
			return $response;
		}
	}
 ?>