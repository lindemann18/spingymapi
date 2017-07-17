<?php 
	class routinesController
	{
		function ConsultarRutinas()
		{
			$routinesModel = new routinesModel();
			$response      = $routinesModel->_ConsultarRutinas();
			return $response;
		}

		function ConsultarCategoriaRutinas()
		{
			$routinesModel = new routinesModel();
			$response      = $routinesModel->_ConsultarCategoriaRutinas();
			return $response;
		}

		function ConsultarGenerosRutina()
		{
			$routinesModel = new routinesModel();
			$response      = $routinesModel->_ConsultarGenerosRutina();
			return $response;
		}

		function _ConsultarEntrenadoresConRutinas()
		{
			$routinesModel = new routinesModel();
			$response      = $routinesModel->_ConsultarEntrenadoresConRutinas();
			return $response;
		}
	}

 ?>