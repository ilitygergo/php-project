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

        require getenv("CONFIG_PATH") . "functions.php";
    }

    private static function autoload() {
        spl_autoload_register(function ($classname) {
            foreach (self::getIncludePaths() as $path) {
                if (file_exists($file = $path . "$classname.php")) {
                    require $file;
                }
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

    /**
     * @return 
     */
    private static function getIncludePaths() {
        return [
            getenv("CORE_PATH"),
            getenv("DB_PATH"),
            getenv("CURR_CONTROLLER_PATH"),
            getenv("MODEL_PATH"),
            getenv("MODEL_PATH") . "logger/"
        ];
    }
}
