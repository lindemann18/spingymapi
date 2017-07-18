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

		function ConsultarRutinasFiltradas($params)
		{
			//Getting the params
			$count = 0;
			$entrenador = null;
			$tipo_rutina = null;
			$genero = null;
			$edad = null;
			$cuerpo = null;
			foreach ($params as  $value) {
				$count++;
				switch($count)
				{
					case 1:
						$entrenador = $value;
					break;

					case 2:
						$tipo_rutina = $value;
					break;
					case 3:
						$genero = $value;
					break;
					case 4:
						$edad = $value;
					break;
					case 5:
						$cuerpo = $value;
					break;
				}
				
			}
			
			$routinesModel = new routinesModel();
			$response      = $routinesModel->_ConsultarRutinasFiltradas($entrenador,$tipo_rutina,$genero,$edad,$cuerpo);
			return $response;
		}
	}

 ?>