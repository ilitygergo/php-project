<?php

class Framework {

    /**
     *
     */
    public static function run() {
        self::init();
        self::autoload();
        self::dispatch();
    }

    /**
     * Initializing
     */
    private static function init() {
        $url = explode('/', $_SERVER['REQUEST_URI']);

        // Define path constants

        define("DS", DIRECTORY_SEPARATOR);

        define("ROOT", getcwd() . DS);

        define("APP_PATH", ROOT . 'app' . DS);

        define("FRAMEWORK_PATH", ROOT . "framework" . DS);

        define("PUBLIC_PATH", ROOT . "public" . DS);


        define("CONFIG_PATH", APP_PATH . "config" . DS);

        define("CONTROLLER_PATH", APP_PATH . "controllers" . DS);

        define("MODEL_PATH", APP_PATH . "models" . DS);

        define("VIEW_PATH", APP_PATH . "views" . DS);


        define("CORE_PATH", FRAMEWORK_PATH . "core" . DS);

        define('DB_PATH', FRAMEWORK_PATH . "database" . DS);

        define("LIB_PATH", FRAMEWORK_PATH . "libraries" . DS);

        define("HELPER_PATH", FRAMEWORK_PATH . "helpers" . DS);

        define("UPLOAD_PATH", PUBLIC_PATH . "uploads" . DS);

        // Define platform, controller, action

        define("PLATFORM", $_REQUEST['p'] ?? 'home');

        define("CONTROLLER", $url[1] != '' ? $url[1] : 'index');

        define("ACTION", $url[2] ?? 'index');


        define("CURR_CONTROLLER_PATH", CONTROLLER_PATH . PLATFORM . DS);

        define("CURR_VIEW_PATH", VIEW_PATH . PLATFORM . DS);

        // Load core classes

        require CORE_PATH . "controller.php";

        require CORE_PATH . "loader.php";

        require DB_PATH . "mysql.php";

        require CORE_PATH . "model.php";

        // Load configuration file

        $GLOBALS['config'] = include CONFIG_PATH . "config.php";

        // Start session

        session_start();
    }

    /**
     * Auto loading
     */
    private static function autoload() {
        spl_autoload_register(function($classname) {
            if (substr($classname, -10) == "Controller"){
                require_once CURR_CONTROLLER_PATH . '/' . "$classname.php";
            } elseif (substr($classname, -5) == "Model"){
                require_once  MODEL_PATH . "$classname.php";
            }
        });
    }

    /**
     * Instantiate the controller class and call its action method
     */
    private static function dispatch() {
        $controller_name = CONTROLLER . "Controller";
        $action_name = ACTION . "Action";
        $controller = new $controller_name;
        $controller->$action_name();
    }
}
