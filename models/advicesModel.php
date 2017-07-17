<?php 
	class advicesModel
	{
		function _ConsultarConsejoPorId($id)
		{
			$query = '
					SELECT
					con.id,
					con.consejo as Consejo,
					con.Resultado,
					pru.nm_prueba
					FROM 
					sgconsejos con
					LEFT JOIN 
					sgtipospruebas pru
					ON con.id_tipo_prueba = pru.id
					where  con.id= ? ORDER BY id ASC
			    	';
			$Utilities = new Utilities();
	    	$response  = $Utilities->QueryGetRowOneParam($query,$id);
	    	return $response;

		}

		function _ConsultarConsejosPorPrueba($test)
		{
			$query = '
	    		SELECT  
	    		con.id,
				con.Resultado,
				con.consejo as Consejo,
				pru.id as "id_prueba",
				pru.nm_prueba
	    		FROM sgconsejos con 
	    		LEFT JOIN sgtipospruebas pru ON con.id_tipo_prueba= pru.id 
	    		where con.id_tipo_prueba= ?  ORDER BY con.id ASC
	    	';

	    	$Utilities = new Utilities();
	    	$response  = $Utilities->QueryGetAllOneParam($query,$test);
	    	return $response;
		}

		function _ConsultarConsejoAcordeResultado($tipo_prueba, $resultado)
		{
			// Note: This has to be changed to refer to an ID not a String
			// The query expects a String.

			$query = "select * from sgconsejos where id_tipo_prueba=? and Resultado=?";
			$Utilities = new Utilities();
	    	$response  = $Utilities->QueryTwoParametersOneRow($tipo_prueba,$resultado,$query);
	    	return $response;
		}

	}

 ?>