<?php
putenv("DB_HOST=db");
putenv("DB_USERNAME=docker");
putenv("DB_PASSWORD=docker");
putenv("DB_NAME=docker");
putenv("PORT=3306");

// Define path constants

putenv("DS=" . DIRECTORY_SEPARATOR);
putenv("ROOT=" . getcwd() . getenv("DS"));
putenv("APP_PATH=" . getenv("ROOT") . 'app' . getenv("DS"));
putenv("FRAMEWORK_PATH=" . getenv("ROOT") . "framework" . getenv("DS"));
putenv("PUBLIC_PATH=" . getenv("ROOT") . "public" . getenv("DS"));

putenv("CONFIG_PATH=" . getenv("APP_PATH") . "config" . getenv("DS"));
putenv("CONTROLLER_PATH=" . getenv("APP_PATH") . "controllers" . getenv("DS"));
putenv("MODEL_PATH=" . getenv("APP_PATH") . "models" . getenv("DS"));
putenv("VIEW_PATH=" . getenv("APP_PATH") . "views" . getenv("DS"));

putenv("CORE_PATH=" . getenv("FRAMEWORK_PATH") . "core" . getenv("DS"));
putenv("DB_PATH=" . getenv("FRAMEWORK_PATH") . "database" . getenv("DS"));
putenv("LIB_PATH=" . getenv("FRAMEWORK_PATH") . "libraries" . getenv("DS"));
putenv("HELPER_PATH=" . getenv("FRAMEWORK_PATH") . "helpers" . getenv("DS"));
putenv("UPLOAD_PATH=" . getenv("PUBLIC_PATH") . "uploads" . getenv("DS"));
putenv("LOGS_PATH=" . getenv("PUBLIC_PATH") . "logs" . getenv("DS"));
putenv("CONTROLLER=" . $controller);
putenv("ACTION=" . $action);
putenv("CURR_CONTROLLER_PATH=" . getenv("CONTROLLER_PATH") . getenv("DS"));
putenv("CURR_VIEW_PATH=" . getenv("VIEW_PATH"));
