<?php 
	class routinesCatController
	 {
	 	function ConsultarTiposRutina()
	 	{	
	 		$routinesCatModel = new routinesCatModel();
	 		$response = $routinesCatModel->_ConsultarTiposRutina();
	 		return $response;
	 	}

	 	function ConsultarTipoRutinaPorId($id)
	 	{	
	 		$routinesCatModel = new routinesCatModel();
	 		$response = $routinesCatModel->_ConsultarTipoRutinaPorId($id);
	 		return $response;
	 	}

	 	function ConsultarCategoriaRutinaPorEntrenador($id)
	 	{
	 		$routinesCatModel = new routinesCatModel();
	 		$response = $routinesCatModel->_ConsultarCategoriaRutinaPorEntrenador($id);
	 		return $response;
	 	}

	 	function ConsultarGenerosRutinaPorEntrenador($id)
	 	{
	 		$routinesCatModel = new routinesCatModel();
	 		$response = $routinesCatModel->_ConsultarGenerosRutinaPorEntrenador($id);
	 		return $response;
	 	}
	 }
 ?>