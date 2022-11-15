<?php
    require_once 'libs/router.php';
    require_once 'app/controllers/apicontroller.php';
    require_once 'app/controllers/authcontroller.php';
    // CONSTANTES PARA RUTEO
    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

    $router = new Router();

    // rutas
    $router->addRoute("anuros", "GET", "ApiController", "getAnuros");
    $router->addRoute('anuros/:ID', 'GET', 'ApiController', 'getAnuroById');
    $router->addRoute('anuro', 'POST', 'ApiController', 'setAnuro');
    $router->addRoute("token", 'GET', 'AuthApiController', 'getToken');
    //run
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);