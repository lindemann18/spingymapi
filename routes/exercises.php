<?php 
	// USER ROUTES
	use Psr\Http\Message\ServerRequestInterface;
	use Psr\Http\Message\ResponseInterface;

	// GEt Exercises
	$app->get("/exercices",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();
				
				// Verifying headers
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);

				if(!$dataResponse['error'])
				{
					// Getting the information.
					$exerciseController = new exerciseController();
					$dataResponse = $exerciseController->ConsultarEjercicios();	
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

	// Exercises by ID
	$app->get("/exercices/{id}",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();
				$id  = $request->getAttribute('id');
				// Verifying headers
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);

				if(!$dataResponse['error'])
				{
					// Getting the information.
					$exerciseController = new exerciseController();
					$dataResponse = $exerciseController->ConsultarEjercicioPorId($id);	
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

	$app->get("/exercices/routines/{id}",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();
				$id  = $request->getAttribute('id');
				// Verifying headers
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);

				if(!$dataResponse['error'])
				{
					// Getting the information.
					$exerciseController = new exerciseController();
					$dataResponse = $exerciseController->ConsultarEjerciciosPorTipoRutina($id);	
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

	//get exercises by musle
	$app->get("/exercices/muscles/{muscle}",function(ServerRequestInterface $request, ResponseInterface $response) use($app){
			try {
				
				//Getting DAta
				$data   = $request->getHeaders();
				$muscle  = $request->getAttribute('muscle');

				// Verifying headers
				$uController  = new utilitiesController();
				$dataResponse = $uController->validateLoginInfo($data);

				if(!$dataResponse['error'])
				{
					// Getting the information.
					$exerciseController = new exerciseController();
					$dataResponse = $exerciseController->_ConsultarEjerciciosPorMusculo($muscle);	
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