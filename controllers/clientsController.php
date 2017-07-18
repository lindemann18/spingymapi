<?php 
	class clientsController
	{
		function ConsultarClientesPorId($id)
		{
			$clientsModel = new clientsModel();
			$response     = $clientsModel->_ConsultarClientesPorId($id);
			return $response;
		}

		function ConsultarClientesFormulario()
		{
			$clientsModel = new clientsModel();
			$response     = $clientsModel->_ConsultarClientesFormulario();
			return $response;
		}

		function ConsultarInfoClienteRutinaId($id)
		{
			$clientsModel = new clientsModel();
			$response     = $clientsModel->_ConsultarInfoClienteRutinaId($id);
			return $response;
		}

		function ConsultarClientes()
		{
			$clientsModel = new clientsModel();
			$response     = $clientsModel->_ConsultarClientes($id);
			return $response;
		}

		function ConsultarClientesPorIdDet($id)
		{
			$clientsModel = new clientsModel();
			$response     = $clientsModel->_ConsultarClientesPorIdDet($id);
			return $response;
		}

		function ConsultarClientInfoFormReport($id)
		{
			$clientsModel = new clientsModel();
			$response     = $clientsModel->_ConsultarClientInfoFormReport($id);
			return $response;
		}

		function ConsultarclientForm($id)
		{
			$clientsModel = new clientsModel();
			$response     = $clientsModel->_ConsultarclientForm($id);
			return $response;
		}

		function ConsultarClientInfoRoutine($id)
		{
			$clientsModel = new clientsModel();
			$response     = $clientsModel->_ConsultarClientInfoRoutine($id);
			return $response;
		}

		function ConsultarClientesPorEntrenador($id)
		{
			$clientsModel = new clientsModel();
			$response     = $clientsModel->_ConsultarClientesPorEntrenador($id);
			return $response;
		}
	}
	
 ?>