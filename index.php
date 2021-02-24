<?php

require_once 'src/Application.php';
require_once 'src/Controllers.php';

use App\Application;
use App\Controllers\HomeController;
use App\Controllers\TaskController;

$app = new Application;

$app->router->add('/', [HomeController::class, 'index']);
$app->router->add('/tasks', [TaskController::class, 'index']);
$app->router->add('/tasks/:id', [TaskController::class, 'show']);
$app->router->add('/tasks/search/:query', [TaskController::class, 'search']);
$app->router->add('/task/add', [TaskController::class, 'create']);
$app->router->add('/task/edit', [TaskController::class, 'update']);
$app->router->add('/task/delete/:id', [TaskController::class, 'delete']);

$app->router->run();