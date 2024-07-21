<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', __DIR__ . DS);

require_once ROOT_DIR . DS . 'core' . DS. 'config.php';
require_once ROOT_DIR . DS . 'core' . DS. 'datasource.php';
require_once ROOT_DIR . DS . 'core' . DS . 'functions.php';


$request = $_SERVER['REQUEST_URI'];

$request = trim($request, '/');
$request = strtok($request, '?');

$routes = [
    '' => 'views' . DS . 'home.php',
    'tarefas' => 'views' . DS . 'tarefas' . DS . 'index.php',
    'tarefas/new' => 'views' . DS . 'tarefas' . DS . 'add.php',
    'tarefas/delete' => 'views' . DS . 'tarefas' . DS . 'delete.php',
    'tarefas/edit' => 'views' . DS . 'tarefas' . DS . 'edit.php',
    'tarefas/kanban' => 'views' . DS . 'tarefas' . DS . 'kanban.php',
];

if (array_key_exists($request, $routes)) {
    include ROOT_DIR . $routes[$request];
} else {
    http_response_code(404);
    include ROOT_DIR . 'views' . DS . 'notfound.php';
}