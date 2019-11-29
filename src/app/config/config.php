<?php

    ob_start();

    function isPostRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    function isGetRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    function redirect_to($location) {
        header("Location: " . $location);
        exit;
    }
