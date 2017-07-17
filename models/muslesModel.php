<?php 
	
	class muslesModel
	 {
	 	function _ConsultarMusculos()
	 	{
	 		$query='
			select  
			Mus.id,
			Mus.nb_musculo,
			Mus.desc_musculo,
			us.nb_nombre,
			us.nb_apellidos,
			Rut.nb_tiporutina
			from 
			sgmusculos Mus
			LEFT JOIN sgusuarios us
			on Mus.id_usuario_creacion=us.id
			LEFT JOIN sgtiposrutina Rut
			ON Rut.id=Mus.id_tiporutina
			WHERE Mus.sn_activo=1';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAll($query);
			return $response;
	 	}

	 	function _ConsultarMusculosPorId($id)
	 	{
	 		$query='
			select  
			Mus.id,
			Mus.nb_musculo,
			Mus.desc_musculo,
			Mus.id_tiporutina,
			us.nb_nombre,
			us.nb_apellidos,
			Rut.nb_tiporutina
			from 
			sgmusculos Mus
			INNER JOIN sgusuarios us
			on Mus.id_usuario_creacion=us.id
			INNER JOIN sgtiposrutina Rut
			ON Rut.id=Mus.id_tiporutina
			WHERE Mus.sn_activo=1 AND Mus.id= ? 
			';	
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetRowOneParam($query,$id);
			return $response;
	 	}

	 	function _ConsultarMusculosPorRutina($id)
		{
			$query='
			select  
			Mus.id,
			Mus.nb_musculo,
			Mus.desc_musculo,
			us.nb_nombre,
			us.nb_apellidos,
			Rut.nb_TipoRutina
			from 
			sgmusculos Mus
			INNER JOIN sgusuarios us
			on Mus.id_usuario_creacion=us.id
			INNER JOIN sgtiposrutina Rut
			ON Rut.id=Mus.id_tiporutina
			WHERE Mus.sn_activo=1
			AND Rut.id= ?
			';	
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAllOneParam($query,$id);
			return $response;
		}//_ConsultarMusculos

		function _ConsultarMusculosPorTipoRutinaId($id)
		{
			$query = '
				SELECT
				Mus.id,
				Mus.nb_musculo,
				Tip.nb_tiporutina
				FROM sgmusculos Mus
				INNER JOIN sgtiposrutina Tip on Mus.id_tiporutina = Tip.id
				WHERE Tip.id =? and Mus.sn_activo=1
			';
			$Utilities = new Utilities();
			$response = $Utilities->QueryGetAllOneParam($query,$id);
			return $response;
		}
	 }

 ?>