<?php 
	class machineCategoriesController
	{
		function ConsultarCategoriaMaquinas()
		{
			$machineCatModel = new machinesCategoriesModel();
			$response        = $machineCatModel->_ConsultarCategoriaMaquinas();
			return $response;
		}

		function ConsultarCategoriaMaquinaPorId($id)
		{
			$machineCatModel = new machinesCategoriesModel();
			$response        = $machineCatModel->_ConsultarCategoriaMaquinaPorId($id);
			return $response;
		}
	}

 ?>