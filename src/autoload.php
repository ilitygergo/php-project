<?php
    spl_autoload_register(function($className) {
        $className = str_replace('\\', '/', $className);
        include_once $_SERVER['DOCUMENT_ROOT'] . '/' . $className . '.php';
    });
