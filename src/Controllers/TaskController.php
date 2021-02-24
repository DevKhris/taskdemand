<?php

declare(strict_types=1);

namespace App\Controllers;

require_once 'src/Action/Task.php';

use App\Action\Task;
use App\Application;

class TaskController
{
    public static function index()
    {
        return Task::getAll();
    }

    public static function show($id)
    {
        return Task::get($id);
    }

    public static function search($query)
    {
        return Task::search($query);
    }

    public static function create()
    {
        return Task::create($_POST['title'], $_POST['description']);
    }

    public static function update()
    {
        return Task::update($_POST['id'], $_POST['title'], $_POST['description']);
    }

    public static function delete($id)
    {
        return Task::delete($id);
    }
}