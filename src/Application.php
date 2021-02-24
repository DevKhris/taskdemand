<?php

declare(strict_types=1);

namespace App;

require_once 'src/Kernel/Database.php';
require_once 'src/Kernel/Router.php';
require_once 'src/Kernel/Route.php';

use App\Kernel\Router;
use App\Kernel\Database;

class Application
{
    public static Database $db;
    public Router $router;

    public function __construct()
    {
        self::$db = new Database();
        $this->router = new Router($_SERVER['REQUEST_URI']);
        return $this;
    }

    public static function view($view)
    {
        return include_once 'resources/views/' . $view . '.phtml';
    }
}