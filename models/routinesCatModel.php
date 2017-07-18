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

		function _ConsultarCategoriaRutinaPorEntrenador($id)
		{
			$query= '
				select DISTINCT
				cat.id,
				nb_categoriarutina
				from sgcategoriasrutina cat

				LEFT JOIN sgrutinas rut ON
				rut.id_categoriarutina = cat.id

				LEFT JOIN sgusuarios usu ON
				rut.id_usuariocreacion = usu.id

				where usu.id=? AND rut.sn_activo = 1
				';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAllOneParam($query,$id);
			return $response;
		}

		function _ConsultarGenerosRutinaPorEntrenador($id)
		{
			$query = '
				SELECT DISTINCT
				Gen.nb_tiporutina,
				Gen.id

				FROM sggenerosrutina Gen

				left JOIN sgrutinas Rut
				on Rut.id_generorutina = Gen.id

				WHERE Rut.id_usuariocreacion=1

				ORDER BY Gen.id
		';	

			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAllOneParam($query,$id);
			return $response;
		}
	}
 ?>