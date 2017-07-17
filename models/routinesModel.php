<?php 
	class routinesModel
	{
		function _ConsultarRutinas()
		{
			//Este querie devuelve TODAS las rutinas ordenadas de principiante hasta avanzado.
			$query = '
			SELECT
			Rut.id as id_rutina,
			Rut.nb_rutina,
			Rut.desc_rutina,
			Rut.fh_creacion,
			Usu.nb_nombre,
			Usu.nb_apellidos,
			Cat.nb_categoriarutina,
			Gen.id as id_genero,
			Gen.nb_tiporutina,
			cuerpo.id as id_cuerpo,
			cuerpo.nb_cuerpo,
			edad.nb_edad
			FROM sgrutinas Rut
			left JOIN sgusuarios Usu
			ON Usu.id=Rut.id_usuariocreacion
			left JOIN sgcategoriasrutina Cat
			ON Cat.id=Rut.id_categoriarutina
			LEFT JOIN sggenerosrutina Gen
			ON Gen.id= Rut.id_generorutina
			LEFT JOIN sgtipocuerpo cuerpo
			ON cuerpo.id = Rut.id_tipocuerpo
			LEFT JOIN sgedad edad
			ON edad.id = Rut.id_edad
			where  Rut.sn_activo=1   order by id_rutina asc
			';

			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAll($query);
			return $response;
		}

		function _ConsultarCategoriaRutinas()
		{
			$query='
			SELECT DISTINCT
			id,
			nb_categoriarutina
			from sgcategoriasrutina
			ORDER BY id
			';	
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAll($query);
			return $response;
		}

		function _ConsultarGenerosRutina()
		{
			$query='select id,nb_tiporutina from sggenerosrutina';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAll($query);
			return $response;
		}

		function _ConsultarEntrenadoresConRutinas()
		{
			$query="
			SELECT distinct
			Usu.id as id,
			CONCAT(Usu.nb_nombre, ' ',Usu.nb_apellidos) as nombre
			FROM sgrutinas Rut

			LEFT  JOIN sgusuarios Usu
			ON Rut.id_usuariocreacion=Usu.id
			WHERE Rut.sn_activo = 1
			ORDER BY Usu.id
			";		
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAll($query);
			return $response;
		}
	}
 ?>