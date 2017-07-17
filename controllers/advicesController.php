<?php 	
	
	class advicesController
	{
		function ConsultarConsejoPorId($id)
		{
			$advices = new advicesModel();
			$response = $advices->_ConsultarConsejoPorId($id);
			return $response;
		}

		function ConsultarConsejosPorPrueba($test)
		{
			$advices = new advicesModel();
			$response = $advices->_ConsultarConsejosPorPrueba($test);
			return $response;
		}

		function ConsultarConsejoAcordeResultado($tipo_prueba, $resultado)
		{
			$advices = new advicesModel();
			$response = $advices->_ConsultarConsejoAcordeResultado($tipo_prueba, $resultado);
			return $response;
		}
	}	
 ?>