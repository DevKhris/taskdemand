<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Application;

class HomeController
{
    public static function index()
    {
        return Application::view('home');
    }
}