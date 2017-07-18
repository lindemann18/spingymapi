<?php 
	require "vendor/autoload.php";
	$app = new \Slim\App;

	define("SPECIALCONSTANT",true);

	require "libs/connect.php";
	require "routes/api.php";
	$conexion   = new Conexion(); //Variable de conexión
	$con        = $conexion->_con();

	// Controllers
	require "controllers/utilitiesController.php";
	require "controllers/usersController.php";
	require "controllers/advicesController.php";
	require "controllers/machineCatController.php";
	require "controllers/muslesController.php";
	require "controllers/exerciseController.php";
	require "controllers/clientsController.php";
	require "controllers/machinesController.php";
	require "controllers/routinesCatController.php";
	require "controllers/routinesController.php";
	require "controllers/biotestController.php";

	//models
	require "models/utilitiesModel.php";
	require "models/usersModel.php";
	require "models/advicesModel.php";
	require "models/machinesCategoriesModel.php";
	require "models/muslesModel.php";
	require "models/exercisesModel.php";
	require "models/clientsModel.php";
	require "models/machinesModel.php";
	require "models/routinesCatModel.php";
	require "models/routinesModel.php";
	require "models/biotestModel.php";

	$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

	$app->run();

 ?>