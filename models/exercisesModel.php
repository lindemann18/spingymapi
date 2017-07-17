<?php 
	class exerciseModel
	{
		function _ConsultarEjercicios()
		{
			$query='
			select 
			Ej.id,
			Ej.desc_ejercicio,
			Ej.nb_ejercicio,
			Ej.id_tiporutina,
			Us.nb_nombre,
			Us.nb_apellidos,
			Mus.nb_musculo,
			Tip.nb_tiporutina,
			MA.nb_maquina
			FROM sgejercicios Ej
			LEFT JOIN sgusuarios Us
			ON Us.id=Ej.id_UsuarioCreacion
			LEFT JOIN sgmusculos Mus
			ON Mus.id= Ej.id_musculo
			LEFT JOIN sgtiposrutina Tip
			ON Tip.id=Ej.id_TipoRutina
			LEFT JOIN sgmaquinas MA
			ON Ej.id_maquina=MA.id
			WHERE  Ej.sn_activo=1
		';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAll($query);
			return $response;
		}

		function _ConsultarEjerciciosPorMusculo($musle)
		{
			$query = '
			SELECT
			eje.id as id_ejercicio,
			eje.nb_ejercicio,
			mus.nb_musculo,
			mus.id as id_musculo
			from sgejercicios eje
			LEFT JOIN sgmusculos mus
			ON mus.id = eje.id_musculo
			where eje.id_musculo = ? ';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAllOneParam($query,$musle);
			return $response;
			
		}

		function _ConsultarEjercicioPorId($id)
		{
			$query='
			select 
			Ej.id,
			Ej.desc_ejercicio,
			Ej.nb_ejercicio,
			Us.nb_nombre,
			Us.nb_apellidos,
			Mus.nb_musculo,
			Mus.id as "id_musculo",
			Tip.nb_TipoRutina,
			Tip.id as "id_tiporutina",
			Maq.id as "id_maquina",
			CatMaq.id as "id_categoriamaquina",
			CatMaq.nb_CategoriaMaquina
			FROM sgejercicios Ej
			LEFT JOIN sgusuarios Us
			ON Us.id=Ej.id_UsuarioCreacion
			LEFT JOIN sgmusculos Mus
			ON Mus.id= Ej.id_musculo
			LEFT JOIN sgtiposrutina Tip
			ON Tip.id=Ej.id_tiporutina
			LEFT JOIN sgmaquinas Maq
			on Maq.id=Ej.id_maquina
			LEFT JOIN sgcategoriamaquina CatMaq
			on CatMaq.id = Maq.id_CategoriaMaquina
			WHERE Ej.id= ?
			';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetRowOneParam($query,$id);
			return $response;
		}

		function _ConsultarEjerciciosPorTipoRutina($id)
		{
			$condicion = ($id!="Todos")?"Tip.id=? AND":"";
			$query='
				select 
				Ej.id,
				Ej.desc_ejercicio,
				Ej.nb_ejercicio,
				Ej.id_tiporutina,
				Us.nb_nombre,
				Us.nb_apellidos,
				Mus.nb_musculo,
				Tip.nb_tiporutina,
				MA.nb_maquina
				FROM sgejercicios Ej
				LEFT JOIN sgusuarios Us
				ON Us.id=Ej.id_usuariocreacion
				LEFT JOIN sgmusculos Mus
				ON Mus.id= Ej.id_musculo
				LEFT JOIN sgtiposrutina Tip
				ON Tip.id=Ej.id_TipoRutina
				LEFT JOIN sgmaquinas MA
				ON Ej.id_maquina=MA.id
				WHERE '.$condicion.' Ej.sn_activo=1
			';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAllOneParam($query,$id);
			return $response;
		}
	}
	
 ?>