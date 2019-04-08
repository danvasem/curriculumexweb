<?php

ini_set('display_errors',1);
ini_set('display_startup_error',1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

session_start(); //Para inicializar la sesion

use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;

//Para cargar las variables de entorno
$dotenv= Dotenv\Dotenv::create(__DIR__.'/..');
$dotenv->load();

/***Código para inicializar Eloquent, que es el ORM de la base de datos */
$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => getenv('DB_HOST'),
    'database'  => getenv('DB_NAME'),
    'username'  => getenv('DB_USER'),
    'password'  => getenv('DB_PASS'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

/********************************************** */

//Para utilizar PSR 7 con Diactoros
$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();
$map->get('default','/platzi/',[
    'controller'=>'App\Controllers\IndexController',
    'action'=>'indexAction',
    'auth'=>false
]);
$map->get('index','/platzi/index',[
    'controller'=>'App\Controllers\IndexController',
    'action'=>'indexAction',
    'auth'=>false
]);
$map->get('addJobs','/platzi/jobs/add',[
    'controller'=>'App\Controllers\JobsController',
    'action'=>'getAddJobAction',
    'auth'=>true
]);
$map->get('addProjects','/platzi/projects/add',[
    'controller'=>'App\Controllers\ProjectsController',
    'action'=>'getAddProjectAction',
    'auth'=>true
]);
$map->get('addUsers','/platzi/users/add',[
    'controller'=>'App\Controllers\UsersController',
    'action'=>'getAddUserAction',
    'auth'=>true
]);
$map->get('loginForm','/platzi/login',[
    'controller'=>'App\Controllers\AuthController',
    'action'=>'getLogin',
    'auth'=>false
]);
$map->post('addJobsPost','/platzi/jobs/add',[
    'controller'=>'App\Controllers\JobsController',
    'action'=>'getAddJobAction',
    'auth'=>true
]);
$map->post('addProjectsPost','/platzi/projects/add',[
    'controller'=>'App\Controllers\ProjectsController',
    'action'=>'getAddProjectAction',
    'auth'=>true
]);
$map->post('addUsersPost','/platzi/users/add',[
    'controller'=>'App\Controllers\UsersController',
    'action'=>'getAddUserAction',
    'auth'=>true
]);
$map->post('auth','/platzi/auth',[
    'controller'=>'App\Controllers\AuthController',
    'action'=>'postLogin',
    'auth'=>false
]);
$map->get('admin','/platzi/admin',[
    'controller'=>'App\Controllers\AdminController',
    'action'=>'getIndex',
    'auth'=>true
]);
$map->get('logout','/platzi/logout',[
    'controller'=>'App\Controllers\AuthController',
    'action'=>'getLogout',
    'auth'=>true
]);

$matcher = $routerContainer->getMatcher();
$route=$matcher->match($request);
if(!$route){
    echo 'No Route';
} else{
    $handlerData = $route->handler;
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];
    $needsAuth = $handlerData['auth'] ?? false;

    //echo $needsAuth;
    $sessionUserId=$_SESSION['userId'] ?? null;
    //echo 'Usuario: '.$sessionUserId;
    if($needsAuth && !$sessionUserId){
        $controllerName='App\Controllers\AuthController';
        $actionName='getLogin';
    }
    
    $controller=new $controllerName;
    $response = $controller->$actionName($request);

    foreach($response->getHeaders() as $name=>$values){
        foreach($values as $value){
            header(sprintf('%s: %s', $name, $value),false);
        }
    }
    http_response_code($response->getStatusCode());
    echo $response->getBody();
}
