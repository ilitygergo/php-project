<?php

class Framework {
    public static function run() {
        self::init();

        self::autoload();

        require getenv("CONFIG_PATH") . "config.php";

        self::dispatch();
    }

    private static function init() {
        require __DIR__ . '/../../../env.php';

        require getenv("CORE_PATH") . "controller.php";
    
        require getenv("CORE_PATH") . "loader.php";
    
        require getenv("DB_PATH") . "mysql.php";
    
        require getenv("CORE_PATH") . "model.php";
    
        require getenv("CORE_PATH") . "session.php";

        require getenv("CONFIG_PATH") . "functions.php";
    }

    private static function autoload() {
        spl_autoload_register(function($classname) {
            if (
                substr($classname, -10) == "Controller"
                && file_exists($path = getenv("CURR_CONTROLLER_PATH") . '/' . "$classname.php")
            ) {
                require_once $path;
            } elseif (file_exists($path = getenv("MODEL_PATH") . "$classname.php")) {
                require_once $path;
            }
        });
    }

    private static function dispatch() {
        $controller_name = getenv("CONTROLLER") . "Controller";
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
