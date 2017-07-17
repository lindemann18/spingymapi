<?php 
	class exerciseController
	{
		function ConsultarEjercicios()
		{
			$exerciseModel = new exerciseModel();
			$response      = $exerciseModel->_ConsultarEjercicios();
			return $response;
		}

		function _ConsultarEjerciciosPorMusculo($muscle)
		{
			$exerciseModel = new exerciseModel();
			$response      = $exerciseModel->_ConsultarEjerciciosPorMusculo($muscle);
			return $response;
		}

		function ConsultarEjercicioPorId($id)
		{
			$exerciseModel = new exerciseModel();
			$response      = $exerciseModel->_ConsultarEjercicioPorId($id);
			return $response;
		}

		function ConsultarEjerciciosPorTipoRutina($id)
		{
			$exerciseModel = new exerciseModel();
			$response      = $exerciseModel->_ConsultarEjerciciosPorTipoRutina($id);
			return $response;
		}
	}

 ?>