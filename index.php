<?php 
	require "vendor/autoload.php";
	$app = new \Slim\App;

	define("SPECIALCONSTANT",true);

	require "libs/connect.php";
	require "routes/api.php";

	$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

	$app->run();

 ?>