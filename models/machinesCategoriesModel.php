<?php 
	class machinesCategoriesModel
	{
		function _ConsultarCategoriaMaquinas()
		{
			$query = "SELECT 
						cat.id,
						cat.nb_categoriamaquina,
						cat.desc_categoriamaquina,
						us.nb_nombre,
						us.nb_apellidos
						FROM sgcategoriamaquina  cat
						LEFT JOIN sgusuarios us 
						on us.id = cat.id_usuarioregistro
						where cat.sn_activo=1";
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAll($query);
			return $response;
		}

		function _ConsultarCategoriaMaquinaPorId($id)
		{
			$query='SELECT * FROM sgcategoriamaquina where id=?';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetRowOneParam($query,$id);
			return $response;
		}
	}

 ?>