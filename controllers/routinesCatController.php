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
	 }
 ?>