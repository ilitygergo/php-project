<?php

class Framework {
    public static function run() {
        self::init();

        self::autoload();

        Model::setDb((new Mysql())->getConnection());

        Website::getInstance();

        self::dispatch();
    }

    private static function init() {
        $url = explode('/', strtok($_SERVER["REQUEST_URI"],'?'));
        $controller = $url[1] != '' ? $url[1] : 'index';
        $action = $url[2] ?? 'index';

        require __DIR__ . '/../../../env.php';

        require getenv("CORE_PATH") . "controller.php";

        require getenv("CORE_PATH") . "loader.php";

        require getenv("DB_PATH") . "mysql.php";

        require getenv("CORE_PATH") . "model.php";

        require getenv("CORE_PATH") . "session.php";

        // Load configuration file

        $GLOBALS['config'] = include getenv("CONFIG_PATH") . "config.php";

        $session = new Session();
    }

    private static function autoload() {
        spl_autoload_register(function($classname) {
            if (substr($classname, -10) == "Controller"
                && file_exists($path = getenv("CURR_CONTROLLER_PATH") . '/' . "$classname.php")
            ){
                require_once $path;
            } elseif (file_exists($path = getenv("MODEL_PATH") . "$classname.php")) {
                require_once $path;
            }
        });
    }

    private static function dispatch() {
        $controller_name = getenv("CONTROLLER") . "Controller";
        $action_name = getenv("ACTION") . "Action";

        if (class_exists($controller_name)) {
            $controller = new $controller_name;

            if (method_exists($controller, $action_name)) {
                $controller->$action_name();
            } else {
                $controller = new IndexController();
                $controller->not_foundAction();
            }
        } else {
            $controller = new IndexController();
            $controller->not_foundAction();
        }
    }
}
