<?php

declare(strict_types= 1);
require_once __DIR__ ."\\..\\vendor\\autoload.php";

use App\Repository\InMemoryTaskRepository;
use App\Controller\TaskController;
use App\Container\Container;

$route = $_GET['route']??'task/list';

/* $config = require __DIR__ .'/../src/Model/config.php';
$container = new Container($config); */
$container = new Container();

$container->set(InMemoryTaskRepository::class, fn () => new InMemoryTaskRepository());
$container->set(TaskController::class, function (Container $c) {
    $repo = $c->get(InMemoryTaskRepository::class);
    return new TaskController($repo);
});

$controller = $container->get(TaskController::class);
echo $controller::class;
switch ($route) {
    case 'task/list':
        $controller->list();
        break;
    case 'task/add':
        $controller->add();
        break;
    default:
    http_response_code(404);
    echo '404 not found';
}