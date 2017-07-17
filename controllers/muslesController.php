<?php 
	
	class MuslesController
	{
		function _ConsultarMusculos()
		{
			$muslesModel = new muslesModel();
			$response    = $muslesModel->_ConsultarMusculos();
			return $response;
		}

		function ConsultarMusculosPorId($id)
		{
			$muslesModel = new muslesModel();
			$response    = $muslesModel->_ConsultarMusculosPorId($id);
			return $response;
		}

		function ConsultarMusculosPorRutina($id)
		{
			$muslesModel = new muslesModel();
			$response    = $muslesModel->_ConsultarMusculosPorRutina($id);
			return $response;
		}//_ConsultarMusculos

		function ConsultarMusculosPorTipoRutinaId($id)
		{
			$muslesModel = new muslesModel();
			$response    = $muslesModel->_ConsultarMusculosPorTipoRutinaId($id);
			return $response;
		}

	}
	
 ?>