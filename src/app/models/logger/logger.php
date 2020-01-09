<?php

class Logger {
    /**
     * @return resource
     */
    public static function readFile($path) {
        if (file_exists($filename = getenv("LOGS_PATH") . $path)) {
            return fopen(getenv("LOGS_PATH") . $path, "r");
        }

        return FALSE;
    }

    /**
     * @param resource $file
     */
    public static function closeFile($file) {
        fclose($file);
    }

    /**
     * @return string
     */
    public static function getLastRow($path) {
        if($file = self::readFile($path)) {
            while (($line = fgets($file)) !== false) {
                $lastRow = $line;
            }
    
            self::closeFile($file);
    
            return $lastRow;
        }
    }

    public static function insertRow($path, $message) {
        file_put_contents(getenv("LOGS_PATH") . $path, $message . "\n", FILE_APPEND);
    }
}
