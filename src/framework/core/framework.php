<?php
namespace App\Framework\Core;

use App\Controllers\IndexController;

class Framework {
    public static function run() {
        self::init();

        self::autoload();

        require getenv("CONFIG_PATH") . "config.php";

        self::dispatch();
    }

    private static function init() {
        require __DIR__ . '/../../../env.php';

        require getenv("CONFIG_PATH") . "functions.php";
    }

    private static function autoload() {
        require_once(__DIR__ . '/../../../vendor/autoload.php');
    }

    private static function dispatch() {
        $controller_name = "\App\Controllers\\" . ucfirst(getenv("CONTROLLER")) . "Controller";
        $action_name = getenv("ACTION") . "Action";

        if (class_exists($controller_name) && method_exists(new $controller_name, $action_name)) {
            $controller = new $controller_name;
            $controller->$action_name();
        } else {
            $controller = new IndexController();
            $controller->not_foundAction();
        }
    }
}
