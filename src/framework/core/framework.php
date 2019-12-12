<?php

class Framework {
    /**
     *
     */
    public static function run() {
        self::init();

        self::autoload();

        Model::setDb((new Mysql())->getConnection());

        Website::getInstance();

        self::dispatch();
    }

    /**
     * Initializing
     */
    private static function init() {
        $url = explode('/', strtok($_SERVER["REQUEST_URI"],'?'));

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

    /**
     * Auto loading
     */
    private static function autoload() {
        spl_autoload_register(function($classname) {
            if (substr($classname, -10) == "Controller"){
                require_once getenv("CURR_CONTROLLER_PATH") . '/' . "$classname.php";
            } else {
                require_once  getenv("MODEL_PATH") . "$classname.php";
            }
        });
    }

    /**
     * Instantiate the controller class and call its action method
     */
    private static function dispatch() {
        $controller_name = getenv("CONTROLLER") . "Controller";
        $action_name = getenv("ACTION") . "Action";
        $controller = new $controller_name;
        $controller->$action_name();
    }
}
