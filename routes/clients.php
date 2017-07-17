<?php 
	// Musles ROUTES
	use Psr\Http\Message\ServerRequestInterface;
	use Psr\Http\Message\ResponseInterface;

	$app->get("/clients",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();
				$id  = $request->getAttribute('id');
				// Verifying heade.rs
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);
				
				if(!$dataResponse['error'])
				{
					// Getting the information.
					$clientsController = new clientsController();
					$dataResponse = $clientsController->ConsultarClientes();	
				}
				
				if(!$dataResponse["error"])
				{
					$newResponse = $response->withStatus(200);
				}else{
					$newResponse = $response->withStatus(500);
				}	

				
				$response->withHeader("Content-type","application/json");
				$body = $response->getBody();
				$body->write(json_encode($dataResponse));
			} catch (PDOException $e) {
				echo "Error: ".$e->getMessage();
			}
		});

	$app->get("/clients/form",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();
				$id  = $request->getAttribute('id');
				// Verifying heade.rs
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);
				
				if(!$dataResponse['error'])
				{
					// Getting the information.
					$clientsController = new clientsController();
					$dataResponse = $clientsController->ConsultarClientesFormulario();	
				}
				
				if(!$dataResponse["error"])
				{
					$newResponse = $response->withStatus(200);
				}else{
					$newResponse = $response->withStatus(500);
				}	

				
				$response->withHeader("Content-type","application/json");
				$body = $response->getBody();
				$body->write(json_encode($dataResponse));
			} catch (PDOException $e) {
				echo "Error: ".$e->getMessage();
			}
		});


	$app->get("/clients/{id}",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();
				$id  = $request->getAttribute('id');
				// Verifying heade.rs
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);
				
				if(!$dataResponse['error'])
				{
					// Getting the information.
					$clientsController = new clientsController();
					$dataResponse = $clientsController->ConsultarClientesPorId($id);	
				}
				
				if(!$dataResponse["error"])
				{
					$newResponse = $response->withStatus(200);
				}else{
					$newResponse = $response->withStatus(500);
				}	

				
				$response->withHeader("Content-type","application/json");
				$body = $response->getBody();
				$body->write(json_encode($dataResponse));
			} catch (PDOException $e) {
				echo "Error: ".$e->getMessage();
			}
		});

	$app->get("/clients/routine/{id}",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();
				$id  = $request->getAttribute('id');
				// Verifying heade.rs
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);
				
				if(!$dataResponse['error'])
				{
					// Getting the information.
					$clientsController = new clientsController();
					$dataResponse = $clientsController->ConsultarInfoClienteRutinaId($id);	
				}
				
				if(!$dataResponse["error"])
				{
					$newResponse = $response->withStatus(200);
				}else{
					$newResponse = $response->withStatus(500);
				}	

				
				$response->withHeader("Content-type","application/json");
				$body = $response->getBody();
				$body->write(json_encode($dataResponse));
			} catch (PDOException $e) {
				echo "Error: ".$e->getMessage();
			}
		});

	$app->get("/clients/details/{id}",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();
				$id  = $request->getAttribute('id');
				// Verifying heade.rs
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);
				
				if(!$dataResponse['error'])
				{
					// Getting the information.
					$clientsController = new clientsController();
					$dataResponse = $clientsController->ConsultarClientesPorIdDet($id);	
				}
				
				if(!$dataResponse["error"])
				{
					$newResponse = $response->withStatus(200);
				}else{
					$newResponse = $response->withStatus(500);
				}	

				
				$response->withHeader("Content-type","application/json");
				$body = $response->getBody();
				$body->write(json_encode($dataResponse));
			} catch (PDOException $e) {
				echo "Error: ".$e->getMessage();
			}
		});

	$app->get("/clients/form/{id}",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();
				$id  = $request->getAttribute('id');
				// Verifying heade.rs
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);
				
				if(!$dataResponse['error'])
				{
					// Getting the information.
					$clientsController = new clientsController();
					$dataResponse = $clientsController->ConsultarClientInfoFormReport($id);	
				}
				
				if(!$dataResponse["error"])
				{
					$newResponse = $response->withStatus(200);
				}else{
					$newResponse = $response->withStatus(500);
				}	

				
				$response->withHeader("Content-type","application/json");
				$body = $response->getBody();
				$body->write(json_encode($dataResponse));
			} catch (PDOException $e) {
				echo "Error: ".$e->getMessage();
			}
		});

	$app->get("/clients/formverify/{id}",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();
				$id  = $request->getAttribute('id');
				// Verifying heade.rs
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);
				
				if(!$dataResponse['error'])
				{
					// Getting the information.
					$clientsController = new clientsController();
					$dataResponse = $clientsController->ConsultarclientForm($id);	
				}
				
				if(!$dataResponse["error"])
				{
					$newResponse = $response->withStatus(200);
				}else{
					$newResponse = $response->withStatus(500);
				}	

				
				$response->withHeader("Content-type","application/json");
				$body = $response->getBody();
				$body->write(json_encode($dataResponse));
			} catch (PDOException $e) {
				echo "Error: ".$e->getMessage();
			}
		});

	$app->get("/clients/routinegoal/{id}",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();
				$id  = $request->getAttribute('id');
				// Verifying heade.rs
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);
				
				if(!$dataResponse['error'])
				{
					// Getting the information.
					$clientsController = new clientsController();
					$dataResponse = $clientsController->ConsultarClientInfoRoutine($id);	
				}
				
				if(!$dataResponse["error"])
				{
					$newResponse = $response->withStatus(200);
				}else{
					$newResponse = $response->withStatus(500);
				}	

				
				$response->withHeader("Content-type","application/json");
				$body = $response->getBody();
				$body->write(json_encode($dataResponse));
			} catch (PDOException $e) {
				echo "Error: ".$e->getMessage();
			}
		});	
 ?>