<?php 
	class machinesController
	{
		function ConsultarMaquinas()
		{
			$MachinesModel = new MachinesModel();
			$response  	   = $MachinesModel->_ConsultarMaquinas();
			return $response;
		}

		function BuscarMaquinaId($id)
		{
			$MachinesModel = new MachinesModel();
			$response  	   = $MachinesModel->_BuscarMaquinaId($id);
			return $response;
		}

		function BuscarMaquinaPorCategoria($id)
		{
			$MachinesModel = new MachinesModel();
			$response  	   = $MachinesModel->_BuscarMaquinaPorCategoria($id);
			return $response;
		}
	}
 ?>